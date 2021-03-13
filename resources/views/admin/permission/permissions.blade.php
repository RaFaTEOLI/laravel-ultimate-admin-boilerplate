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
                                <a type="button" href="{{ route('permissions.new') }}" class="btn btn-success pull-right row b-none"><i class="fa fa-plus"></i></a>
                            </div>
                            @if (is_array($errors))
                            @foreach ($errors as $error)
                            <div class="alert alert-danger alert-dismissible" permission="alert">
                                {{ $error }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <br />
                            @endforeach
                            @elseif (!empty($error))
                            <div class="alert alert-danger alert-dismissible" permission="alert">
                                {{ error }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <br />
                            @endif
                            <div class="table-responsive">
                                <table class="table" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Display Name') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                        <tr>
                                            <td class="txt-oflo">{{ $permission->name }}</td>
                                            <td>{{ $permission->display_name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a type="button" href="{{ route('permissions.show', $permission->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if (count($permissions) < 1) <div style="text-align: center;">{{ __('No records found') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
