@extends('layouts.login')

@section('content')
    <form method="POST" action="{{ route('password.request') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">person</i>
            </span>
            <div class="form-line">
                <input type="email" class="form-control"  placeholder="Email" value="{{ old('email') }}"  id="email" name="email"  required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input id="password" type="password" class="form-control" name="password" required  placeholder="Password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="input-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmation Password">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">
            {{ __('Reset Password') }}
        </button>
    </form>
@endsection
