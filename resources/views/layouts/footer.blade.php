<div class="mt-auto bg-color-black text-white" v-cloak>
	<div class="container bg-color-black py-md-5">
		<footer class="py-5">
			<div class="row">
				<div class="col-12 col-md">
					<img class="mb-2" src="{{ asset('img/logo/logo_text_rounded.png') }}" alt="" width="150px">
					<small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
				</div>
				<div class="col-6 col-md">
					<h5>@lang('messages.features')</h5>
					<ul class="list-unstyled text-small">
						<li><a class="text-muted" href="{{ route('login') }}">@lang('messages.login')</a></li>
						<li><a class="text-muted" href="{{ route('dashboard') }}">@lang('messages.dashboard')</a></li>
						<li><a class="text-muted" href="{{ route('incidents.report') }}">@lang('messages.report_incident')</a></li>
					</ul>
				</div>
				<div class="col-6 col-md">
					<h5>@lang('messages.resources')</h5>
					<ul class="list-unstyled text-small">
						<li><a class="text-muted" href="{{ route('impressum') }}">@lang('messages.impressum')</a></li>
						<li><a class="text-muted" href="{{ route('privacy_policy') }}">@lang('messages.privacy_policy')</a></li>
						<li><a class="text-muted" href="{{ route('faq') }}">@lang('messages.faq')</a></li>
					</ul>
				</div>
			</div>
		</footer>
	</div>
</div>