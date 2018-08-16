<div id="chat-container" class="chat-container p-4 d-flex flex-column">
	@foreach($case->messages()->orderBy('updated_at', 'asc')->get() as $message)
		<div class="chat-message p-3 {{ $message->sender->id == auth()->user()->id ? "align-self-end right" : "left" }}">
			@if($message->sender->id != auth()->user()->id)
				<a href="" class="mb-2 d-block">{{ $message->sender->full_name }}</a>
			@endif
			<span class="chat-text">
				{{ $message->body }}
			</span>
			<span class="chat-time">
				{{ $message->updated_at->format("d.m.Y G:i") }}
			</span>
		</div>
	@endforeach
</div>