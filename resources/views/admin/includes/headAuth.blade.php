@php
$favicon_logo = App\Models\Setting::where('code','favicon_logo')->first();
$application_logo = App\Models\Setting::where('code','application_logo')->first();
$application_title = App\Models\Setting::where('code','application_title')->first();
@endphp
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> {{$application_title->value}} - Admin Login</title>
	<link href="{{ asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/admin/css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/admin/css/animate.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/admin/css/style.css')}}" rel="stylesheet">

	<!-- particle js -->
	<link href="{{ asset('assets/particles/style.css')}}" rel="stylesheet">
	<!-- particle js -->
	@if(!empty($favicon_logo->value))
	<link rel="icon" href="{!! @$favicon_logo->value !== '' ? asset("storage/setting/".@$favicon_logo->value) : asset('storage/default.png') !!}" type="image/gif" sizes="16x16">
	@else
	<link rel="icon" href="{!! asset('storage/setting/default.png') !!}" type="image/gif" sizes="16x16">
	@endif
	<link href="{{ asset('assets/admin/css/custom.css')}}" rel="stylesheet">
</head>
