@component('components.cases.cases_section', ["cases"=> $cases, "userTag"=> $userTag, "shouldBeSolved"=> false])
	@slot('otherComponents')
		@isset($otherComponents)
			{{ $otherComponents }}
		@endisset
	@endslot
@endcomponent

@component('components.cases.cases_section', ["cases"=> $cases, "userTag"=> $userTag, "shouldBeSolved"=> true])
@endcomponent