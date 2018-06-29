@extends('layouts/app')

@section('content')
	@exclamoflexsection (["classes" => "bg-color-primary-1 text-white"])
		<h4>
			{{ $case->title }}
		</h4>
		<div>
			@if($case->messages()->count() > 0)
				<span>
					Update vom {{ $case->messages->first()->updated_at }}
				</span>
				<span>
					{{ $case->messages->first()->body }}
				</span>
			@endif
		</div>
		<hr>
		<div style="overflow: hidden; width: 100%;">
			<div id="chat-container" class="chat-container p-4 d-flex flex-column" style="overflow-y: auto; width: calc(100% + 18px);">
				@foreach($case->messages()->orderBy('updated_at', 'asc')->get() as $message)
					<div class="chat-message p-3 {{ $message->sender->id == auth()->user()->id ? "align-self-end right" : "left" }}">
						@if($message->sender->id != auth()->user()->id)
							<a href="" class="text-white mb-2 d-block">{{ $message->sender->fullName() }}</a>
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
		</div>
	@endexclamoflexsection
@endsection

@push('scripts')
	<script type="text/javascript">
		$('document').ready(function() {
			var cont = document.getElementById("chat-container");
			cont.scrollTop = cont.scrollHeight;
		})
	</script>
@endpush