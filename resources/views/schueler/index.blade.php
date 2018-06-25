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

	@exclamoflexsection
		<h4>@lang('messages.incidents')</h4>
	@endexclamoflexsection
@endsection