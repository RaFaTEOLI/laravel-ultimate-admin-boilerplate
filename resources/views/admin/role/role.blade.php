<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box card shadow-sm" style="padding: 10px;">
                <div class="col-md-12 col-sm-12 col-xs-12 pull-right" style="display: flex; justify-content: flex-end;">
                    <a type="button" href="{{ route('roles') }}" class="btn btn-success pull-right row b-none"><i class="fa fa-arrow-left"></i></a>
                </div>
                @csrf
                <form role="form" action="{{ empty($role) ? route('roles') : route('roles.update', $role->id ?? '') }}" method="POST">
                    @csrf
                    @method(empty($role) ? 'POST' : 'PUT')
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input id="name" type="text" name="name" class="form-control" value="{{ $role->name ?? '' }}">
                        @if ($errors->get('name'))
                        <p class="label-error">
                            @foreach ($errors->get('name') as $error)

                            <strong>{{ $error }}</strong>

                            @endforeach
                        </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{ __('Display Name') }}</label>
                        <input id="display_name" type="text" name="display_name" class="form-control" value="{{ $role->display_name ?? '' }}">
                        @if ($errors->get('display_name'))
                        <p class="label-error">
                            @foreach ($errors->get('display_name') as $error)

                            <strong>{{ $error }}</strong>

                            @endforeach
                        </p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ __('Description') }}</label>
                        <input id="description" type="text" name="description" class="form-control" value="{{ $role->description ?? '' }}">
                        @if ($errors->get('description'))
                        <p class="label-error">
                            @foreach ($errors->get('description') as $error)

                            <strong>{{ $error }}</strong>

                            @endforeach
                        </p>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </form>
                @if (!empty($role))
                <hr />
                    @if (count($permissions) > 0)
                    <div class="form-group">
                        <label>{{ __('Roles to Add') }}</label>
                        <div class="form-group">
                        @foreach ($permissions as $permission)
                            <form class="btn" action="{{ route('roles.permission.update', ["roleId" => $role->id, "permissionId" => $permission->id]) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success" type="submit">{{ $permission->display_name }} <i class="fa fa-plus"></i></button>
                            </form>
                        @endforeach
                        </div>
                    </div>
                    @endif

                    @if (count($role->permissions) > 0)
                    <div class="form-group">
                        <label>{{ __('Roles') }}</label>
                        <div class="form-group">
                        @foreach ($role->permissions as $permission)
                            <form class="btn" action="{{ route('roles.permission.remove', ["roleId" => $role->id, "permissionId" => $permission->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary" type="submit">{{ $permission->display_name }} <i class="fa fa-times"></i></button>
                            </form>
                        @endforeach
                        </div>
                    </div>

                    @if ($errors->get('role_id'))
                    <p class="label-error">
                        @foreach ($errors->get('role_id') as $error)

                        <strong>{{ $error }}</strong>

                        @endforeach
                    </p>
                    @endif

                    @if ($errors->get('permission_id'))
                    <p class="label-error">
                        @foreach ($errors->get('permission_id') as $error)

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
