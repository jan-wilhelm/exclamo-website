@extends('layouts/app')

@section('content')
	@exclamoflexsection
		{{ $user->first_name . " " . $user->last_name }}
	@endexclamosection
@endsection