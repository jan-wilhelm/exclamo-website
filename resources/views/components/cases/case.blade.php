<div class="d-flex flex-column case-card shadow col-xl-3 col-md-5 mr-xl-5 mr-md-3 mb-5 {{ $case->solved ? "case-solved" : "" }}">
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
		<div class="mb-3">
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