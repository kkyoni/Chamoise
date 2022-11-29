@extends('admin.layouts.app')
@section('title')
Notification Management - Create
@endsection
@section('mainContent')
@if(Session::has('message'))
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-{{ Session::has('alert-type') }}">
			{!! Session::get('message') !!}
		</div>
	</div>
</div>
@endif
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12">
		<h2>Add Notification</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Home</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route('admin.notification.index') }}">Notification Table</a>
			</li>
			<li class="breadcrumb-item active">
				<span class="label label-success float-right all_backgroud"><strong>Add Notification Form</strong></span>
			</li>
		</ol>
	</div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox">
				<div class="ibox-content">
					{!! 
					Form::open([
					'route'	=> ['admin.notification.store'],
					'id'	=> 'InwordCreateForm',
					'files' => 'true' 
					])
					!!}
					@include('admin.pages.notification.form')
					<div class="hr-line-dashed"></div>
					<div class="col-sm-6">
						<div class="form-group row">
							<div class="col-sm-12 col-sm-offset-12">
								<button class="btn btn-w-m btn btn-primary" type="submit">Save</button>
								<a href="javascript:void(0)" class="btn btn-w-m btn btn-primary sendme" type="submit" id="sendme">Send Now</a>
								<a href="{{route('admin.notification.index')}}"><button class="btn btn-w-m btn btn-danger" type="button">Cancel</button></a>
							</div>
						</div>
					</div>

					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

<script src="{{ asset('assets/admin/js/jquery-3.1.1.min.js')}}"></script>
<script type="text/javascript">
$(document).on("click","a.sendme",function(e){
        var title = $("#title").val();
        var message = $("#description").val();
        var url = $("#url").val();
        var send = "send";
        $.ajax({
        	url:"{{ route('admin.notification.store') }}",
        	type: 'post',
        	data: {title: title,message: message,url: url,send: send,"_token": "{{ csrf_token() }}"},
        	success:function(msg){
        		window.location.href = "{{ route('admin.notification.index') }}";
        	},
        	error:function(){
        		window.location.href = "{{ route('admin.notification.index') }}";
        	}
        });
     });
</script>