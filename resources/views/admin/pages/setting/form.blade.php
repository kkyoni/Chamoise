<div class="form-group row {{ $errors->has('code') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Code</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('code',null,[
        'class' => 'form-control',
        'id'    => 'code',
        'disabled'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('code') ? "".$errors->first('code')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('type') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Type</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('type',null,[
        'class' => 'form-control',
        'id'    => 'type',
        'disabled'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('type') ? "".$errors->first('type')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('label') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Label</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('label',null,[
        'class' => 'form-control',
        'id'    => 'label',
        'disabled'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('label') ? "".$errors->first('label')."" : '' }} </font>
        </span>
    </div>
</div>

@if(@$setting->type == 'FILE')
<div class="form-group  row {{ $errors->has('name') ? 'has-error' : '' }}">
    <div id="imagePreview" class="profile-image">
        @if(!empty($setting->value))
        <img src="{!! @$setting->value !== '' ? asset("storage/setting/".@$setting->value) : asset('storage/default.png') !!}" alt="user-img" class="img-circle">
        @else
        <img src="{!! asset('storage/setting/default.png') !!}" alt="user-img" class="img-circle" accept="image/*">
        @endif
    </div>
    {!! Form::file('value',['id' => 'hidden','accept'=>"image/*"]) !!}
    <input type="hidden" name="check" value="1">
</div>
@else
<div class="form-group row {{ $errors->has('value') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>value</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('value',null,[
        'class' => 'form-control',
        'id'    => 'value',
        'maxlength' => '30'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('value') ? "".$errors->first('value')."" : '' }} </font>
        </span>
    </div>
</div>
@endif

<div class="form-group row {{ $errors->has('hidden') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Hidden</strong>
    </label>
    <div class="col-sm-6 inline-block">
        <div class="i-checks">
            <label>
                {{ Form::radio('hidden', '0' ,true,['id'=> '0']) }} <i></i> Active
            </label>
            <label>
                {{ Form::radio('hidden', '1' ,false,['id' => '1']) }} <i></i> Inactive
            </label>
        </div>
        <span class="help-block">
            <font color="red">  {{ $errors->has('hidden') ? "".$errors->first('hidden')."" : '' }} </font>
        </span>
    </div>
</div>
@section('styles')
<style type="text/css">
.help-block {display: inline-block; margin-top: 5px; margin-bottom: 0px; margin-left: 5px;}
.form-group {margin-bottom: 10px;}
.form-control {font-size: 14px; font-weight: 500;}
#hidden{display: none !important;}
.help-block {
        display: inline-block;
        margin-top: 5px;
        margin-bottom: 0px;
        margin-left: 5px;
    }
    .form-group {
        margin-bottom: 10px;
    }
    .form-control {
        font-size: 14px;
        font-weight: 500;
    }
    #imagePreview{
        width: 100%;
        height: 100%;
        text-align: center;
        margin: 0 auto;
        position: relative;
    }
    #hidden{
        display: none !important;
    }
    #imagePreview img {
        height: 150px;
        width: 150px;
        border: 3px solid rgba(0,0,0,0.4);
        padding: 3px;
    }
    #imagePreview i{
        position: absolute;
        right: -18px;
        background: rgba(0,0,0,0.5);
        padding: 5px;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        color: #fff;
        font-size: 18px;
    }
</style>
@endsection

@section('scripts')
<link href="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}" rel="stylesheet">
<script type="text/javascript">
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
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
        $('input[type="file"]').trigger('click');
        $('input[type="file"]').change(function() {
            readURL(this);
        });
    });
</script>
@endsection