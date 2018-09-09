<div class="col-xl-4 col-md-6 px-2 py-3 {{ $case->solved ? "case-solved" : "" }}">
	<div class="d-flex flex-column case-card shadow w-100 h-100">
		@php
			$messagesSinceLastLogin = $case->messages()
				->where('created_at', '>',
					auth()->user()->logins()->orderBy('created_at', 'desc')->first()->created_at)
				->count();
		@endphp
		@if ($messagesSinceLastLogin > 0)
			<span class="case-notification tag">
				{{ $messagesSinceLastLogin }}
			</span>
		@endif
		<div class="mb-auto pb-2">
			@if(isset($body))
				{{ $body }}
			@else
				@component('components.cases.case.body', ["case"=> $case])
				@endcomponent
			@endif
		</div>
		<hr>
		<div class="d-flex flex-column">
			<div>
				@isset ($tags)
					{{ $tags }}
				@endisset
			</div>
			<div class="d-flex align-items-end justify-content-between">
				@if(isset($footer))
					{{ $footer }}
				@else
					@component('components.cases.case.footer', ["case"=> $case])
					@endcomponent
				@endif
			</div>
		</div>
	</div>
</div>