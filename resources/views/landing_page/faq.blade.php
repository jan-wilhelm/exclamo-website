@extends('layouts/app')

@section('content')
	@exclamoflexsection
		<h3>
			@lang('messages.faq')
		</h3>

		<div role="tablist">
			@foreach (config('exclamo.faq_questions') as $question)
			<b-card no-body class="mb-1">
				<b-card-header header-tag="header" class="py-1 pl-3" role="tab">	
					<div href="#" v-b-toggle.accordion-{{ $question }}
						class="nounderline bg-none color-primary-1 cta-tertiary cta"
					>
						@lang("faq." . $question)
					</div>
				</b-card-header>
				<b-collapse id="accordion-{{ $question }}" visible accordion="questions-accordion" role="tabpanel">
					<b-card-body>
						@include('landing_page.' . 'de' . '.faq.' . $question)
					</b-card-body>
				</b-collapse>
			</b-card>
			@endforeach
		</div>
	@endexclamosection
@endsection