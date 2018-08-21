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
			<div class="d-flex flex-column case-card create-case shadow col-lg-3 col-md-5 py-5 align-items-center justify-content-center">
				<a href="{{ route('incidents.report') }}" class="text-center">
					<h5 class="font-weight-bold">
						@lang('messages.createcase')
					</h5>
					<i class="fas fa-plus fa-4x color-primary-1"></i>
				</a>
			</div>
		@endcasesview
	@endexclamoflexsection
@endsection