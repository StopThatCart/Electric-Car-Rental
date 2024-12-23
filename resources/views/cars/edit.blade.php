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
            <h1>{{__('edit')}} {{__('car_data')}}</h1>
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
                <form method="POST" action="{{ route('cars.update', $c->id) }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    @can('is-admin')
                    <div class="form-group mb-2">
                        <label for="brand_id">{{__('car brand')}}</label>
                            <select id="brand_id" name="brand_id" class="form-control">
                            @foreach ($brands as $b)
                                <option value="{{ $b->id }}"  @if($c->brand_id == $b->id) selected @endif>
                                    {{ $b->brand }}
                                </option>
                            @endforeach
                            </select>
                    </div>
                    @endcan
                    <div class="form-group mb-2">
                        <label for="model">{{__('model')}}</label>
                        <input id="model" name="model" type="text" class="form-control" value="{{ $c->model }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="description">{{__('description_pl')}}</label>
                        <textarea id="description" name="description" type="text" class="form-control">{{ $c->description }}</textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="description_en">{{__('description_en')}}</label>
                        <textarea id="description_en" name="description_en" type="text" class="form-control">{{ $c->description_en }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="year">{{__('year')}}</label>
                        <div class="input-group mb-3">
                            <input id="year" type="text" name="year" min="2000" placeholder="2000"
                            step="1" class="form-control" value="{{ $c->year }}">
                            <span class="input-group-text" >{{__('year')}}</span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="battery">{{__('battery')}}</label>
                        <div class="input-group mb-3">
                            <input id="battery" type="text" name="battery" min="0" placeholder="0"
                                step="any" class="form-control" value="{{ $c->battery }}">
                            <span class="input-group-text">kWh</span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="seats">{{__('seats')}}</label>
                        <div class="input-group mb-3">
                            <input id="seats" type="text" name="seats" min="1" placeholder="4"
                            step="1" class="form-control" value="{{ $c->seats }}">
                            <span class="input-group-text"></span>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="gear">{{__('gear')}}</label>
                        <select id="gear" name="gear" class="form-control">
                            <option value="Manual"  @if($c->gear == "Manual") selected @endif>{{__('Manual')}}</option>
                            <option value="Automatic" @if($c->gear == "Automatic") selected @endif>{{__('Automatic')}}</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="img">{{__('img')}}</label>
                        <input id="img" name="img" type="text" class="form-control" placeholder="nazwa.jpg" value="{{ $c->img }}">
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
