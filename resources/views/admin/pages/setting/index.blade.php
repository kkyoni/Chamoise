@extends('admin.layouts.app')
@section('title')
Setting Management
@endsection
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12">
		<h2><i class="fa fa-cog" aria-hidden="true"></i> Setting Management</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Home</a>
			</li>
			<li class="breadcrumb-item active">
				<span class="label label-success float-right" style="background-color: #5A8DEE;">Setting Table</span>
				<!-- <strong>Setting Table</strong> -->
			</li>
		</ol>
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-content">
					<div class="col-md-12 text-left">




								
						
						<div class="clearfix"></div>
					</div>
					<div class="col-md-12">
						<div class="table-responsive">
							{!! $html->table(['class' => 'table table-striped table-bordered dt-responsive'], true) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')

<style type="text/css">
	table.dataTable {
		clear: both;
		margin-top: 6px !important;
		margin-bottom: 6px !important;
		max-width: none !important;
		border-collapse: separate !important;
		width: 100% !important;
	}
	.op-btn{
		margin-right:22px;
	}
</style>

<link rel="stylesheet" type="text/css"  href="{{ asset('new/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" type="text/css"  href="{{ asset('new/buttons.dataTables.min.css') }}" />
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
{!! $html->scripts() !!}
<script>
		$(document).on("click",".changeStatusRecord",function(e){
		var row = $(this);
		var id = $(this).attr('data-id');
		swal({
			title: "Are you sure?",
			text: "You want's to update this record status ",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#e69a2a",
			confirmButtonText: "Yes, updated it!",
			cancelButtonText: "No, cancel plx!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function(isConfirm){
			if (isConfirm) {
				$.ajax({
					url:"{{ route('admin.setting.change_status','replaceid') }}",
					type: 'post',
					data: {"_method": 'post',
						'id':id,
						"_token": "{{ csrf_token() }}"
					},
				success:function(msg){
					if(msg.status == 'success'){
						swal({title: "Status",text: "Status Record success",type: "success"},
							function(){ 
								location.reload();
							});
					}else{
						swal("Warning!", msg.message, "warning");
					}
				},
				error:function(){
					swal("Error!", 'Error in updated Record', "error");
				}
			});
				//swal("Updated!", "Status has been updated.", "success");

			} else {
				swal("Cancelled", "Your Setting Status is safe :)", "error");
			}
		});
		return false;
	})
</script>
@endsection