@if($openCases->count() + $resolvedCases->count() == 0)
	{{ $caseIsEmpty }}
@else
	
	@if($openCases->count() > 0)
		<h5>
			@lang('messages.open_cases')
		</h5>
		@component(
			'components.cases.cases_section', [
				"cases"=> $openCases,
				"userTag"=> isset($userTag) && $userTag
			])
			@slot('otherComponents')
				@isset($otherComponents)
					{{ $otherComponents }}
				@endisset
			@endslot
		@endcomponent
	@else
		@isset($otherComponents)
			@component(
				'components.cases.cases_section', [
					"cases"=> [],
					"userTag"=> isset($userTag) && $userTag
				])
				@slot('otherComponents')
					{{ $otherComponents }}
				@endslot
			@endcomponent
		@endisset
	@endif
	@if($resolvedCases->count() > 0)
		<h5>
			@lang('messages.resolved_incidents')
		</h5>
		@component(
			'components.cases.cases_section', [
				"cases"=> $resolvedCases,
				"userTag"=> isset($userTag) && $userTag
			])
		@endcomponent
	@endif
@endif