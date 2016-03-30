@if ($data = session('response'))
<div @if ($data['status'] == 'error') class="ui negative icon message" @else class="ui positive icon message" @endif>
	@if($data['status'] == 'error')
	<i class="icon icons"><i class="icon database"></i><i class="inverted corner warning sign icon"></i></i>
	@else
	<i class="icon icons"><i class="icon database"></i><i class="inverted corner checkmark icon"></i></i>
	@endif
	<i class="close icon"></i>
	<div class="content">
		<div class="header">
			@if ($data['status'] == 'error') Error @else Success @endif
		</div>
		<p>
			@if ($data['message']) {!! $data['message'] !!} @endif
		</p>
	</div>
</div>
@endif