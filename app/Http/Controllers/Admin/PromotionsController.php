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
use App\Models\Promotions;
use App\Models\PromotionsImages;
use Event;

class PromotionsController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * Create a new controller instance.
     * * *
     * * * @return void
     * * */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.promotions.';
        $this->middleware('auth');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function Index Page
    ---------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $promotions = Promotions::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($promotions->get())
            ->addIndexColumn()
            ->editColumn('description', function (Promotions $promotions) {
                return Str::words($promotions->description, 10,'....');
            })
            ->editColumn('title', function (Promotions $promotions) {
                return Str::words($promotions->title, 10,'....');
            })
            ->editColumn('action', function (Promotions $promotions) {
                $action  = '';

                $action .= '<a class="btn btn-warning btn-circle btn-sm" href='.route('admin.promotions.edit',[$promotions->id]).'><i class="fa fa-pencil" data-toggle="tooltip" title="Edit"></i></a>';

                $action .='<a class="btn btn-danger btn-circle btn-sm m-l-10 deletepromotions ml-1 mr-1" data-id ="'.$promotions->id.'" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>';

                $action .= '<a href="javascript:void(0)" class="btn btn-primary btn-circle btn-sm Showpromotions" data-id="'.$promotions->id.'" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>';

                return $action;
            })
            ->rawColumns(['action','title','description'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
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
    @Description: Function for Create Promotions
    ---------------------------------------------------------------------------------- */
    public function create(){
        return view($this->pageLayout.'create');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Store Promotions
    ---------------------------------------------------------------------------------- */
    public function store(Request $request){
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
            $promotions = Promotions::create([
                'title'              => @$request->get('title'),
                'description'        => @$request->get('description'),
                'start_date'         => @$request->get('start_date'),
                'end_date'           => @$request->get('end_date'),
            ]);
            if($request->hasFile('image_name')){
                $names = [];
                foreach($request->file('image_name') as $image){
                    $filename = $image->store('promotions', ['disk' => 'public']);
                    $input['image'] = $filename;
                    $input['promotions_id']=$promotions->id;
                    PromotionsImages::create($input);
                }
            }
            Notify::success('Promotions Created Successfully..!');
            return redirect()->route('admin.promotions.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /*----------------------------------------------------------------------------------
    @Description: Function for Edit Promotions
    ---------------------------------------------------------------------------------- */
    public function edit($id){
        $promotions = Promotions::where('id',$id)->first();
        $promotions_images=PromotionsImages::where('promotions_id',$id)->get();
        if(!empty($promotions)){
            return view($this->pageLayout.'edit',compact('promotions','promotions_images'));
        }else{
            return redirect()->route('admin.promotions.index');
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Update Promotions
    --------------------------------------------------------------------------------- */
    public function update(Request $request,$id){
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
            Promotions::where('id',$id)->update([
                'title'         => @$request->get('title'),
                'description'   => @$request->get('description'),
                'start_date'    => @$request->get('start_date'),
                'end_date'      => @$request->get('end_date')
            ]);
            if($request->hasFile('image_name')){
                $names = [];
                foreach($request->file('image_name') as $image){
                    $filename = '';
                    $filename = $image->store('promotions', ['disk' => 'public']);
                    $input['image'] = $filename;
                    $input['promotions_id']=$id;
                    PromotionsImages::create($input);
                }
            }
            Notify::success('Promotions Updated Successfully..!');
            return redirect()->route('admin.promotions.index');
        } catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Delete Promotions
    ---------------------------------------------------------------------------------- */
    public function delete($id){
        try{
            $promotions = Promotions::where('id',$id)->first();
            $promotions_multiple_images = PromotionsImages::where('promotions_id',$id)->get();
            if(sizeof($promotions_multiple_images) > 0){
                foreach($promotions_multiple_images as $images){
                    $promotions_images = PromotionsImages::where('id',$images->id)->first();
                    $promotions_images->delete();
                }
            }
            $promotions->delete();
            Notify::success('Promotions Deleted Successfully..!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Promotions Deleted Successfully..!'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for show promotions
    ---------------------------------------------------------------------------------- */
    public function show(Request $request) {
        $promotions = Promotions::find($request->id);
        $promotions_images=PromotionsImages::where('promotions_id',$request->id)->get();
        return view($this->pageLayout.'show',compact('promotions','promotions_images'));
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Multiple Images Remove promotions
    ---------------------------------------------------------------------------------- */
    public function remove_promotionsImage($id){
        $promotions_images = PromotionsImages::find($id);
        $promotions_images->delete();
        if($promotions_images){
            $file= $promotions_images->image;
            return ["status"=>'success',"message"=>'Record deleted sucessfully'];
        }else{
            return ["status"=>'error',"message"=>'Product Not Found'];
        }
    }
}