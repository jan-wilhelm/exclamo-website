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
		<h3>
			@lang('messages.incidents')
		</h3>
		
		@casesview (["cases" => $cases])
		@endcasesview

		<div class="create-case bg-color-primary-2 d-flex align-content-center transition">
			<a class="m-auto text-white" href="{{ route('incidents.report') }}">
				<i class="fas fa-plus mr-sm-1"></i>
				@lang('messages.createcase')
			</a>
		</div>
	@endexclamoflexsection
@endsection