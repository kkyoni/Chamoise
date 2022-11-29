<div class="form-group  row {{ $errors->has('images') ? 'has-error' : '' }}">
    <div id="imagePreview" class="profile-image">
        @if(!empty($exclusiveoffer->images))
        <img src="{!! @$exclusiveoffer->images !== '' ? url("storage/".@$exclusiveoffer->images) : url('storage/exclusiveoffer.png') !!}" alt="user-img" class="img-circle">
        @else
        <img src="{!! url('storage/exclusiveoffer/exclusiveoffer.png') !!}" alt="user-img" class="img-circle" accept="images/*">
        @endif
    </div>
    {!! Form::file('images',['id' => 'hidden','accept'=>"images/*"]) !!}
</div>
<div class="form-group row {{ $errors->has('title') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Title</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('title',null,['class' => 'form-control','id'    => 'title','maxlength' => '30']) !!}
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
        {!! Form::textarea('description',null,['class' => 'form-control ','id'    => 'description']) !!}
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
@endsection