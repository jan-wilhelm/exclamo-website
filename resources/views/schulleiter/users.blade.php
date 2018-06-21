@extends('layouts/app')

@section('content')
	<div class="row section mt-sm-5 vdivide bg-white">
		<div class="col-sm-4 statistic">
			<span class="statistic-value align-middle mr-4 color-primary-2">
				{{ $numberOfUsers }}
			</span>
			<span class="color-primary-2 statistic-name align-middle">
				@lang('messages.students')
			</span>
		</div>
		<div class="col-sm-4 statistic">
			<span class="statistic-value align-middle mr-4 color-primary-2">
				{{ $numberOfTeachers }}
			</span>
			<span class="color-primary-2 statistic-name align-middle">
				@lang('messages.teachers')
			</span>
		</div>
		<div class="col-sm-4 statistic">
			<span class="statistic-value align-middle mr-4 color-primary-2">
				{{ $numberOfPrinciples }}
			</span>
			<span class="color-primary-2 statistic-name align-middle">
				@lang('messages.principles')
			</span>
		</div>
	</div>
	<div class="row section bg-white mt-5 d-flex flex-column">
		<h4>
			@lang('messages.students')
		</h4>
		<form class="form-inline search-form">
			<div class="row">
				<div class="input-group mb-2 row col-7 search-input">
					<label class="sr-only" for="search-vorname">
						@lang('messages.firstname')
					</label>
					<input type="text" class="form-control col-5" id="search-vorname" placeholder="@lang('messages.firstname')">

					<label class="sr-only" for="search-nachname">
						@lang('messages.lastname')
					</label>
				 	<input type="text" class="form-control col-5" id="search-nachname" placeholder="@lang('messages.lastname')">

					<label class="sr-only" for="search-klasse">
						@lang('messages.class')
					</label>
				 	<input type="text" class="form-control col-2" id="search-klasse" placeholder="@lang('messages.class')">
				</div>
				<div class="input-group mb-2 col-5 row search-settings ml-auto">
					<span class="col-7">
						@lang('messages.show')
						<input type="number" min="1" max="{{ Auth::user()->school->students()->count() }}" name="entries" value="{{ $elementsPerPage }}" class="form-control ml-auto">
						@lang('messages.records')
					</span>
					<div class="col-5">
						<button type="submit" class="btn btn-primary mb-2 ">
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
	</div>
@endsection