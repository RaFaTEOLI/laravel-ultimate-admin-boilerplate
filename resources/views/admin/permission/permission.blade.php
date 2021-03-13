<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg card shadow-sm">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box pt-1 px-2">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="display: flex; justify-content: flex-end;">
                                <a type="button" href="{{ route('permissions') }}" class="btn btn-success pull-right row b-none"><i class="fa fa-arrow-left"></i></a>
                            </div>
                            @csrf
                            <form permission="form" action="{{ empty($permission) ? route('permissions') : route('permissions.update', $permission->id ?? '') }}" method="POST">
                                @csrf
                                @method(empty($permission) ? 'POST' : 'PUT')

                                @if (!empty($permission))
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input id="name" type="text" name="name" class="form-control" value="{{ $permission->name ?? '' }}">
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
                                    <input id="display_name" type="text" name="display_name" class="form-control" value="{{ $permission->display_name ?? '' }}">
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
                                    <input id="description" type="text" name="description" class="form-control" value="{{ $permission->description ?? '' }}">
                                    @if ($errors->get('description'))
                                    <p class="label-error">
                                        @foreach ($errors->get('description') as $error)

                                        <strong>{{ $error }}</strong>

                                        @endforeach
                                    </p>
                                    @endif
                                </div>
                                @else
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input id="name" type="text" name="name" class="form-control">
                                    @if ($errors->get('name'))
                                    <p class="label-error">
                                        @foreach ($errors->get('name') as $error)

                                        <strong>{{ $error }}</strong>

                                        @endforeach
                                    </p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Description') }}</label>
                                    <input id="description" type="text" name="description" class="form-control">
                                    @if ($errors->get('description'))
                                    <p class="label-error">
                                        @foreach ($errors->get('description') as $error)

                                        <strong>{{ $error }}</strong>

                                        @endforeach
                                    </p>
                                    @endif
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="create" name="create">
                                    <label class="form-check-label">
                                        {{ __('Create') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="read" name="read">
                                    <label class="form-check-label">
                                    {{ __('Read') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="update" name="update">
                                    <label class="form-check-label">
                                        {{ __('Update') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="delete" name="delete">
                                    <label class="form-check-label">
                                        {{ __('Delete') }}
                                    </label>
                                </div>
                                @endif

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
