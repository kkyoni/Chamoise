<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<th>Title</th>
			<td>{{$promotions->title}}</td>
		</tr>
		@if(sizeof($promotions_images) > 0)
		<tr>
			<th>Image Promotions</th>
			<td>
				@foreach($promotions_images as $images)
				<img src="{{ asset("/storage/".@$images->image) }}"  style="width:50px; height:50px;">
				@endforeach

			</td>
		</tr>
		@endif
		<tr>
			<th>Description</th>
			<td>{{$promotions->description}}</td>
		</tr>
		
		<tr>
			<th>Start Date</th>
			<td>{{$promotions->start_date}}</td>
		</tr>
		<tr>
			<th>End Date</th>
			<td>{{$promotions->end_date}}</td>
		</tr>
	</table>
</div>