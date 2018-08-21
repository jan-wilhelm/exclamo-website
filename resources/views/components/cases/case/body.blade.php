<a href="{{ route('incidents.show', ["case" => $case]) }}">
	<h5 class="font-weight-bold">{{ $case->title }}</h5>
</a>

<span>
	@if($case->messages->count() > 0)
		{{ str_limit($case->messages->first()->body, 140) }}
	@endif
</span>