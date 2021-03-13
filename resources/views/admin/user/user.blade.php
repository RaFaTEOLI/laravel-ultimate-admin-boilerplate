<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box card shadow-sm" style="padding: 10px;">
                <div class="col-md-12 col-sm-12 col-xs-12 pull-right" style="display: flex; justify-content: flex-end;">
                    <a type="button" href="{{ route('users') }}" class="btn btn-success pull-right row b-none"><i class="fa fa-arrow-left"></i></a>
                </div>
                <form role="form" action="{{ empty($user) ? route('users') : route('users.update', $user->id ?? '') }}" method="POST">
                    @csrf
                    @method(empty($user) ? 'POST' : 'PUT')
                    <div class="form-group">
                        <label>{{ __('Username') }}</label>
                        <input id="name" type="text" name="name" class="form-control" value="{{ $user->name ?? '' }}">
                        @if ($errors->get('name'))
                        <p class="label-error">
                            @foreach ($errors->get('name') as $error)

                            <strong>{{ $error }}</strong>

                            @endforeach
                        </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{ __('Email') }}</label>
                        <input id="email" type="email" name="email" class="form-control" value="{{ $user->email ?? '' }}">
                        @if ($errors->get('email'))
                        <p class="label-error">
                            @foreach ($errors->get('email') as $error)

                            <strong>{{ $error }}</strong>

                            @endforeach
                        </p>
                        @endif
                    </div>
                    @if (empty($user))
                    <div class="form-group">
                        <label>{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" class="form-control" value="{{ $user->password ?? '' }}">
                        @if ($errors->get('password'))
                        <p class="label-error">
                            @foreach ($errors->get('password') as $error)

                            <strong>{{ $error }}</strong>

                            @endforeach
                        </p>
                        @endif
                    </div>
                    @endif

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </form>
                @if (!empty($user))
                <hr />
                    @if (count($roles) > 0)
                    <div class="form-group">
                        <label>{{ __('Roles to Add') }}</label>
                        <div class="form-group">
                        @foreach ($roles as $role)
                            <form class="btn" action="{{ route('users.role', ["userId" => $user->id, "roleId" => $role->id]) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success" type="submit" onclick="setLoading()">{{ $role->display_name }} <i class="fa fa-plus"></i></button>
                            </form>
                        @endforeach
                        </div>
                    </div>
                    @endif

                    @if (count($user->roles) > 0)
                    <div class="form-group">
                        <label>{{ __('Roles') }}</label>
                        <div class="form-group">
                        @foreach ($user->roles as $role)
                            <form class="btn" action="{{ route('users.role.remove', ["userId" => $user->id, "roleId" => $role->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary" type="submit" onclick="setLoading()">{{ $role->display_name }} <i class="fa fa-times"></i></button>
                            </form>
                        @endforeach
                        </div>
                    </div>

                    @if ($errors->get('user_id'))
                    <p class="label-error">
                        @foreach ($errors->get('user_id') as $error)

                        <strong>{{ $error }}</strong>

                        @endforeach
                    </p>
                    @endif

                    @if ($errors->get('role_id'))
                    <p class="label-error">
                        @foreach ($errors->get('role_id') as $error)

                        <strong>{{ $error }}</strong>

                        @endforeach
                    </p>
                    @endif

                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
