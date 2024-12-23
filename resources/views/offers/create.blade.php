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
        <div class="row mt-4 mb-4 text-center">
            <h1>{{__('create new offer')}}</h1>
        </div>

        @if ($errors->any())
            <div class="row d-flex justify-content-center">
                <div class="col-6">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('offers.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-2">
                        <label for="car_id">{{__('assigned car')}}</label>
                            <select id="car_id" name="car_id" class="form-control">
                                @can('is-admin')
                                    @foreach ($cars as $c)
                                        <option value="{{ $c->id }}">
                                            {{ $c->model }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach ($cars as $c)
                                     @if(Auth::user()->brand_id == $c->brand_id)
                                         <option value="{{ $c->id }}">
                                            {{ $c->model }}
                                         </option>
                                     @endif
                                     @endforeach
                                @endcan
                            </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="period">{{__('period')}}</label>
                        <div class="input-group mb-3">
                            <input id="period" type="number" name="period" min="1"
                            step="1" class="form-control" placeholder="7">
                            <span class="input-group-text">{{__('days')}}</span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">{{__('price')}}</label>
                        <div class="input-group mb-3">
                            <input id="price" type="number" name="price" min="0"
                                step="0.01" class="form-control" placeholder="451.55">
                            <span class="input-group-text"> PLN</span>
                        </div>
                    </div>
                    <div class="text-center mt-4 mb-4">
                        <input class="btn btn-success" type="submit" value="{{__('send')}}">
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>

