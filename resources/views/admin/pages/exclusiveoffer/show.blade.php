<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<th>Title</th>
			<td>{{$exclusiveoffer->title}}</td>
		</tr>
		<tr>
			<th>Images</th>
			<td>@if(!empty($exclusiveoffer->images))
				<img src="{{ asset("/storage/".@$exclusiveoffer->images) }}"  style="width:50px; height:50px;">
				@else
				<img src="{{ asset("/storage/exclusiveoffer/exclusiveoffer.png") }}"  style="width:50px; height:50px;">
				@endif
			</td>
		</tr>
		<tr>
			<th>Description</th>
			<td>{{$exclusiveoffer->description}}</td>
		</tr>
		<tr>
			<th>Start Date</th>
			<td>{{$exclusiveoffer->start_date}}</td>
		</tr>
		<tr>
			<th>End Date</th>
			<td>{{$exclusiveoffer->end_date}}</td>
		</tr>
	</table>
</div>