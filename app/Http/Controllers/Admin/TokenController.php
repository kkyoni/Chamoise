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
use App\Models\Token;
use App\Models\Transaction;
use Event;

class TokenController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * Create a new controller instance.
     * * *
     * * * @return void
     * * */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.token.';
        $this->middleware('auth');
    }

    /*------------------------------------------------------------------------------------
    @Description: Function Index Page
    ----------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $token = Token::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($token->get())
            ->addIndexColumn()
            ->editColumn('token_count', function (Token $token) {
                $count_token = Transaction::where('token',$token->token)->count();
                return $count_token;
            })
            ->editColumn('action', function (Token $token) {
                $action  = '';

                $action .='<a class="btn btn-danger btn-circle btn-sm m-l-10 deletetoken ml-1 mr-1" data-id ="'.$token->id.'" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>';

                return $action;
            })
            ->rawColumns(['action','token_count'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'token', 'name' => 'token', 'title' => 'Token','width'=>'10%'],
            ['data' => 'token_count', 'name' => 'token_count', 'title' => 'Token Count','width'=>'10%'],
            ['data' => 'type', 'name' => 'type', 'title' => 'Type','width'=>'10%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([ 'order' =>[] ]);
        return view($this->pageLayout.'index',compact('html'));
    }

    /*------------------------------------------------------------------------------------
    @Description: Function for Delete Token
    ----------------------------------------------------------------------------------- */
    public function delete($id){
        try{
            $token = Token::where('id',$id)->first();
            $token->delete();
            Notify::success('Token Deleted Successfully..!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Token Deleted Successfully..!'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
}