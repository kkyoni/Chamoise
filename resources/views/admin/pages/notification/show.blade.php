<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<th>Title</th>
			<td>{{$notification->title}}</td>
		</tr>
		<tr>
			<th>Message</th>
			<td>{{$notification->message}}</td>
		</tr>
		<tr>
			<th>URL</th>
			<td><a href="{{$notification->url}}" class="label label-primary" target="_blank"> Click Here </a></td>
		</tr>
	</table>
</div>