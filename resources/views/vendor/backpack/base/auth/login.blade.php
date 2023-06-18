@extends(backpack_view('layouts.plain'))

@section('content')
    <div class="row justify-content-right">
        <div class="col-md-12">
            <div class="card-group d-block d-md-flex row" style="display: flex; justify-content: flex-end;">
                {{-- <div class="card col-md-8"
                    style="background-image:url({{ asset('assets/image/login_bg.png') }}); background-size: cover;">

                </div> --}}
                <div class="card col-md-4 ">
                    {{-- <h3 class="text-center mb-4">{{ trans('backpack::base.login') }}</h3> --}}
                    <div class="text-center mt-3">
                        <img style="width: 5rem;" src="{{ asset('assets/image/Applogo.png') }}" alt="image">
                    </div>
                    <div class="card-body">
                        <h3 class="text-center text-medium-emphasis text-success" style="font-size:17px">
                            {{ __('Agriculture Communication and Information Technology') }}
                        </h3>
                        <form class="col-md-12 p-t-10" role="form" method="POST"
                            action="{{ route('backpack.auth.login') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="control-label"
                                    for="{{ $username }}">{{ config('backpack.base.authentication_column_name') }}</label>

                                <div>
                                    <input type="text"
                                        class="form-control{{ $errors->has($username) ? ' is-invalid' : '' }}"
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
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
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
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember">
                                            {{ trans('backpack::base.remember_me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <button type="submit" class="btn btn-block btn-success">
                                        {{ trans('backpack::base.login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if (backpack_users_have_email() && config('backpack.base.setup_password_recovery_routes', true))
                        <div class="text-center" style="margin-left: 20px;"><a
                                href="{{ route('backpack.auth.password.reset') }}">Forgot Password</a>
                        </div>
                    @endif
                    @if (config('backpack.base.registration_open'))
                        <div class="text-center mb-3"><a
                                href="{{ route('backpack.auth.register') }}">{{ trans('backpack::base.register') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
