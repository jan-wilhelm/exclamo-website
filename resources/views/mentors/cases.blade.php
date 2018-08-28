@extends('layouts/app')

@section('content')
	@exclamosection ([ "classes" => "vdivide mt-sm-5" ])
		@bigstatistic (["value" => $statistics["numberOfCases"]])
			@lang('messages.incidents')
		@endbigstatistic

		@bigstatistic (["value" => $statistics["numberOfResolvedCases"]])
			@lang('messages.resolved_incidents')
		@endbigstatistic

		@bigstatistic (["value" => $statistics["numberOfMessages"]])
			@lang('messages.messages')
		@endbigstatistic
	@endexclamosection

	@exclamoflexsection
		<h3>
			@lang('messages.incidents')
		</h3>
		
		@casesview (["openCases" => $cases->where('solved', false), "resolvedCases" => $cases->where('solved', true), "userTag" => true])
			@slot('caseIsEmpty')
				@lang('messages.mentor_no_cases')
			@endslot
		@endcasesview

	@endexclamoflexsection
@endsection