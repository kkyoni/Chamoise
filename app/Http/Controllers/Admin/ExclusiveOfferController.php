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
use App\Models\ExclusiveOffer;
use Event;

class ExclusiveOfferController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * Create a new controller instance.
     * * *
     * * * @return void
     * * */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.exclusiveoffer.';
        $this->middleware('auth');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function Index Page
    ---------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $exclusiveoffer = ExclusiveOffer::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($exclusiveoffer->get())
            ->addIndexColumn()
            ->editColumn('description', function (ExclusiveOffer $exclusiveoffer) {
                return Str::words($exclusiveoffer->description, 10,'....');
            })
            ->editColumn('title', function (ExclusiveOffer $exclusiveoffer) {
                return Str::words($exclusiveoffer->title, 10,'....');
            })
            ->editColumn('images', function (ExclusiveOffer $exclusiveoffer){
                if(!$exclusiveoffer->images){
                    return '<img class="img-thumbnail" src="' . asset('storage/exclusiveoffer/exclusiveoffer.png').'" width="60px">';
                }else{
                    return '<img class="img-thumbnail" src="' . asset('storage/' . '/' . $exclusiveoffer->images) . '" width="60px">';
                }
            })
            ->editColumn('action', function (ExclusiveOffer $exclusiveoffer) {
                $action  = '';

                $action .= '<a class="btn btn-warning btn-circle btn-sm" href='.route('admin.exclusiveoffer.edit',[$exclusiveoffer->id]).'><i class="fa fa-pencil" data-toggle="tooltip" title="Edit"></i></a>';

                $action .='<a class="btn btn-danger btn-circle btn-sm m-l-10 deleteexclusiveoffer ml-1 mr-1" data-id ="'.$exclusiveoffer->id.'" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>';

                $action .= '<a href="javascript:void(0)" class="btn btn-primary btn-circle btn-sm Showexclusiveoffer" data-id="'.$exclusiveoffer->id.'" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>';
                return $action;
            })
            ->rawColumns(['action','images','description','title'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'images', 'name' => 'images', 'title' => 'Images','width'=>'10%'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Title','width'=>'10%'],
            ['data' => 'description', 'name' => 'description', 'title' => 'Description','width'=>'10%'],
            ['data' => 'start_date', 'name' => 'start_date', 'title' => 'Start Date','width'=>'10%'],
            ['data' => 'end_date', 'name' => 'end_date', 'title' => 'End Date','width'=>'10%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([ 'order' =>[] ]);
        return view($this->pageLayout.'index',compact('html'));
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Create Exclusive Offer
    ---------------------------------------------------------------------------------- */
    public function create(){
        return view($this->pageLayout.'create');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Store Exclusive Offer
    ---------------------------------------------------------------------------------- */
    public function store(Request $request){
        $customMessages = [
            'title.required'            => 'Title is Required',
            'description.required'      => 'Description is Required',
            'start_date.required'       => 'Start Date is Required',
            'end_date.required'         => 'End Date is Required',
        ];
        $validatedData = Validator::make($request->all(),[
            'title'           => 'required',
            'description'     => 'required',
            'start_date'      => 'required',
            'end_date'        => 'required',
        ],$customMessages);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            if($request->hasFile('images')){
                $file = $request->file('images');
                $filename = $file->store('exclusiveoffer', ['disk' => 'public']);
            }else{
                $filename = 'exclusiveoffer.png';
            }
            ExclusiveOffer::create([
                'title'         => @$request->get('title'),
                'images'        => @$filename,
                'description'   => @$request->get('description'),
                'start_date'    => @$request->get('start_date'),
                'end_date'      => @$request->get('end_date'),
            ]);
            Notify::success('Exclusive Offer Created Successfully..!');
            return redirect()->route('admin.exclusiveoffer.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Edit Exclusive Offer
    ---------------------------------------------------------------------------------- */
    public function edit($id){
        $exclusiveoffer = ExclusiveOffer::where('id',$id)->first();
        if(!empty($exclusiveoffer)){
            return view($this->pageLayout.'edit',compact('exclusiveoffer'));
        }else{
            return redirect()->route('admin.exclusiveoffer.index');
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Update Exclusive Offer
    ---------------------------------------------------------------------------------- */
    public function update(Request $request,$id){
        $customMessages = [
            'title.required'          => 'Title is Required',
            'description.required'    => 'Description is Required',
            'start_date.required'     => 'Start Date is Required',
            'end_date.required'       => 'End Date is Required',
        ];
        $validatedData = Validator::make($request->all(),[
            'title'             => 'required',
            'description'       => 'required',
            'start_date'        => 'required',
            'end_date'          => 'required',
        ],$customMessages);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $oldDetails = ExclusiveOffer::find($id);
            if($request->hasFile('images')){
                $file = $request->file('images');
                $filename = $file->store('exclusiveoffer', ['disk' => 'public']);
            }else{
                if($oldDetails->images !== null){
                    $filename = $oldDetails->images;
                }else{
                    $filename = 'exclusiveoffer.png';
                }
            }
            ExclusiveOffer::where('id',$id)->update([
                'title'          => @$request->get('title'),
                'images'         => @$filename,
                'description'    => @$request->get('description'),
                'start_date'     => @$request->get('start_date'),
                'end_date'       => @$request->get('end_date')
            ]);
            Notify::success('Exclusive Offer Updated Successfully..!');
            return redirect()->route('admin.exclusiveoffer.index');
        } catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Delete Exclusive Offer
    ---------------------------------------------------------------------------------- */
    public function delete($id){
        try{
            $exclusiveoffer = ExclusiveOffer::where('id',$id)->first();
            $exclusiveoffer->delete();
            Notify::success('Exclusive Offer Deleted Successfully..!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Exclusive Offer Deleted Successfully..!'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for show Exclusive Offer
    ---------------------------------------------------------------------------------- */
    public function show(Request $request) {
        $exclusiveoffer = ExclusiveOffer::find($request->id);
        return view($this->pageLayout.'show',compact('exclusiveoffer'));
    }
}