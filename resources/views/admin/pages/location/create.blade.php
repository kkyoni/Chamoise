@extends('admin.layouts.app')
@section('title')
Location Management - Create
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
		<h2>Add Location</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Home</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route('admin.location.index') }}">Location Table</a>
			</li>
			<li class="breadcrumb-item active">
				<span class="label label-success float-right all_backgroud"><strong>Add Location Form</strong></span>
			</li>
		</ol>
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox">
				<div class="ibox-content">
					{!! Form::open(['route'	=> ['admin.location.store'],'id'	=> 'InwordCreateForm','files' => 'true'])!!}
					@include('admin.pages.location.form')
					<div class="hr-line-dashed"></div>
					<div class="col-sm-6">
						<div class="form-group row">
							<div class="col-sm-8 col-sm-offset-8">
								<button class="btn btn-w-m btn btn-primary" type="submit">Save</button>
								<a href="{{route('admin.location.index')}}"><button class="btn btn-w-m btn btn-danger" type="button">Cancel</button></a>
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