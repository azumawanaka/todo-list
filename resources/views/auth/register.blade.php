
@extends(empty($title) ? 'layouts.app' : 'layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-4 text-center">
            <h4 class="mb-4">{{ __('Register') }}</h4>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="name" type="name" placeholder="Email" class="form-control input-gray @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="email" type="email" placeholder="Email" class="form-control input-gray @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="password" type="password" placeholder="Password" class="form-control input-gray @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control input-gray" name="password_confirmation" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                @if ($errors->has('auth'))
                <div class="form-group text-left mb-0">
                    <small class="text-danger"><i class="fa fa-warning"></i> {{ $errors->first('auth') }}</small>
                </div>
                @endif

                <div class="form-group row mb-0 mt-3">
                    <div class="col-md-12 text-right text-dark">
                        <p>Already registered? <a href="{{ route('login') }}">{{ __('Login now') }}</a></p>
                        <button type="submit" class="btn btn-dark btn-block">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
