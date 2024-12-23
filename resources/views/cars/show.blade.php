<!doctype html>
<html lang="pl">

@include('shared.header')

<body>
    @include('shared.nav')

    <div class="container mt-5 mb-5">
        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row mb-1">
            <h1>{{ $c->brand->brand." ".$c->model }}</h1>
            @if($c->img && file_exists(public_path('storage/img/'.$c->img)))
                <img src="{{ asset('storage/img/'.$c->img) }}" alt="{{ $c->img }}">
            @else
                <img src="{{ asset('storage/img/default.jpg') }}" alt="default">
            @endif
        </div>

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">{{__('car brand')}}</th>
                    <td>{{ $c->brand->brand }}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('model')}}</th>
                    <td>{{ $c->model }}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('description')}}</th>
                    <td>@if(Session::get("locale") =='en'){{ __($c->description_en)}}@else{{ __($c->description)}}@endif</td>
                </tr>
                <tr>
                    <th scope="col">{{__('year')}}</th>
                    <td>{{ $c->year }}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('battery')}}</th>
                    <td>{{ $c->battery }} kWh</td>
                </tr>
                <tr>
                    <th scope="col">{{__('seats')}}</th>
                    <td>{{ $c->seats }}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('gear')}}</th>
                    <td>{{ __($c->gear) }}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('img')}}</th>
                    <td>{{ $c->img }}</td>
                </tr>
                @can('update', $c)
                <tr>
                  <th scope="col">{{__('edit')}}</th>
                    <td><a class="btn btn-sm btn-primary" href="{{route('cars.edit', $c->id)}}">{{__('edit')}}</a></td>
                </tr>
                @endcan
                @can('is-admin') <tr>
                    <th scope="col">{{__('delete')}}</th>
                    <td>
                        <form method="POST" action="{{ route('cars.destroy', $c->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <input class="btn btn-sm btn-danger" type="submit" value="{{__('delete')}}"></button>
                        </div>
                    </form>
                </td>
                </tr>
                @endcan
            </tbody>
        </table>


    <div class="row mb-1">
        <h1>{{__('rent offers')}}</h1>
        @forelse ($c->offers as $o)
        <div class="col-md-4">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">ID</th>
                    <td>{{$o->id}}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('Period')}}</th>
                    <td>{{$o->period}} {{__('days')}}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('Price')}}</th>
                    <td>{{$o->price}} PLN</td>
                </tr>
                <tr>
                    <th scope="col">{{__('date_rent')}}</th>
                    <td>{{ \Carbon\Carbon::now()->toDateString() }}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('date_return')}}</th>
                    <td>{{ \Carbon\Carbon::now()->addDays($o->period)->toDateString() }}</td>
                </tr>

            </tbody>
        </table>
        <div class="text-center">
            <div class="d-flex justify-content-between">
             @can('update', $c)
                  <a class="btn btn-sm btn-primary " href="{{route('offers.edit', $o->id)}}">{{__('edit')}}</a>
             @endcan
             @can('is-user')
             @if(Auth::check())
                <form method="POST" action="{{ route('rents.store') }}" class="needs-validation" novalidate>
                     @csrf
                     <input id="offer_id" type="hidden" name="offer_id" value="{{$o->id}}">
                    <input class="btn btn-sm btn-primary" onclick="return confirm('{{__('u_sure')}} {{__('rent car')}}')" type="submit" value="{{__('rent that')}}"></button>
                 </form>
              @endif
             @endcan
            </div>
        </div>
      </div>
         @empty
            <tr>
                <th scope="row" colspan="6">{{__('empty')}}</th>
            </tr>
            @endforelse
        </div>
    </div>


</body>

</html>
