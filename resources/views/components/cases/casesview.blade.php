<h5>Open Cases</h5>
@component('components.cases.cases_section', ["cases"=> $cases, "userTag"=> isset($userTag) && $userTag, "shouldBeSolved"=> false])
	@slot('otherComponents')
		@isset($otherComponents)
			{{ $otherComponents }}
		@endisset
	@endslot
@endcomponent

<h5>Resolved Cases</h5>
@component('components.cases.cases_section', ["cases"=> $cases, "userTag"=> isset($userTag) && $userTag, "shouldBeSolved"=> true])
@endcomponent