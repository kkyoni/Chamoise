<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'preventBackHistory'],function(){
	Route::get('/', 'HomeController@welcome')->name('welcome');
	Route::get('admin','Admin\Auth\LoginController@showLoginForm')->name('admin.showLoginForm');
	Route::get('admin/login','Admin\Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('admin/login', 'Admin\Auth\LoginController@login');
	Route::get('admin/resetPassword','Admin\Auth\PasswordResetController@showPasswordRest')->name('admin.resetPassword');
	Route::post('admin/sendResetLinkEmail', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.sendResetLinkEmail');
	Route::get('admin/find/{token}', 'Admin\Auth\PasswordResetController@find')->name('admin.find');
	Route::post('admin/create', 'Admin\Auth\PasswordResetController@create')->name('admin.sendLinkToUser');
	Route::post('admin/reset', 'Admin\Auth\PasswordResetController@reset')->name('admin.resetPassword_set');
	Route::group(['prefix' => 'admin','middleware'=>'Admin','namespace' => 'Admin','as' => 'admin.'],function(){
		Route::get('/dashboard','MainController@dashboard')->name('dashboard');
		Route::get('/logout','Auth\LoginController@logout')->name('logout');

		//====================> Update Admin Profile =========================
		Route::get('/profile','UsersController@updateProfile')->name('profile');
		Route::post('/updateProfileDetail','UsersController@updateProfileDetail')->name('updateProfileDetail');
		Route::post('/updatePassword','UsersController@updatePassword')->name('updatePassword');

		//====================> Promotions Management =========================
		Route::get('/promotions','PromotionsController@index')->name('promotions.index');
		Route::get('/promotions/create','PromotionsController@create')->name('promotions.create');
		Route::post('/promotions/store','PromotionsController@store')->name('promotions.store');
		Route::post('/promotions/delete/{id}','PromotionsController@delete')->name('promotions.delete');
		Route::get('/promotions/show','PromotionsController@show')->name('promotions.show');
		Route::get('/promotions/edit/{id}','PromotionsController@edit')->name('promotions.edit');
		Route::post('/promotions/update/{id}','PromotionsController@update')->name('promotions.update');
		Route::get('/promotions/remove_promotionsImage/{id}','PromotionsController@remove_promotionsImage')->name('promotions.remove_promotionsImage');

		//====================> Location Management =========================
		Route::get('/location','LocationController@index')->name('location.index');
		Route::get('/location/create','LocationController@create')->name('location.create');
		Route::post('/location/store','LocationController@store')->name('location.store');
		Route::post('/location/delete/{id}','LocationController@delete')->name('location.delete');
		Route::get('/location/show','LocationController@show')->name('location.show');
		Route::get('/location/edit/{id}','LocationController@edit')->name('location.edit');
		Route::post('/location/update/{id}','LocationController@update')->name('location.update');
		Route::get('/location/remove_locationImage/{id}','LocationController@remove_locationImage')->name('location.remove_locationImage');

		//====================> Exclusive Offer Management =========================
		Route::get('/exclusiveoffer','ExclusiveOfferController@index')->name('exclusiveoffer.index');
		Route::get('/exclusiveoffer/create','ExclusiveOfferController@create')->name('exclusiveoffer.create');
		Route::post('/exclusiveoffer/store','ExclusiveOfferController@store')->name('exclusiveoffer.store');
		Route::post('/exclusiveoffer/delete/{id}','ExclusiveOfferController@delete')->name('exclusiveoffer.delete');
		Route::get('/exclusiveoffer/show','ExclusiveOfferController@show')->name('exclusiveoffer.show');
		Route::get('/exclusiveoffer/edit/{id}','ExclusiveOfferController@edit')->name('exclusiveoffer.edit');
		Route::post('/exclusiveoffer/update/{id}','ExclusiveOfferController@update')->name('exclusiveoffer.update');

		//====================> Token Management =========================
		Route::get('/token','TokenController@index')->name('token.index');
		Route::post('/token/delete/{id}','TokenController@delete')->name('token.delete');

		//====================> Notification Management =========================
		Route::get('/notification','NotificationController@index')->name('notification.index');
		Route::get('/notification/create','NotificationController@create')->name('notification.create');
		Route::post('/notification/store','NotificationController@store')->name('notification.store');
		Route::get('/notification/edit/{id}','NotificationController@edit')->name('notification.edit');
		Route::post('/notification/update/{id}','NotificationController@update')->name('notification.update');
		Route::get('/notification/show','NotificationController@show')->name('notification.show');
		Route::post('/notification/send/{id}','NotificationController@send')->name('notification.send');

		//====================> Transaction Management =========================
		Route::get('/transaction','TransactionController@index')->name('transaction.index');
		Route::get('/transaction/show','TransactionController@show')->name('transaction.show');

		//====================> Setting Management =========================
		Route::get('/setting','SettingsController@index')->name('setting.index');
		Route::get('/setting/edit/{id}','SettingsController@edit')->name('setting.edit');
		Route::post('/setting/update/{id}','SettingsController@update')->name('setting.update');
		Route::post('/setting/change_status','SettingsController@change_status')->name('setting.change_status');
	});
});


Event::listen('send-notification-assigned-user', function($value,$data) {
	try {
		$path = public_path().'/webservice_logs/'.date("d-m-Y h:i:s").'_notification.log';
		file_put_contents($path, "\n\n".date("d-m-Y") . "_ : ".json_encode(['user'=>$value->id,'data'=>$data])."\n", FILE_APPEND);
		$response = [];
		$device_token = $value->token;
		if($value->type == 'android' || $value->type == 'ios'){
			file_put_contents($path, "\n\n".date("d-m-Y h:i:s") . "_Notification_data : ".json_encode($data)."\n", FILE_APPEND);
			$response[] = PushNotification::setService('fcm')->setMessage([
				'data' => $data
			])->setApiKey('AIzaSyCh1wuN2xJvXKI7PrY5ANrcud1kuHvvd9E')->setConfig(['dry_run' => false])->sendByTopic($data['type'])->setDevicesToken([$device_token])->send()->getFeedback();
		}
		file_put_contents($path, "\n\n".date("d-m-Y h:i:s") . "_Response_User_android : ".json_encode($response)."\n", FILE_APPEND);
		return $response;
	} catch (Exception $e) {
		file_put_contents($path, "\n\n".date("d-m-Y h:i:s") . "_Response : ".json_encode($e)."\n", FILE_APPEND);
	}
});