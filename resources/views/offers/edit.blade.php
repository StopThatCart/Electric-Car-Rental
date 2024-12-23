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
            <h1>{{__('edit offer data')}}</h1>
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
                <form method="POST" action="{{ route('offers.update', $o->id) }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <label for="car_id">{{__('assigned car')}}</label>
                            <select id="car_id" name="car_id" class="form-control">
                                @can('is-admin')
                                @foreach ($cars as $c)
                                    <option value="{{ $c->id }}" @if($o->car_id == $c->id) selected @endif>
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
                            step="1" class="form-control" value="{{ $o->period }}">
                            <span class="input-group-text">{{__('days')}}</span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">{{__('price')}}</label>
                        <div class="input-group mb-3">
                            <input id="price" type="number" name="price" min="0"
                                step="0.01" class="form-control" value="{{ $o->price }}">
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

