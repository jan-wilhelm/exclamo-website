@component('components.cases.cases_section', ["cases"=> $cases, "shouldBeSolved"=> false])
	@slot('otherComponents')
		{{ $otherComponents }}
	@endslot
@endcomponent

@component('components.cases.cases_section', ["cases"=> $cases, "shouldBeSolved"=> true])
@endcomponent