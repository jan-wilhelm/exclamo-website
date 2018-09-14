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
	@exclamoflexsection
		<div class="row">
			<h4 class="col">
				@lang('messages.students')
			</h4>
		</div>
		<students-table
			:students='@json($studentsCollection)'
		/>
	@endexclamosection
@endsection