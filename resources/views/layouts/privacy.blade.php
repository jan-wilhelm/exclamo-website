@extends('layouts/app')

@section('content')

	@exclamoflexsection
		<h3>
			@lang('messages.privacy_policy')
		</h3>

			@include('components.privacy_text')
	@endexclamoflexsection
@endsection