<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExclusiveOffer;
use App\Models\GiftCertificate;
use App\Models\Location;
use App\Models\Promotions;
use App\Models\Setting;
use App\Models\Token;
use App\Models\Notification;
use App\Models\Transaction;
use Carbon\Carbon;
use Response;
class MainController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = 'admin.pages.';
    /**
     * * * Create a new controller instance.
     * * *
     * * * @return void
     * * */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.';
        $this->middleware('auth');
    }

    /*------------------------------------------------------------------------------------
    @Description: Function Index Page
    ----------------------------------------------------------------------------------- */
    public function index(){
        return view('front.auth.login');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function Dashboard Page
    ----------------------------------------------------------------------------------- */
    public function dashboard(){
        $totalPromotions = Promotions::count();
        $totalExclusiveOffer = ExclusiveOffer::count();
        $totalLocation = Location::count();
        $totalToken = Token::count();
        $totalNotification = Notification::count();
        $totalTransaction = Transaction::count();
        $totalSetting = Setting::count();
        return view('admin.pages.dashboard',compact('totalPromotions','totalExclusiveOffer','totalLocation','totalToken','totalNotification','totalTransaction','totalSetting'));
    }
}
