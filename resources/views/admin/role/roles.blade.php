<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="container-fluid">
            <div class="white-box card shadow-sm pt-1 px-2">
                <div class="col-md-12 col-sm-12 col-xs-12 pull-right" style="display: flex; justify-content: flex-end;">
                    <a type="button" href="{{ route('roles.new') }}" class="btn btn-success pull-right row b-none"><i class="fa fa-plus"></i></a>
                </div>
                @if (is_array($errors))
                @foreach ($errors as $error)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br />
                @endforeach
                @elseif (!empty($error))
                <div class="alert alert-danger alert-dismissible" role="alert">
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
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Display Name') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td class="txt-oflo">{{ $role->name }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a type="button" href="{{ route('roles.show', $role->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="post">
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
                    @if (count($roles) < 1) <div style="text-align: center;">{{ __('No records found') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
