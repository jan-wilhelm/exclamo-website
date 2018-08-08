@foreach($cases as $case)
	<div class="case-card text-white {{ $case->solved ? "case-solved" : "" }}">
		<div class="d-sm-flex justify-content-between">
			<a href="{{ route('incidents.show', ["case" => $case]) }}">
				<h6 class="font-weight-bold text-white">{{ $case->title }}</h6>
			</a>
			{{ $case->updated_at }}
			<span class="small">
				@if($case->messages->count() > 0)
					{{ $case->messages->first()->updated_at->diffForHumans() }}
				@endif
			</span>
		</div>
		<span>

			@if($case->messages->count() > 0)
				{{ str_limit($case->messages->first()->body, 140) }}
			@endif
		</span>
	</div>
@endforeach