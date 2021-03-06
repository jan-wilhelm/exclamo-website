@extends('layouts/app')

@section('content')
	@exclamoflexsection (["classes" => "bg-color-primary-3 text-white"])
		<h3>@lang('messages.createcase')</h3>
		
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
			:possible-mentors='@json($possibleMentors)'
			:maximum-mentors='{{ config('exclamo.number_of_mentors') }}'
			:use-locations='Boolean({{ auth()->user()->school->uses_locations }})'
			:use-dates='Boolean({{ auth()->user()->school->uses_dates }})'
		/>
	@endexclamoflexsection
@endsection