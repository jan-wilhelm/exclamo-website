@extends('layouts/app')

@section('content')
	@exclamosection ([ "classes" => "vdivide mt-sm-5" ])
		@bigstatistic (["value" => $numberOfCases])
			@lang('messages.incidents')
		@endbigstatistic

		@bigstatistic (["value" => $numberOfResolvedCases])
			@lang('messages.resolved_incidents')
		@endbigstatistic

		@bigstatistic (["value" => $numberOfMessages])
			@lang('messages.messages')
		@endbigstatistic
	@endexclamosection

	@exclamoflexsection (["classes" => "bg-color-primary-1 text-white"])
		<h4>
			@lang('messages.incidents')
		</h4>
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
		<div class="create-case bg-color-primary-2 d-flex align-content-center transition">
			<a class="m-auto text-white" href="{{ route('incidents.report') }}">
				<i class="fas fa-plus mr-sm-1"></i>
				@lang('messages.createcase')
			</a>
		</div>
	@endexclamoflexsection
@endsection