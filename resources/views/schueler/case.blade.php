@extends('layouts/app')

@section('content')
	@exclamoflexsection
		@component('components.cases.case.index')
			@slot ('title')
				{{ $case->title }}
			@endslot

			@slot ('description')
				Mentored by {{ implode(", ", $case->mentors->pluck("full_name")->toArray()) }}
			@endslot

			@slot ('header')
				<case-options-modal
					:initial-data='@json($clientData)'
					:categories='@json($categories)'
					:mentors='@json($possibleMentors)'
					:locations='@json($locations)'
					:maximum-mentors='{{ config('exclamo.number_of_mentors') }}'
				/>
			@endslot

			@slot ('messages')
				{{ json_encode($messages) }}
			@endslot
		@endcomponent

	@endexclamoflexsection
@endsection