@extends('layouts/app')

@section('content')
	<div class="row section bg-white mt-4 d-flex flex-column">
		{{ $user->first_name . " " . $user->last_name }}
	</div>
@endsection