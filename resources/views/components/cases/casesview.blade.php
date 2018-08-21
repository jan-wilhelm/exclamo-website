<div class="row mb-4 p-3 d-flex justify-content-center">
	@foreach($cases as $case)
	<div class="d-flex flex-column case-card shadow col-xl-3 col-md-5 mr-xl-5 mr-md-3 mb-5 {{ $case->solved ? "case-solved" : "" }}">
		<div class="mb-auto pb-2">
			<a href="{{ route('incidents.show', ["case" => $case]) }}">
				<h5 class="font-weight-bold">{{ $case->title }}</h5>
			</a>

			<span>
				@if($case->messages->count() > 0)
					{{ str_limit($case->messages->first()->body, 140) }}
				@endif
			</span>
		</div>
		<hr>
		<div class="d-flex flex-column">
			<div class="mb-3">
				<span class="tag">
					<i class="fas fa-user-friends mr-1"></i>
					{{ $case->mentors->count() }} Mentors
				</span>
			</div>
			<div class="d-flex align-items-end justify-content-between">
				<a class="small" href="{{ route('incidents.show', ["case" => $case]) }}">
					Zum Fall
				</a>
				<span class="small">
					@if($case->messages->count() > 0)
						{{ $case->messages->first()->updated_at->diffForHumans() }}
					@endif
				</span>
			</div>
		</div>
	</div>
	@endforeach
	{{ $slot }}
</div>