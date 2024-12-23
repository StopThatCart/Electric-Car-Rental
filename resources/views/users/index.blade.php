<!doctype html>
<html lang="pl">

@include('shared.header')

<body>
    @include('shared.nav')

    <div class="container mt-5 mb-5">
        @if (session('error'))
        <div class="row d-flex justify-content-center">
            <div class="alert alert-danger">{{ session('error') }}</div>
        </div>
        @endif
        @if (session('message'))
        <div class="row d-flex justify-content-center">
            <div class="alert alert-success">{{ session('message') }}</div>
        </div>
        @endif
        <div class="row mb-1">
            <h1>{{__('employees')}}</h1>
        </div>

        <div class="column">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('assigned brand')}}</th>
                        <th scope="col">{{__('name')}}</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">{{__('role')}}</th>
                        @can('is-admin') <th scope="col"></th>@endcan
                        @can('is-admin')<th scope="col"></th>@endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $u)
                    @if($u->role_id ==3) @continue @endif
                        <tr>
                            <th scope="row"><a class="btn btn-sm btn-primary" href="{{route('users.show', $u->id)}}">{{ $u->id }}</a></th>
                            <td>@if($u->brand->id == 1){{ __('none')}}@else{{ $u->brand->brand }}@endif</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>@if($u->role_id == 1){{__('admin')}}@elseif($u->role_id == 2){{__('employee')}}@endif</td>
                            @can('update', $u)
                            <td><a class="btn btn-sm btn-primary" href="{{route('users.edit', $u->id)}}">{{__('edit')}}</a></td>
                            @endcan
                            <td>
                                <form method="POST" action="{{ route('users.destroy', $u->id) }}">
                                    @csrf
                                    @can('is-admin')
                                    @method('DELETE')
                                    <input class="btn btn-sm btn-danger" type="submit" value="{{__('delete')}}" onclick="return confirm('{{__('u_sure')}} {{__('delete_account')}}')"></button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="6">{{__('empty')}}</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="row mb-1">
            <h1>{{__('users')}}</h1>
        </div>
        <div class="column">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('assigned brand')}}</th>
                        <th scope="col">{{__('name')}}</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">{{__('role')}}</th>
                        @can('update', $u) <th scope="col"></th>@endcan
                        @can('is-admin')<th scope="col"></th>@endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $u)
                    @if($u->role_id !=3) @continue @endif
                        <tr>
                            <th scope="row"><a class="btn btn-sm btn-primary" href="{{route('users.show', $u->id)}}">{{ $u->id }}</a></th>
                            <td>@if($u->brand->id == 1){{ __('none')}}@else{{ $u->brand->brand }}@endif</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>@if($u->role_id == 3){{__('user')}}@endif</td>
                            @can('update', $u)
                            <td><a class="btn btn-sm btn-primary" href="{{route('users.edit', $u->id)}}">{{__('edit')}}</a></td>
                            @endcan
                            <td>
                                <form method="POST" action="{{ route('users.destroy', $u->id) }}">
                                    @csrf
                                  @can('is-admin')  @endcan
                                    @method('DELETE')
                                    <input class="btn btn-sm btn-danger" type="submit" value="{{__('delete')}}" onclick="return confirm('{{__('u_sure')}} {{__('delete_account')}}')"></button>

                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="6">{{__('empty')}}</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>
