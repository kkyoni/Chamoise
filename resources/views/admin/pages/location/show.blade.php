<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<th>Title</th>
			<td>{{$location->title}}</td>
		</tr>
		<tr>
			<th>Image</th>
			<td>@if(!empty($location->image))
				<img src="{!! @$location->image !== '' ? url("storage/location/".@$location->image) : url('storage/location.png') !!}" alt="user-img" class="img-circle" style="height: 50px; width: 50px; border-radius: 50px;">
				@else
				<img src="{!! url('storage/location/location.png') !!}" alt="user-img" class="img-circle" accept="image/*" style="height: 100px; width: 100px; border-radius: 50px;">
				@endif
			</td>
		</tr>
		<tr>
			<th>Address</th>
			<td>{{$location->address}}</td>
		</tr>
		<tr>
			<th>Lat</th>
			<td>{{$location->lat}}</td>
		</tr>
		<tr>
			<th>Long</th>
			<td>{{$location->long}}</td>
		</tr>
		<tr>
			<th>Short Description</th>
			<td>{{$location->shortdescription}}</td>
		</tr>
		@if(sizeof($location_images) > 0)
		<tr>
			<th>Multiple Image Location</th>
			<td>
			@foreach($location_images as $images)
			<img src="{{ asset("/storage/".@$images->image) }}"  style="width:50px; height:50px;">
			@endforeach
			</td>
		</tr>
		@endif
		<tr>
			<th>Video Url</th>
			<td><a href="{{$location->video_url}}" class="label label-primary" target="_blank"> Click Here </a></td>
		</tr>
	</table>
</div>