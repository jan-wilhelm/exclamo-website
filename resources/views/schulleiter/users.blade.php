@extends('layouts/app')

@section('content')
	@exclamosection ([ "classes" => "vdivide mt-sm-5" ])
		@bigstatistic (["value" => $numberOfUsers])
			@lang('messages.students')
		@endbigstatistic

		@bigstatistic (["value" => $numberOfTeachers])
			@lang('messages.teachers')
		@endbigstatistic

		@bigstatistic (["value" => $numberOfPrinciples])
			@lang('messages.principles')
		@endbigstatistic
	@endexclamosection
	@exclamosection ([ "classes" => "vdivide mt-sm-5" ])
		@bigstatistic (["value" => $numberOfUsers])
			@lang('messages.students')
		@endbigstatistic

		@bigstatistic (["value" => $numberOfTeachers])
			@lang('messages.teachers')
		@endbigstatistic

		@bigstatistic (["value" => $numberOfPrinciples])
			@lang('messages.principles')
		@endbigstatistic
	@endexclamosection
	@exclamosection ([ "classes" => "vdivide mt-sm-5" ])
		@bigstatistic (["value" => $numberOfUsers])
			@lang('messages.students')
		@endbigstatistic

		@bigstatistic (["value" => $numberOfTeachers])
			@lang('messages.teachers')
		@endbigstatistic

		@bigstatistic (["value" => $numberOfPrinciples])
			@lang('messages.principles')
		@endbigstatistic
	@endexclamosection
	@exclamosection ([ "classes" => "vdivide mt-sm-5" ])
		@bigstatistic (["value" => $numberOfUsers])
			@lang('messages.students')
		@endbigstatistic

		@bigstatistic (["value" => $numberOfTeachers])
			@lang('messages.teachers')
		@endbigstatistic

		@bigstatistic (["value" => $numberOfPrinciples])
			@lang('messages.principles')
		@endbigstatistic
	@endexclamosection
	@exclamosection ([ "classes" => "vdivide mt-sm-5" ])
		@bigstatistic (["value" => $numberOfUsers])
			@lang('messages.students')
		@endbigstatistic

		@bigstatistic (["value" => $numberOfTeachers])
			@lang('messages.teachers')
		@endbigstatistic

		@bigstatistic (["value" => $numberOfPrinciples])
			@lang('messages.principles')
		@endbigstatistic
	@endexclamosection
	@exclamoflexsection
		<h4>
			@lang('messages.students')
		</h4>
		<form class="form-inline search-form">
			<div class="row">
				<div class="input-group mb-2 col-md-7 col-12 search-input">
					<label class="sr-only" for="search-vorname">
						@lang('messages.firstname')
					</label>
					<input type="text" class="form-control col-5" id="search-vorname" name="search-vorname" placeholder="@lang('messages.firstname')" value="{!! session('firstName') !!}">

					<label class="sr-only" for="search-nachname">
						@lang('messages.lastname')
					</label>
				 	<input type="text" class="form-control col-5" id="search-nachname" name="search-nachname" placeholder="@lang('messages.lastname')" value="{!! session('lastName') !!}">

					<label class="sr-only" for="search-klasse">
						@lang('messages.class')
					</label>
				 	<input type="text" class="form-control col-2" id="search-klasse" placeholder="@lang('messages.class')" value="{!! session('userClass') !!}">
				</div>
				<div class="input-group mb-2 col-md-5 col-12 search-settings ml-md-auto text-center">
					<span class="col-6 mb-md-0 mb-2">
						@lang('messages.show')
						<input type="number" min="1" max="{{ Auth::user()->school->students()->count() }}" name="entries" value="{!! session('usersPerPage') !!}" class="d-inline-block form-control ml-md-auto">
						@lang('messages.records')
					</span>
					<div class="col-6">
						<button type="submit" class="btn btn-primary mb-md-2 ">
							@lang('messages.search')
						</button>
					</div>
				</div>
			</div>
		</form>
		<hr class="mb-0">
		<table class="mb-3 students-table">
			<tr>
				<th>
					@lang('messages.name')
				</th>
				<th>
					@lang('messages.incidents')
				</th>
			</tr>
			@foreach ($users as $user)
				<tr>
					<td>
						<a href="{{ route('users.show', ['user'=> $user]) }}">
							{{ $user->first_name . " " . $user->last_name }}
						</a>
					</td>
					<td>{{ $user->reported_cases_count }}</td>
				</tr>
			@endforeach
		</table>
		{{ $users->appends($oldInput)->links() }}
	@endexclamosection
@endsection