<div class="row mb-4 p-3">
@foreach($cases as $case)
	<div class="case-card shadow bg-white col-lg-3 col-md-5 mr-lg-5 mr-md-3 mb-5 {{ $case->solved ? "case-solved" : "" }}">
		<div class="d-sm-flex justify-content-between">
			<a href="{{ route('incidents.show', ["case" => $case]) }}">
				<h5 class="font-weight-bold">{{ $case->title }}</h5>
			</a>
		</div>

		<span>
			@if($case->messages->count() > 0)
				{{ str_limit($case->messages->first()->body, 140) }}
			@endif
		</span>
		<div class="row d-none">
			<a href="{{ route('incidents.show', ["case" => $case]) }}">
				<h6 class="small mt-2">Zum Fall</h6>
			</a>
			<span class="small">
				@if($case->messages->count() > 0)
					{{ $case->messages->first()->updated_at->diffForHumans() }}
				@endif
			</span>
		</div>
	</div>
@endforeach
</div>