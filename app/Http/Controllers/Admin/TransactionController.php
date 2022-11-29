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
use Event;

class TransactionController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * Create a new controller instance.
     * * *
     * * * @return void
     * * */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.transaction.';
        $this->middleware('auth');
    }

    /*------------------------------------------------------------------------------------
    @Description: Function Index Page
    ----------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $transaction = Transaction::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($transaction->get())
            ->addIndexColumn()
            ->editColumn('notification_id', function (Transaction $transaction) {
                return $transaction->notification_list->title;
            })
            ->editColumn('status', function (Transaction $transaction) {
                if($transaction->status == "unread"){
                    return '<span class="label label-warning">Unread</span>';
                } else {
                    return '<span class="label label-success">Read</span>';
                }
            })
            ->editColumn('action', function (Transaction $transaction) {
                $action  = '';

                $action .= '<a href="javascript:void(0)" class="btn btn-primary btn-circle btn-sm ShowTransaction" data-id="'.$transaction->id.'" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>';

                return $action;
            })
            ->rawColumns(['action','status','notification_id'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'notification_id', 'name' => 'notification_id', 'title' => 'Notification','width'=>'10%'],
            ['data' => 'token', 'name' => 'token', 'title' => 'Token','width'=>'10%'],
            ['data' => 'status', 'name' => 'status', 'title' => 'status','width'=>'10%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([ 'order' =>[] ]);
        return view($this->pageLayout.'index',compact('html'));
    }

    /*------------------------------------------------------------------------------------
    @Description: Function for show Transaction
    ----------------------------------------------------------------------------------- */
    public function show(Request $request) {
        $transaction = Transaction::find($request->id);
        return view($this->pageLayout.'show',compact('transaction'));
    }
}