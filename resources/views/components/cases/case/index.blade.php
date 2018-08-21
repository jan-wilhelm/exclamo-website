<div>
	<h4 class="d-md-inline-block">
		{{ $title }}
	</h4>
	<span class="d-md-inline-block font-italic ml-md-4">
		{{ $description }}
	</span>
	@isset ($header)
		{{ $header }}
	@endisset
</div>
<hr>

<chat-messages-container :messages="{{ $messages }}" />