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
use App\Models\Location;
use App\Models\LocationImage;
use Event;

class LocationController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * Create a new controller instance.
     * * *
     * * * @return void
     * * */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.location.';
        $this->middleware('auth');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function Index Page
    ---------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $location = Location::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($location->get())
            ->addIndexColumn()
            ->editColumn('address', function (Location $location) {
                return Str::words($location->address, 10,'....');
            })
            ->editColumn('shortdescription', function (Location $location) {
                return Str::words($location->shortdescription, 10,'....');
            })
            ->editColumn('title', function (Location $location) {
                return Str::words($location->title, 10,'....');
            })
            ->editColumn('image', function (Location $location){
                if(!$location->image){
                    return '<img class="img-thumbnail" src="' . asset('storage/location/location.png').'" width="60px">';
                }else{
                    return '<img class="img-thumbnail" src="' . asset('storage/location' . '/' . $location->image) . '" width="60px">';
                }
            })
            ->editColumn('action', function (Location $location) {
                $action  = '';

                $action .= '<a class="btn btn-warning btn-circle btn-sm" href='.route('admin.location.edit',[$location->id]).'><i class="fa fa-pencil" data-toggle="tooltip" title="Edit"></i></a>';

                $action .='<a class="btn btn-danger btn-circle btn-sm m-l-10 deletelocation ml-1 mr-1" data-id ="'.$location->id.'" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>';

                $action .= '<a href="javascript:void(0)" class="btn btn-primary btn-circle btn-sm Showlocation" data-id="'.$location->id.'" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>';

                return $action;
            })
            ->rawColumns(['action','shortdescription','address','image','title'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'image', 'name' => 'image', 'title' => 'Image','width'=>'10%'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Title','width'=>'10%'],
            ['data' => 'address', 'name' => 'address', 'title' => 'Address','width'=>'10%'],
            ['data' => 'shortdescription', 'name' => 'shortdescription', 'title' => 'Short Description','width'=>'10%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([ 'order' =>[] ]);
        return view($this->pageLayout.'index',compact('html'));
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Create Location
    ---------------------------------------------------------------------------------- */
    public function create(){
        return view($this->pageLayout.'create');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Store Location
    ---------------------------------------------------------------------------------- */
    public function store(Request $request){
        $customMessages = [
            'title.required'             => 'Title is Required',
            'address.required'           => 'Address is Required',
            'lat.required'               => 'Lat is Required',
            'long.required'              => 'Long is Required',
            'shortdescription.required'  => 'shortdescription is Required',
            'video_url.required'         => 'video_url is Required',
            ];
            $validatedData = Validator::make($request->all(),[
                'title'              => 'required',
                'address'            => 'required',
                'lat'                => 'required',
                'long'               => 'required',
                'shortdescription'   => 'required',
                'video_url'          => 'required',
            ],$customMessages);
            if($validatedData->fails()){
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            try{
                if($request->hasFile('image')){
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = Str::random(10).'.'.$extension;
                    Storage::disk('public')->putFileAs('location', $file,$filename);
                }else{
                    $filename = 'location.png';
                }
                $location = Location::create([
                    'title'               => @$request->get('title'),
                    'address'             => @$request->get('address'),
                    'lat'                 => @$request->get('lat'),
                    'long'                => @$request->get('long'),
                    'phone_number'        => @$request->get('phone_number'),
                    'shortdescription'    => @$request->get('shortdescription'),
                    'video_url'           => @$request->get('video_url'),
                    'image'               => @$filename,
                ]);
                if($request->hasFile('image_name')){
                    $names = [];
                    foreach($request->file('image_name') as $image){
                        $filename = '';
                        $filename = $image->store('location', ['disk' => 'public']);
                        $input['image'] = $filename;
                        $input['location_id']=$location->id;
                        LocationImage::create($input);
                    }
                }
                Notify::success('Location Created Successfully..!');
                return redirect()->route('admin.location.index');
            }catch(\Exception $e){
                return back()->with([
                    'alert-type'    => 'danger',
                    'message'       => $e->getMessage()
                ]);
            }
        }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Edit Location
    ---------------------------------------------------------------------------------- */
    public function edit($id){
        $location = Location::where('id',$id)->first();
        $location_images=LocationImage::where('location_id',$id)->get();
        if(!empty($location)){
            return view($this->pageLayout.'edit',compact('location','location_images'));
        }else{
            return redirect()->route('admin.location.index');
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Update Location
    ---------------------------------------------------------------------------------- */
    public function update(Request $request,$id){
        $customMessages = [
            'title.required'             => 'title is Required',
            'address.required'           => 'address is Required',
            'lat.required'               => 'lat is Required',
            'long.required'              => 'long is Required',
            'shortdescription.required'  => 'shortdescription is Required',
            'video_url.required'         => 'video_url is Required',
        ];
        $validatedData = Validator::make($request->all(),[
            'title'             => 'required',
            'address'           => 'required',
            'lat'               => 'required',
            'long'              => 'required',
            'shortdescription'  => 'required',
            'video_url'         => 'required',
        ],$customMessages);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $oldDetails = Location::find($id);
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('location', $file,$filename);
            }else{
                if($oldDetails->image !== null){
                    $filename = $oldDetails->image;
                }else{
                    $filename = 'location.png';
                }
            }
            Location::where('id',$id)->update([
                'title'             => @$request->get('title'),
                'address'           => @$request->get('address'),
                'lat'               => @$request->get('lat'),
                'long'              => @$request->get('long'),
                'phone_number'      => @$request->get('phone_number'),
                'shortdescription'  => @$request->get('shortdescription'),
                'video_url'         => @$request->get('video_url'),
                'image'             => @$filename
            ]);
            if($request->hasFile('image_name')){
                $names = [];
                foreach($request->file('image_name') as $image){
                    $filename = '';
                    $filename = $image->store('location', ['disk' => 'public']);
                    $input['image'] = $filename;
                    $input['location_id']=$id;
                    LocationImage::create($input);
                }
            }
            Notify::success('Location Updated Successfully..!');
            return redirect()->route('admin.location.index');
        } catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Delete Location
    ---------------------------------------------------------------------------------- */
    public function delete($id){
        try{
            $location = Location::where('id',$id)->first();
            $location_multiple_images = LocationImage::where('location_id',$id)->get();
            if(sizeof($location_multiple_images) > 0){
                foreach($location_multiple_images as $images){
                    $location_images = LocationImage::where('id',$images->id)->first();
                    $location_images->delete();
                }
            }
            $location->delete();
            Notify::success('Location Deleted Successfully..!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Location Deleted Successfully..!'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for show Location
    ---------------------------------------------------------------------------------- */
    public function show(Request $request) {
        $location = Location::find($request->id);
        $location_images=LocationImage::where('location_id',$request->id)->get();
        return view($this->pageLayout.'show',compact('location','location_images'));
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Multiple Images Remove Location
    ---------------------------------------------------------------------------------- */
    public function remove_locationImage($id){
        $location_images = LocationImage::find($id);
        $location_images->delete();
        if($location_images){
            $file= $location_images->image;
            return ["status"=>'success',"message"=>'Record deleted sucessfully'];
        }else{
            return ["status"=>'error',"message"=>'Product Not Found'];
        }
    }
}