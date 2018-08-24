@extends('layouts/app')

@section('content')
	@exclamoflexsection (["classes" => "bg-color-primary-3 text-white"])
		<h4>@lang('messages.createcase')</h4>
		
		@if ($errors->any())
            @foreach ($errors->all() as $error)
            	<div class="alert alert-warning">
            		<span class="font-weight-bold">Error: </span> {{ $error }}
            	</div>
            @endforeach
		@endif
		<report-case-form
			:form-endpoint='"{{ route('incidents.store') }}"'
			:possible-locations='@json(auth()->user()->school->locations)'
			:possible-categories='@json(config('exclamo.categories'))'
			:possible-mentors='@json(auth()->user()->school->users()->mentor()->mentoring()->get()->map(function($mentor, $index) {
								return [
									"id" => $mentor->id,
									"name" => $mentor->full_name
								];
							}))'
		/>
	@endexclamoflexsection
@endsection