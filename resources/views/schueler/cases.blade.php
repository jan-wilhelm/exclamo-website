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
		
		@casesview (["openCases" => $cases->where('solved', false), "resolvedCases" => $cases->where('solved', true)])
			@slot('otherComponents')
				<div class="col-xl-4 col-md-6 px-2 py-3">
					<div class="d-flex flex-column case-card shadow w-100 h-100 align-items-center justify-content-center">
						<a href="{{ route('incidents.report') }}" class="text-center">
							<h5 class="font-weight-bold">
								@lang('messages.createcase')
							</h5>
							<i class="fas fa-plus fa-4x color-primary-1"></i>
						</a>
					</div>
				</div>
			@endslot
			@slot('caseIsEmpty')
				<div class="row text-center mb-3">
					<div class="col-12">
						@lang('messages.you_have_no_case')
					</div>
				</div>
				<div class="row pb-4 justify-content-center text-center">
					<div class="col-12">
						<div class="cta cta-primary">
							@lang('messages.createcase')
						</div>
					</div>
				</div>
			@endslot
		@endcasesview
	@endexclamoflexsection
@endsection