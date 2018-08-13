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
			<div class="form-inline button-div bordered white hover mt-md-0 mt-3 float-md-right justify-content-center">
				<a href="#" class="mx-3"  data-toggle="modal" data-target="#case-options-modal">
					Optionen
				</a>
			</div>
			<case-options-modal case-data='{"anonymous": true}' />
		</div>
		<hr>

		<chat-messages-container :messages="{{ json_encode($messages) }}" />

	@endexclamoflexsection
@endsection