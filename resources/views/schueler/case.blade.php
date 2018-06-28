@extends('layouts/app')

@section('content')
	@exclamoflexsection (["classes" => "bg-color-primary-1 text-white"])
		<h4>@lang('messages.incidents')</h4>
		<div class="case-card text-white {{ $case->solved ? "case-solved" : "" }}">
			<div class="d-sm-flex justify-content-between">
				<a href="{{ route('incidents.show', ["case" => $case]) }}">
					<h6 class="font-weight-bold text-white">{{ $case->title }}</h6>
				</a>
				<span>Case #{{ $case->id }}</span>
			</div>
			@if($case->messages()->count() > 0)
				<span>
					Update vom {{ $case->messages->first()->updated_at }}
				</span>
				<span>
					{{ $case->messages->first()->body }}
				</span>
			@endif
		</div>
	@endexclamoflexsection
@endsection