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
		<h3>
			@lang('messages.students')
		</h3>
		<students-table
			:students='@json($studentsCollection)'
		/>
	@endexclamosection
@endsection