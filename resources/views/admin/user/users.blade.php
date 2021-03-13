<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg card shadow-sm">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box pt-1 px-2">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="display: flex; justify-content: flex-end;">
                                <a type="button" href="{{ route('users.new') }}" class="btn btn-success pull-right row b-none"><i class="fa fa-plus"></i></a>
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
                                            <th>{{ __('Username') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Created At') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td class="txt-oflo">{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td><span class="text-success">{{ date("d/m/Y H:i:s", strtotime($user->created_at)) }}</span></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a type="button" href="{{ route('users.show', $user->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
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
                                @if (count($users) < 1) <div style="text-align: center;">{{ __('messages.no_records') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
