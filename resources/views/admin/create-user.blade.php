{{ date("H:i:s", time()) }}

<form method="POST" action="a">{{-- route('admin.create') --}}
    @csrf
    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">@lang('messages.email-adress') </label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                @lang('messages.submit-password-reset')
            </button>
        </div>
    </div>
</form>
