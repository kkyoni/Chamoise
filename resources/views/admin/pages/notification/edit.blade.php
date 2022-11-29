@extends('admin.layouts.app')
@section('title')
Notification Management - Edit
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
		<h2>Edit Notification</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Home</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route('admin.notification.index') }}">Notification Table</a>
			</li>
			<li class="breadcrumb-item active">
				<span class="label label-success float-right all_backgroud"><strong>Edit Notification Form</strong></span>
			</li>
		</ol>
	</div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox">
				<div class="ibox-content">
					{!!Form::model($notification,array('method'=>'post','files'=>true,'route'=>array('admin.notification.update',$notification->id)))!!}
					@include('admin.pages.notification.form')
					<div class="hr-line-dashed"></div>

					<div class="col-sm-6">
						<div class="form-group row">
							<div class="col-sm-8 col-sm-offset-8">
								<a href="{{route('admin.notification.index')}}"><button class="btn btn-danger btn-sm" type="button">Cancel</button></a>
								<button class="btn btn-primary btn-sm" type="submit">Save changes</button>
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