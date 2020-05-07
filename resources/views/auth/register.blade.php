@extends('layouts.app')

@section('content')
<div class="login-box">
                <h1>{{ __('Register') }}</h1>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <label for="name">{{ __('Name') }}</label>
                        <div class="user-box">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <div class="user-box">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <label for="password">{{ __('Password') }}</label>
                        <div class="user-box">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <div class="user-box">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="user-box">
                            <button type="submit"><a>
                                    {{ __('Register') }}
                            </a></button>
                        </div>
                    </form>
                </div>
</div>
@endsection