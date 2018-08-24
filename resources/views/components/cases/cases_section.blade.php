<div class="row mb-4">
	@foreach($cases->where('solved', isset($shouldBeSolved) ? $shouldBeSolved : false) as $case)
		@component('components.cases.case', ["case"=> $case])
			@slot('tags')
				@if(isset($userTag) && $userTag)
					<span class="tag">
						<i class="fas fa-user-graduate mr-1"></i>
						{{ $case->display_name }}
					</span>
				@else
					<span class="tag">
						<i class="fas fa-user-friends mr-1"></i>
						{{ $case->mentors->count() }} Mentors
					</span>
				@endif
			@endslot
		@endcomponent
	@endforeach
	@isset($otherComponents)
		{{ $otherComponents }}
	@endisset
</div>