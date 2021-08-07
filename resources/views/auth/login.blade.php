
@extends(empty($title) ? 'layouts.app' : 'layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-4 text-center">
            <h4 class="mb-4">{{ empty($title) ? 'Log In' : $title }}</h4>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="email" type="email" placeholder="Email" class="form-control input-gray @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="password" type="password" placeholder="Password" class="form-control input-gray @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
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
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-dark btn-block">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
