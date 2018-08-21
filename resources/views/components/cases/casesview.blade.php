<div class="row mb-4 p-3 d-flex justify-content-center">
	@foreach($cases as $case)
		@component('components.cases.case', ["case"=> $case])
			@slot('tags')
				<span class="tag">
					<i class="fas fa-user-friends mr-1"></i>
					{{ $case->mentors->count() }} Mentors
				</span>
			@endslot
		@endcomponent
	@endforeach
	{{ $slot }}
</div>