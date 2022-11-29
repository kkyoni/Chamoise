<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<th>Notification Title</th>
			<td>{{$transaction->notification_list->title}}</td>
		</tr>
		<tr>
			<th>Notification Message</th>
			<td>{{$transaction->notification_list->message}}</td>
		</tr>
		<tr>
			<th>Token</th>
			<td>{{$transaction->token}}</td>
		</tr>
		<tr>
			<th>Status</th>
			<td>
				@if($transaction->status == "unread")
				<span class="label label-warning">Unread</span>
				@else
				<span class="label label-success">Read</span>
				@endif
			</td>
		</tr>
	</table>
</div>