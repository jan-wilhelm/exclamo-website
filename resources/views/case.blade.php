@extends('layouts/app')

@section('content')
	@exclamoflexsection
		<div>
			<h4 class="d-md-inline-block">
				{{ $case->title }}
			</h4>
			<span class="d-md-inline-block font-italic ml-md-4">
				Mentored by {{ implode(", ", $case->mentors->map(function ($mentor) {
					$mentor->full_name = $mentor->fullName();
					return $mentor;
				})->pluck("full_name")->toArray()) }}
			</span>
			<div>
			</div>

			<case-options-modal case-data='{"anonymous": true}' />
		</div>
		<hr>

		<chat-messages-container :messages="{{ json_encode($messages) }}" />

	@endexclamoflexsection
@endsection