<div class="form-group row {{ $errors->has('title') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Title</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('title',null,[
        'class' => 'form-control',
        'id'    => 'title',
        'maxlength' => '30'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('title') ? "".$errors->first('title')."" : '' }} </font>
        </span>
    </div>
</div>
<div class="form-group row {{ $errors->has('description') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Description</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        
        {!! Form::textarea('description',null,[
        'class' => 'form-control ',
        'id'    => 'description'
        ]) !!}

        <span class="help-block">
            <font color="red"> {{ $errors->has('description') ? "".$errors->first('description')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('start_date') ? 'has-error' : '' }}" id="data_1">
    <label class="col-sm-3 col-form-label font-normal">
        <strong>Start Date</strong>
        <span class="text-danger"></span>
    </label>
    <div class="col-sm-6">
        <div class="input-group date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <input type="text" class="form-control" name="start_date" value="<?php echo date("Y/m/d") ?>">
        </div>
        <span class="help-block">
            <font color="red"> {{ $errors->has('start_date') ? "".$errors->first('start_date')."" : '' }} </font>
        </span>
    </div>
</div>


<div class="form-group row {{ $errors->has('end_date') ? 'has-error' : '' }}" id="data_2">
    <label class="col-sm-3 col-form-label font-normal">
        <strong>End Date</strong>
        <span class="text-danger"></span>
    </label>
    <div class="col-sm-6">
        <div class="input-group date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <input type="text" class="form-control" name="end_date" value="<?php echo date("Y/m/d") ?>">
        </div>
        <span class="help-block">
            <font color="red"> {{ $errors->has('end_date') ? "".$errors->first('end_date')."" : '' }} </font>
        </span>
    </div>
</div>


<div class="form-group row {{ $errors->has('image_name') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Multiple Image</strong>
        <span class="text-danger"></span>
    </label>
    <div class="col-sm-6">
        <label class="custom-file-label col-sm-12" for="validationCustom10"><strong>Choose file...</strong></label>
        <input id="logo" name="image_name[]" type="file" class="custom-file-input" multiple>
        <span class="help-block">
            <font color="red"> {{ $errors->has('image_name') ? "".$errors->first('image_name')."" : '' }} </font>
        </span>
    </div>
</div>


@if(!empty($promotions_images))
<div class="col-md-12 row">
@foreach($promotions_images as $images)
    <div class="col-md-2" id="image_{{$images->id}}">
        <div>
            <img src="{{ asset("/storage/".@$images->image) }}"  style="width:100px; height:100px;">
        </div>
        <div class="right_image_section_remove_button">
            <a href="JavaScript:Void();" id="remove_image"  class="remove_image btn btn-danger btn-xs" data-id="{{$images->id}}"><span class="fa fa-trash"></span></a>
        </div>
    </div>
@endforeach
</div>
@endif

@section('styles')
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    var date = new Date();
    date.setDate(date.getDate());
    var mem = $('#data_1 .date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        startDate: date,
        format: "yyyy/mm/dd",
        viewMode: "date", 
        minViewMode: "date"
    });

    var mem = $('#data_2 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        startDate: date,
        format: "yyyy/mm/dd",
        viewMode: "date", 
        minViewMode: "date"
    });
});
</script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#imagePreview img').on('click',function(){
        $('.imagePreview').trigger('click');
        $('.imagePreview').change(function() {
            readURL(this);
        });
    });

    $(document).on("click",".remove_image",function(e){
        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e69a2a",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:"{{route('admin.promotions.remove_promotionsImage',[''])}}"+"/"+id,
                    type: 'get',
                    data: {_method: 'delete'},
                success:function(msg){
                    if(msg.status == 'success'){
                        $("#image_"+id).fadeOut();
                        swal("Deleted!",  msg.message, "success");
                    }else{
                        swal("Warning!", msg.message, "warning");               
                    }
                },
                error:function(){
                    swal("Error!", 'Error in delete Record', "error");
                }
            });
            } else {
                swal("Cancelled", "Your image is safe :)", "error");
            }
        });
        return false;
    })
</script>
@endsection