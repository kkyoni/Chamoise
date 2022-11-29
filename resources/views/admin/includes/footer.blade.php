<div class="footer">
	<div>
		<strong>Copyright</strong> &copy; {{ date('Y') }} 
		@php
		$copyright = App\Models\Setting::where('code','copyright')->where('hidden','0')->first();
		@endphp
		{{@$copyright->value}}

	</div>
</div>
