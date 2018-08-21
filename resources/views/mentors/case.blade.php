@extends('layouts/app')

@section('content')
	@exclamoflexsection
		@component('components.cases.case.index')
			@slot ('title')
				{{ $case->title }}
			@endslot

			@slot ('description')
				@if ($case->anonymous)
					The creator of this case wants to stay anonymous
				@else
					Created by {{ $case->victim->full_name }}
				@endif
			@endslot

			@slot ('messages')
				{{ json_encode($messages) }}
			@endslot
		@endcomponent

	@endexclamoflexsection
@endsection