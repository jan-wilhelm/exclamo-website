@extends('layouts/app')

@section('content')

	@exclamoflexsection
		<h3>
			@lang('messages.impressum')
		</h3>

			@include('components.impressum_text')
	@endexclamoflexsection
@endsection