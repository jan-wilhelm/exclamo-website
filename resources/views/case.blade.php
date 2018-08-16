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
			<case-options-modal case-data='{"anonymous": true}' :categories='@json($categories)' :selected-category='Number({{ $selectedCategory }})' />
		</div>
		<hr>

		<chat-messages-container :messages="{{ json_encode($messages) }}" />

	@endexclamoflexsection
@endsection