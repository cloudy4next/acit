@extends(backpack_view('layouts.plain'))
@section('content')
    <div class="row justify-content-center float-right col-4">
        <img src="{{ asset('assets/image/Applogo.png') }}" style="width: 40%; height: 20%">

        <div style="margin-top: 20px;">
            <img src="{{ asset('assets/image/logo_name.png') }}" style="width: 100%; height: auto">
            <div style="margin-top: 20px;">
                <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('backpack.auth.login') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="control-label"
                            for="{{ $username }}">{{ config('backpack.base.authentication_column_name') }}</label>

                        <div>
                            <input type="text" class="form-control{{ $errors->has($username) ? ' is-invalid' : '' }}"
                                name="{{ $username }}" value="{{ old($username) }}" id="{{ $username }}">

                            @if ($errors->has($username))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first($username) }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="password">{{ trans('backpack::base.password') }}</label>

                        <div>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                name="password" id="password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-block btn-primary">
                                {{ trans('backpack::base.login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if (config('backpack.base.registration_open'))
            <div class="text-center" style="margin-left: 20px;"><a
                    href="{{ route('backpack.auth.register') }}">{{ trans('backpack::base.register') }}</a></div>
        @endif
        @if (backpack_users_have_email() && config('backpack.base.setup_password_recovery_routes', true))
            <div class="text-center" style="margin-left: 20px;"><a
                    href="{{ route('backpack.auth.password.reset') }}">Forgot Password</a>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        div {
            margin: 10px;
        }

        .first {
            width: 25%;
            display: inline-block;
            background-color: green;
        }

        .second {
            width: 25%;
            display: inline-block;
            background-color: blue;
        }

        .third {
            width: 25%;
            display: inline-block;
            background-color: yellow;
        }

        @media screen and (max-width: 500px) {

            .first,
            .second,
            .third {
                width: 70%;
            }
        }
    </style>
@endpush
