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

<div class="form-group row {{ $errors->has('message') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Message</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::textarea('message',null,[
        'class' => 'form-control ',
        'id'    => 'description'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('message') ? "".$errors->first('message')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('url') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Url</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('url',null,[
        'class' => 'form-control',
        'id'    => 'url'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('url') ? "".$errors->first('message')."" : '' }} </font>
        </span>
    </div>
</div>
@section('styles')
@endsection
@section('scripts')
@endsection