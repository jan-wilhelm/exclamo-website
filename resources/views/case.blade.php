@extends('layouts/app')

@section('content')
	@exclamoflexsection
		<div>
			<h4 class="d-md-inline-block">
				{{ $case->title }}
			</h4>
			<span class="d-md-inline-block font-italic ml-md-4">
				Mentored by {{ implode(", ", $case->mentors->map(function ($mentor) {
					$mentor->full_name = $mentor->first_name . " " . $mentor->last_name;
					return $mentor;
				})->pluck("full_name")->toArray()) }}
			</span>
			<div class="form-inline button-div bordered white hover mt-md-0 mt-3 float-md-right ">
				<a href="#" class="mx-auto" v-b-modal.case-options-modal>
					Optionen
				</a>
			</div>
			<case-options-modal />
		</div>
		<hr>

		<chat-messages-container :messages="{{ json_encode($messages) }}"> </chat-messages-container>

	@endexclamoflexsection
@endsection