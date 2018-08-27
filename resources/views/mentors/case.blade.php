@extends('layouts/app')

@section('content')
	@exclamoflexsection
		@component('components.cases.case.index')
			@slot ('title')
				{{ $case->title }}
			@endslot

			@slot ('description')
				@if ($case->anonymous)
					@lang('messages.creator_is_anonymous')
				@else
					@lang('messages.case_created_by',[
						'name'=> $case->victim->full_name	
					])
				@endif
			@endslot

			@slot ('messages')
				{{ json_encode($messages) }}
			@endslot
		@endcomponent

	@endexclamoflexsection
@endsection