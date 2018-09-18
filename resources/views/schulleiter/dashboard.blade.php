@extends('layouts/app')

@section('content')
	<div class="row d-flex">
		<div class="col-6 py-0">
			<user-login-statistics
				:chart-data='@json($loginStatistics)'
				variant="small"
				class="shadow">
			</user-login-statistics>
		</div>
		<div class="col-6 py-0">
			<user-login-statistics variant="small" class="shadow" />
		</div>
	</div>

	@exclamoflexsection
		<h3>
			@lang('messages.dashboard')
		</h3>
		<div class="w-100 d-flex flex-column text-center">
			<p>
				@lang('messages.welcome_messages', ['name'=> auth()->user()->full_name])
			</p>
		</div>
	@endexclamoflexsection
@endsection