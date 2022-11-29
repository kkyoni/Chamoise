<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Mail;
use Event;
use Illuminate\Support\Arr;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Stripe\Charge;
use Stripe\Customer;
use Response;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;
use App\Models\Promotions;
use App\Models\PromotionsImages;
use App\Models\Location;
use App\Models\LocationImage;
use App\Models\Token;
use App\Models\Transaction;
use App\Models\Notification;
use App\Models\ExclusiveOffer;
use PushNotification;

class CommonController extends Controller{
    public function __construct(){}

    public function getAuthenticatedUser(){
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    /*
    |--------------------------------------------------------------------------
    | All Settings
    |--------------------------------------------------------------------------
    */
    public function getsettings(Request $request){
        try{
            $allSetting = Setting::where('hidden','0')->where('code','giftcertificate')->first();
            if(!empty($allSetting)){
                return response()->json(['status' => 'success','message' =>'All Get Setting','data' => $allSetting]);
            }else{
                return response()->json(["status" => "fail", 'code' => 400, 'error' => 'Not Record found']);
            }
        }catch(Exception $e){
            return response()->json(['status' => 'error','message' => $e->getMessage()]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | All Promotions
    |--------------------------------------------------------------------------
    */
    public function getpromotions(Request $request){
        try {
            $allpromotions = Promotions::with(['PromotionsImagesList'])->get();
            if ($allpromotions) {
                foreach ($allpromotions as $key => $value) {
                    if (!empty($value['PromotionsImagesList'])) {
                        foreach($value['PromotionsImagesList'] as $key => $value){
                            $directory = asset("/storage/");
                            $value->image = $directory.'/'.$value->image;
                        }
                    }
                }
                return response()->json(["status" => "success", 'code' => 200, 'message' => 'Get Promotions successfully.', 'data' => $allpromotions]);
            } else {
                return response()->json(["status" => "fail", 'code' => 400, 'error' => 'Not Record found']);
            }
        } catch (Exception $e) {
            return response()->json(["status" => "fail", 'code' => $e->getCode(), 'error' => $e->getMessage()]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | All Location
    |--------------------------------------------------------------------------
    */
    public function getlocation(Request $request){
        try{
            $allLocation = Location::with(['LocationImagesList'])->get();
            if ($allLocation) {
                foreach ($allLocation as $key => $value) {
                    $directory_list = asset("/storage/location/");
                    $allLocation [$key]['image'] = $directory_list.'/'.$value->image;
                    if (!empty($value['LocationImagesList'])) {
                        foreach($value['LocationImagesList'] as $key => $value){
                            $directory = asset("/storage/");
                            $value->image = $directory.'/'.$value->image;
                        }
                    }
                }
                return response()->json(["status" => "success", 'code' => 200, 'message' => 'Get Location successfully.', 'data' => $allLocation]);
            } else {
                return response()->json(["status" => "fail", 'code' => 400, 'error' => 'Not Record found']);
            }
        }catch(Exception $e){
            return response()->json(['status' => 'error','message' => $e->getMessage()]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | All Exclusive Offer
    |--------------------------------------------------------------------------
    */
    public function getexclusiveoffer(Request $request){
        try{
            $allExclusiveOffer = ExclusiveOffer::get();
            if ($allExclusiveOffer) {
                foreach ($allExclusiveOffer as $key => $value) {
                    $directory_list = asset("/storage/");
                    $allExclusiveOffer [$key]['images'] = $directory_list.'/'.$value->images;
                }
                return response()->json(["status" => "success", 'code' => 200, 'message' => 'Get Exclusive Offer successfully.', 'data' => $allExclusiveOffer]);
            } else {
                return response()->json(["status" => "fail", 'code' => 400, 'error' => 'Not Record found']);
            }
        }catch(Exception $e){
            return response()->json(['status' => 'error','message' => $e->getMessage()]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | All Token
    |--------------------------------------------------------------------------
    */
    public function token(Request $request){
        $validator = [
            'token'          =>'required',
            'type'           =>'required',
        ];
        $validation = Validator::make($request->all(),$validator);
        if($validation->fails()){
            return response()->json(['status'    => 'error','message'   => $validation->errors()->first()]);
        }
        try{
            $check_token = Token::where('token',$request->token)->first();
            if(!empty($check_token)){
                Token::where('token', $request->token)->update([ 'token' => $request->token,'type' => $request->type]);
            } else {
                Token::create(['token' => $request->token,'type' => $request->type]);
            }
            return response()->json(['status'=>'success','message'=>'Token Successfully..!']);
        }catch(Exception $e){
            return response()->json(['status'    => 'error','message'   => $e->getMessage()]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Get Transaction
    |--------------------------------------------------------------------------
    */
    public function gettransaction(Request $request){
        $check_transaction = Transaction::with('notification_list')->where('token',$request->token)->limit(10)->orderby('id','DESC')->get();
        if(sizeof($check_transaction) > 0){
            return response()->json(["status" => "success", 'code' => 200, 'message' => 'User Notification successfully.', 'data' => $check_transaction]);
        } else {
            return response()->json(["status" => "fail", 'code' => 400, 'error' => 'Notification Not Available..!']);
        }
    }
}