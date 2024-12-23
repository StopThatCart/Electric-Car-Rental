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
            <h1>{{__('offers')}}</h1>
            <p>{{__('max 6 offers')}}</p>
        </div>
        @can('is-admin-or-worker') <div class="text-left">
            <a class="btn btn-primary btn-lg" href="{{ route('offers.create') }}">{{__('add new offer')}}</a>
          </div>@endcan

        <div class="row">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('car model')}}</th>
                        <th scope="col">{{__('period')}}</th>
                        <th scope="col">{{__('price')}}</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($offers as $o)
                        @can('update', $o)
                    <tr>
                        <th scope="row">{{$o->id}}</th>
                        <td><a href="{{ route('cars.show', $o->car->id) }}">{{ $o->car->model }}</a></td>
                        <td>{{$o->period}}</td>
                        <td>{{$o->price}} PLN</td>
                        <td><a class="btn btn-sm btn-primary" href="{{route('offers.edit', $o->id)}}">{{__('edit')}}</a></td>
                        <td>
                            <form method="POST" action="{{ route('offers.destroy', $o->id) }}">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-sm btn-danger" type="submit" value="{{__('delete')}}"></button>
                            </form>
                        </td>
                    </tr>
                        @endcan
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
