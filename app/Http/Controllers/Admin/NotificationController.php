<?php
namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DataTables,Notify,Str,Storage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Auth;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\Token;
use Event;
use PushNotification;

class NotificationController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * Create a new controller instance.
     * * *
     * * * @return void
     * * */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.notification.';
        $this->middleware('auth');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function Index Page
    ---------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $notification = Notification::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($notification->get())
            ->addIndexColumn()
            ->editColumn('title', function (Notification $notification) {
                return Str::words($notification->title, 10,'....');
            })
            ->editColumn('message', function (Notification $notification) {
                return Str::words($notification->message, 10,'....');
            })
            ->editColumn('action', function (Notification $notification) {
                $action  = '';

                $action .= '<a class="btn btn-warning btn-circle btn-sm" href='.route('admin.notification.edit',[$notification->id]).'><i class="fa fa-pencil" data-toggle="tooltip" title="Edit"></i></a>';

                $action .= '<a href="javascript:void(0)" class="btn btn-primary btn-circle btn-sm ShowNotification m-l-10 ml-1 mr-1" data-id="'.$notification->id.'" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>';

                $action .= '<a href="javascript:void(0)" class="btn btn-success btn-circle btn-sm SendNotification" data-id="'.$notification->id.'" data-toggle="tooltip" title="Send Notification"><i class="fa fa-bell"></i></a>';

                return $action;
            })
            ->rawColumns(['action','title','message'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'title', 'name' => 'title', 'title' => 'Title','width'=>'10%'],
            ['data' => 'message', 'name' => 'message', 'title' => 'Message','width'=>'10%'],
            ['data' => 'url', 'name' => 'url', 'title' => 'URL','width'=>'10%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([ 'order' =>[] ]);
        return view($this->pageLayout.'index',compact('html'));
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Create Notification
    ---------------------------------------------------------------------------------- */
    public function create(){
        return view($this->pageLayout.'create');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Store Notification
    ---------------------------------------------------------------------------------- */
    public function store(Request $request){
        $customMessages = [
            'title.required'             => 'Title is Required',
            'message.required'           => 'Message is Required',
            'url.required'               => 'Url is Required',
        ];
        $validatedData = Validator::make($request->all(),[
            'title'              => 'required',
            'message'            => 'required',
            'url'                => 'required',
        ],$customMessages);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            if(!empty($request->send)){
                $check_notification = Notification::create([
                    'title'               => @$request->get('title'),
                    'message'             => @$request->get('message'),
                    'url'                 => @$request->get('url'),
                ]);
                if(!empty($check_notification)){
                    $check_token = Token::get();
                    foreach($check_token as $token){
                        Transaction::create([
                            'notification_id'   => @$check_notification->id,
                            'token'             => @$token->token,
                        ]);
                        $data['message']        =  'User Notification successfully';
                        $data['type']           =  'user_notification';
                        $data['url']            =  @$check_notification->url;
                        $data['notification']   =  Event::dispatch('send-notification-assigned-user',array($token,$data));
                    }
                }
            } else {
                Notification::create([
                    'title'               => @$request->get('title'),
                    'message'             => @$request->get('message'),
                    'url'                 => @$request->get('url'),
                ]);
            }
            Notify::success('Notification Created Successfully..!');
            return redirect()->route('admin.notification.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Edit Notification
    ---------------------------------------------------------------------------------- */
    public function edit($id){
        $notification = Notification::where('id',$id)->first();
        if(!empty($notification)){
            return view($this->pageLayout.'edit',compact('notification'));
        }else{
            return redirect()->route('admin.notification.index');
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Update Notification
    ---------------------------------------------------------------------------------- */
    public function update(Request $request,$id){
        $customMessages = [
            'title.required'            => 'Title is Required',
            'message.required'          => 'Message is Required',
            'url.required'              => 'Url is Required',
        ];
        $validatedData = Validator::make($request->all(),[
            'title'             => 'required',
            'message'           => 'required',
            'url'               => 'required',
        ],$customMessages);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            Notification::where('id',$id)->update([
                'title'       => @$request->get('title'),
                'message'     => @$request->get('message'),
                'url'         => @$request->get('url')
            ]);
            Notify::success('Notification Updated Successfully..!');
            return redirect()->route('admin.notification.index');
        } catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for show Notification
    ---------------------------------------------------------------------------------- */
    public function show(Request $request) {
        $notification = Notification::find($request->id);
        return view($this->pageLayout.'show',compact('notification'));
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Delete Notification
    ---------------------------------------------------------------------------------- */
    public function send($id){
        try{
            $notification = Notification::find($id);
            if(!empty($notification)){
                $check_token = Token::get();
                foreach($check_token as $token){
                    Transaction::create([
                        'notification_id'   => @$notification->id,
                        'token'             => @$token->token,
                    ]);
                    $data['message']        =  'User Notification successfully';
                    $data['type']           =  'user_notification';
                    $data['url']            =  @$notification->url;
                    $data['notification']   =  Event::dispatch('send-notification-assigned-user',array($token,$data));
                }
            }
            Notify::success('User Notification Deleted Successfully..!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'User Notification Successfully..!'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
}