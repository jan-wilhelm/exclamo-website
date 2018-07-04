@extends('layouts/app')

@section('content')
	@exclamoflexsection
		<div>
			<h4 class="d-md-inline-block">
				{{ $case->title }}
			</h4>
			<span class="d-inline-block font-italic">
				Mentored by {{ implode(", ", $case->mentors->map(function ($mentor) {
					$mentor->full_name = $mentor->first_name . " " . $mentor->last_name;
					return $mentor;
				})->pluck("full_name")->toArray()) }}
			</span>
		</div>
		<hr>

		<chat-messages-container :messages="{{ json_encode($messages) }}"> </chat-messages-container>

	@endexclamoflexsection
@endsection