<!doctype html>
<html lang="pl">

@include('shared.header')

<body>
    @include('shared.nav')

    <div class="container mt-5 mb-5">
        <div class="row mb-1">
            <h1>{{__('user')}}</h1>
        </div>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>
                @can('is-admin-or-worker')
                <tr>
                    <th scope="col">ID</th>
                    <td>{{$u->id}}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('assigned brand')}}</th>
                    <td>@if($u->brand->id == 1){{ __('none')}}@else{{ $u->brand->brand }}@endif</td>
                </tr>
                @endcan
                <tr>
                    <th scope="col">{{__('name')}}</th>
                    <td>{{ $u->name }}</td>
                </tr>
                <tr>
                    <th scope="col">E-mail</th>
                    <td>{{ $u->email }}</td>
                </tr>
                @can('is-admin-or-worker')
                <tr>
                    <th scope="col">{{__('role')}}</th>
                    <td>@if($u->role_id == 2){{__('employee')}}@elseif($u->role_id == 3){{__('user')}}@else{{__('admin')}}@endif</td>
                </tr>@endcan
                @can('update', $u)<tr>
                     <th scope="col">{{__('edit')}}</th>
                    <td><a class="btn btn-sm btn-primary" href="{{route('users.edit', $u->id)}}">{{__('edit')}}</a></td>

                </tr> @endcan
                @can('delete',$u)<tr>
                    <th scope="col">{{__('delete')}}</th>
                    <td>
                        <form method="POST" action="{{ route('users.destroy', $u->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="form-group mt-2">
                            <input class="btn btn-sm btn-danger" type="submit" onclick="return confirm('{{__('u_sure')}} {{__('delete_account')}}')" value="{{__('delete')}}"></button>
                        </div>
                        </form>
                    </td>
                </tr>@endcan
            </tbody>
        </table>
    </div>


</body>

</html>
