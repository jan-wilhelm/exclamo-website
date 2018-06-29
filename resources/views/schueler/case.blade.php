@extends('layouts/app')

@section('content')
	@exclamoflexsection
		<h4>
			{{ $case->title }}
		</h4>
		<span class="font-italic">
			Mentored by {{ implode(", ", $case->mentors->map(function ($mentor) {
				$mentor->full_name = $mentor->first_name . " " . $mentor->last_name;
				return $mentor;
			})->pluck("full_name")->toArray()) }}
		</span>
		<hr>
		@exclamocasemessages (["case" => $case])
		@endexclamocasemessages
		<form class="form-inline message-form" method="post" action="{{ route('sendmessage') }}">
			@csrf
			<input type="text" class="form-control col-md-10 col-sm-9 col-12" name="message" placeholder="@lang('placeholders.message')">
			<input type="number" class="d-none" name="case" value="{{ $case->id }}">
			<button type="submit" class="btn btn-primary col-md-2 col-sm-3 col-4"><i class="fas fa-paper-plane"></i></button>
		</form>
	@endexclamoflexsection
@endsection

@push('scripts')
	<script type="text/javascript">
		$('document').ready(function() {
			var cont = document.getElementById("chat-container");
			cont.scrollTop = cont.scrollHeight;
		})
	</script>
@endpush