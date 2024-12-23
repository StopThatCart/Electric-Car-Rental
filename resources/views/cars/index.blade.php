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
            <h1>{{__('cars')}}</h1>
        </div>
        @can('is-admin')
          <div class="text-left">
            <a class="btn btn-primary btn-lg" href="{{ route('cars.create') }}">{{__('add')}} {{__('new car')}}</a>
          </div>
        @endcan


        <div class="row">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('car brand')}}</th>
                        <th scope="col">{{__('model')}}</th>
                        <th scope="col">{{__('description_pl')}}</th>
                        <th scope="col">{{__('description_en')}}</th>
                        <th scope="col">{{__('year')}}</th>
                        <th scope="col">{{__('battery')}}</th>
                        <th scope="col">{{__('seats')}}</th>
                        <th scope="col">{{__('gear')}}</th>
                        <th scope="col">{{__('img')}}</th>
                        <th scope="col"></th>
                        @can('is-admin')<th scope="col"></th>@endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cars as $c)
                    @can('update', $c)
                        <tr>
                            <th scope="row"><a href="{{ route('cars.show', $c->id) }}">{{ $c->id }}</a></th>
                            <td>{{ $c->brand->brand }}</td>
                            <td>{{ $c->model }}</td>
                            <td>{{ $c->description }}</td>
                            <td>{{ $c->description_en }}</td>
                            <td>{{ $c->year }}</td>
                            <td>{{ $c->battery }} kWh</td>
                            <td>{{ $c->seats }}</td>
                            <td>{{ __($c->gear) }}</td>
                            <td>{{ $c->img }}</td>
                            <td><a class="btn btn-sm btn-primary" href="{{route('cars.edit', $c->id)}}">{{__('edit')}}</a></td>
                            <td>
                                <form method="POST" action="{{ route('cars.destroy', $c->id) }}">
                                    @csrf
                                    @can('is-admin')
                                    @method('DELETE')
                                    <input class="btn btn-sm btn-danger" type="submit" value="{{__('delete')}}"></button>
                                    @endcan
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
