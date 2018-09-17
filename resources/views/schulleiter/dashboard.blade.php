@extends('layouts/app')

@section('content')

	@exclamoflexsection
		<h3>
			@lang('messages.dashboard')
		</h3>
		<div class="w-100 d-flex flex-column text-center">
			<p>
				@lang('messages.welcome_messages', ['name'=> auth()->user()->full_name])
			</p>
		</div>
		<user-login-statistics />
	@endexclamoflexsection
@endsection