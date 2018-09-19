@extends('layouts/app')

@section('content')
	<div class="row d-flex">
		<div class="col-4 py-0">
			<div class="shadow stats-container">
				<user-login-statistics
					chart-width='auto'
					chart-height='auto'
					:chart-data='@json($loginStatistics)'
					variant="small">
				</user-login-statistics>
			</div>
		</div>
		<div class="col-4 py-0">
			<div class="shadow stats-container">
				<user-login-statistics
					chart-width='auto'
					chart-height='auto'
					:chart-data='@json($loginStatistics)'
					variant="small">
				</user-login-statistics>
			</div>
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