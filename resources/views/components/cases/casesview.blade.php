<h5>
	@lang('messages.open_cases')
</h5>
@component('components.cases.cases_section', ["cases"=> $cases, "userTag"=> isset($userTag) && $userTag, "shouldBeSolved"=> false])
	@slot('otherComponents')
		@isset($otherComponents)
			{{ $otherComponents }}
		@endisset
	@endslot
@endcomponent

<h5>
	@lang('messages.resolved_incidents')
</h5>
@component(
	'components.cases.cases_section', [
		"cases"=> $cases,
		"userTag"=> isset($userTag) && $userTag,
		"shouldBeSolved"=> true
	])
@endcomponent