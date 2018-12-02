@extends('layouts/app')

@section('content')
	@exclamoflexsection
		<h3>@lang('messages.notes')</h3>

		<form method="POST" action="{{ route('notes.edit') }}">
    		@csrf
			<div class="form-group">
				<label for="note">
					@lang('messages.your_private_notes')
				</label>
				<textarea
					class="form-control"
					id="note"
					name="note"
					autofocus
					spellcheck="false"
				>{{ $note }}</textarea>
			</div>
			<button type="submit" class="cta cta-primary">@lang('messages.save')</button>
		</form>

	@endexclamoflexsection
@endsection