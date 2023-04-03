@extends(backpack_view('layouts.plain'))

@section('content')
    <div class="container">
        <div class="row align-items-center justify-content-center" style="margin-top: 50px">
            <div class=" col-md-4 ml-auto" style="margin-top: 70px">
                <div class=" card form-block mx-auto" style="margin-top: 70px">
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
                                <input type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    id="password">

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
                    <div class="row col-12">

                        <div class="col-6">
                            @if (config('backpack.base.registration_open'))
                                <div class="text-right"><a
                                        href="{{ route('backpack.auth.register') }}">{{ trans('backpack::base.register') }}</a>
                                </div>
                            @endif
                        </div>
                        <div class="col-6">
                            @if (backpack_users_have_email() && config('backpack.base.setup_password_recovery_routes', true))
                                <div class="text-left ">
                                    <a href="{{ route('backpack.auth.password.reset') }}">
                                        Forgot Password </a>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('styles')


    @push('styles')
        {{-- <style>
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
    </style> --}}
    @endpush
