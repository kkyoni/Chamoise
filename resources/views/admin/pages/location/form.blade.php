<div class="form-group  row {{ $errors->has('image') ? 'has-error' : '' }}">
    <div id="imagePreview" class="profile-image">
        @if(!empty($location->image))
        <img src="{!! @$location->image !== '' ? url("storage/location/".@$location->image) : url('storage/location.png') !!}" alt="user-img" class="img-circle">
        @else
        <img src="{!! url('storage/location/location.png') !!}" alt="user-img" class="img-circle" accept="image/*">
        @endif
    </div> 
    {!! Form::file('image',['id' => 'hidden','accept'=>"image/*"]) !!}
</div>

<div class="form-group row {{ $errors->has('title') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Title</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('title',null,['class' => 'form-control','id'    => 'title']) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('title') ? "".$errors->first('title')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('address') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Address</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('address',null,['class' => 'form-control','id'    => 'search_input']) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('address') ? "".$errors->first('address')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('long') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Long</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('long',null,['class' => 'form-control','id'    => 'longitude_input','readonly']) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('long') ? "".$errors->first('long')."" : '' }} </font>
        </span>
    </div>
</div> 

<div class="form-group row {{ $errors->has('lat') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Lat</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('lat',null,['class' => 'form-control','id'    => 'latitude_input','readonly']) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('lat') ? "".$errors->first('lat')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('phone_number') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>phone</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('phone_number',null,['class' => 'form-control','id'    => 'phone_number']) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('phone_number') ? "".$errors->first('phone_number')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('shortdescription') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Short Description</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::textarea('shortdescription',null,['class' => 'form-control ','id'    => 'description']) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('shortdescription') ? "".$errors->first('shortdescription')."" : '' }} </font>
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

@if(!empty($location_images))
<div class="col-md-12 row">
@foreach($location_images as $images)
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

<div class="form-group row {{ $errors->has('video_url') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Video Url</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('video_url',null,['class' => 'form-control','id'    => 'video_url']) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('video_url') ? "".$errors->first('video_url')."" : '' }} </font>
        </span>
    </div>
</div>
@section('styles')
@endsection
@section('scripts')
<script>
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
                    url:"{{route('admin.location.remove_locationImage',[''])}}"+"/"+id,
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://demos.codexworld.com/includes/js/bootstrap.js"></script>
<!-- Google Maps JavaScript library -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDjE7JGXDfYyDI5SKta_oJ1eLxW1hbhGuM"></script>
<script>
var searchInput = 'search_input';
$(document).ready(function () {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
        types: ['geocode'],
    });
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        document.getElementById('latitude_input').value = near_place.geometry.location.lat();
        document.getElementById('longitude_input').value = near_place.geometry.location.lng();
        document.getElementById('latitude_view').innerHTML = near_place.geometry.location.lat();
        document.getElementById('longitude_view').innerHTML = near_place.geometry.location.lng();
    });
});
$(document).on('change', '#'+searchInput, function () {
    document.getElementById('latitude_input').value = '';
    document.getElementById('longitude_input').value = '';
    document.getElementById('latitude_view').innerHTML = '';
    document.getElementById('longitude_view').innerHTML = '';
});

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