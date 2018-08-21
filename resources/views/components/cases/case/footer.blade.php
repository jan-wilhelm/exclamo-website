<a class="small" href="{{ route('incidents.show', ["case" => $case]) }}">
	Zum Fall
</a>
<span class="small">
	@if($case->messages->count() > 0)
		{{ $case->messages->first()->updated_at->diffForHumans() }}
	@endif
</span>