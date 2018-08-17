@extends('layouts/app')

@section('content')
	@exclamoflexsection
		<div>
			<h4 class="d-md-inline-block">
				{{ $case->title }}
			</h4>
			<span class="d-md-inline-block font-italic ml-md-4">
				Mentored by {{ implode(", ", $case->mentors->pluck("full_name")->toArray()) }}
			</span>
			<case-options-modal
				:initial-data='@json($clientData)'
				:categories='@json($categories)'
				:mentors='@json($possibleMentors)'
			/>
		</div>
		<hr>

		<chat-messages-container :messages="{{ json_encode($messages) }}" />

	@endexclamoflexsection
@endsection