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
		<h4>@lang('messages.incidents')</h4>
		@foreach($cases as $case)
			<div class="case-card text-white {{ $case->solved ? "case-solved" : "" }}">
				<h6>{{ $case->title }}</h6>
				<span>ID: #{{ $case->id }}</span>
				<span>Update vom {{ $case->messages->first()->updated_at }}</span>
			</div>
		@endforeach
	@endexclamoflexsection
@endsection