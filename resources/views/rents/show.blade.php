<!doctype html>
<html lang="pl">

@include('shared.header')

<body>
    @include('shared.nav')

    <div class="container mt-5 mb-5">
        <div class="row mb-1">
            <h1>{{__('rent_data')}}</h1>
        </div>
        @if($due)
        <div class="row mb-1 text-danger font-weight-bold">
            <h2>{{ __('overdue') }}</h1>
        </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('message'))
        <div class="row d-flex justify-content-center">
            <div class="alert alert-success">{{ session('message') }}</div>
        </div>
        @endif
        <table class="table table-hover table-striped">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">#</th>
                    <td>{{ $r->id }}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('offer')}}</th>
                    <td>{{ $r->offer_id }}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('orderer')}}</th>
                    <td>{{ $r->user->name }}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('cost')}}</th>
                    <td>{{ $r->cost }} PLN</td>
                </tr>
                <tr>
                    <th scope="col">{{__('date_rent')}}</th>
                    <td>{{ $r->date_rent }}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('date_return')}}</th>
                    <td>{{ $r->date_return }}</td>
                </tr>
                <tr>
                    <th scope="col">{{__('state')}}</th>
                    <td>{{ __($r->state) }}</td>
                </tr>
            </tbody>
        </table>
        <div class="text-center d-flex">
            @can('is-user')
                @if(Auth::user()->id == $r->user_id && ($r->state !='Canceled' && $r->state !='Returned'))
                            <form method="POST" action="{{ route('rents.update', $r->id) }}" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')
                                <input id="state" type="hidden" name="state" value="Canceled">
                                <input class="btn btn-warning mx-2"
                                onclick="return confirm('{{__('u_sure')}} {{__('cancel_rent')}}')"
                                type="submit" value="{{__('cancel')}} {{__('rent')}}"></button>
                            </form>
                @endif
            @elsecan('is-admin-or-worker')
            @can('update', $r)
                @if($r->state != 'Canceled' && $r->state != 'Returned')
                    <form method="POST" action="{{ route('rents.update', $r->id) }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <input id="state" type="hidden" name="state" value="{{$next}}">
                        <input class="btn btn-primary mx-2" type="submit" value="{{__('change')}} [{{__($r->state)}}] {{__('na')}} [{{__($next)}}]"></button>
                    </form>
                @endif
                <form method="POST" action="{{ route('rents.update', $r->id) }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <input id="state" type="hidden" name="state" value="Canceled">
                    <input class="btn btn-warning mx-2" type="submit"
                    onclick="return confirm('{{__('u_sure')}} {{__('cancel_rent')}}')"
                    value="{{__('cancel')}} {{__('rent')}}"></button>
                </form>

                <form method="POST" action="{{ route('rents.destroy', $r->id) }}">
                     @csrf
                     @method('DELETE')
                    <div class="form-group mx-2">
                          <input class="btn btn-danger mx-2" type="submit"
                          onclick="return confirm('{{__('u_sure')}} {{__('delete_rent')}}')"
                          value="{{__('delete')}} {{__('rent')}}"></button>
                    </div>
                </form>
        @endcan
            @endcan


          </div>
    </div>


</body>

</html>
