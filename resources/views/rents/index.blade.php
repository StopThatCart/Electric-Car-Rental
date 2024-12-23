<!doctype html>
<html lang="pl">
<?php
    use App\Models\Rent;
?>
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
            <h1>{{__('rents')}}</h1>
        </div>

        <div class="row">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('offer')}}</th>
                        <th scope="col">{{__('model')}}</th>
                        <th scope="col">{{__('orderer')}}</th>
                        <th scope="col">{{__('cost')}}</th>
                        <th scope="col">{{__('overdue cost') }}</th>
                        <th scope="col">{{__('date_rent')}}</th>
                        <th scope="col">{{__('date_return')}}</th>
                        <th scope="col">{{__('state')}}</th>
                        <th scope="col">{{ __('overdue') }}</th>


                        @can('is-admin')<th scope="col"></th>@endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rents as $r)
                    <?php
                    $due = Rent::rent_due($r);
                    ?>
                        @can('is-user')
                            @if(Auth::user()->id != $r->user_id)
                                @continue
                            @endif
                        @endcan

                        @can('is-worker')
                            @cannot('update', $r)
                                 @continue
                            @endcannot
                        @endcan

                        <tr>
                            <th scope="row"><a class="btn btn-sm btn-primary" href="{{ route('rents.show', $r->id) }}">{{ $r->id }}</a></th>
                            <td><a href="{{ route('offers.show', $r->offer_id) }}">{{ $r->offer_id }}</a></td>
                            <td><a href="{{ route('cars.show', $r->offer->car->id) }}">{{$r->offer->car->model}}</a></td>
                            <td>
                                @can('is-admin')<a href="{{ route('users.show', $r->user_id) }}">{{ $r->user->email }}</a>
                                @else{{ $r->user->email }}@endcan
                            </td>
                            <td>{{ $r->cost }}</td>
                            @if($due[2])<td class="text-danger">{{ $due[1] }}</td>@else <td>{{__('none')}}</td>@endif
                            <td>{{ $r->date_rent }}</td>
                            <td>{{ $r->date_return }}</td>
                            <td>{{__($r->state)}}</td>
                            @if($due[2])<td class="text-danger">{{ __('overdue') }}</td> @else <td>{{ __('NO') }}</td> @endif
                            @can('is-admin')<td>
                                <form method="POST" action="{{ route('rents.destroy', $r->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-sm btn-danger" type="submit" value="{{__('delete')}}"></button>
                                </form>
                            </td>
                            @endcan

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
