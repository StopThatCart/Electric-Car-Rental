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
            <h1>{{__('add')}} {{__('new car')}}</h1>
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
                <form method="POST" action="{{ route('cars.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-2">
                        <label for="brand_id">{{__('brand')}}</label>
                        <select id="brand_id" name="brand_id" class="form-control">
                        @foreach ($brands as $b)
                            <option value="{{ $b->id }}">{{ $b->brand }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label for="model">{{__('model')}}</label>
                        <input id="model" name="model" type="text" class="form-control" placeholder="CW-51">
                    </div>
                    <div class="form-group mb-2">
                        <label for="description">{{__('description_pl')}}</label>
                        <textarea id="description" name="description" type="text" class="form-control" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="description_en">{{__('description_en')}}</label>
                        <textarea id="description_en" name="description_en" type="text" class="form-control" placeholder="English words"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="year">{{__('year')}}</label>
                        <div class="input-group mb-3">
                            <input id="year" type="number" name="year" min="2000" placeholder="2000"
                            step="1" class="form-control">
                            <span class="input-group-text">{{__('year')}}</span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="battery">{{__('battery')}}</label>
                        <div class="input-group mb-3">
                            <input id="battery" type="text" name="battery" min="1" placeholder="1"
                                step="any" class="form-control">
                            <span class="input-group-text">kWh</span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="seats">{{__('seats')}}</label>
                        <div class="input-group mb-3">
                            <input id="seats" type="text" name="seats" min="1" placeholder="4"
                            step="1" class="form-control">
                            <span class="input-group-text"></span>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="gear">{{__('gear')}}</label>
                        <select id="gear" name="gear" class="form-control">
                            <option value="Manual">{{__('Manual')}}</option>
                            <option value="Automatic">{{__('Automatic')}}</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="img">{{__('img')}}</label>
                        <input id="img" name="img" type="text" class="form-control" placeholder="name.jpg">
                    </div>
                    <div class="text-center mt-4 mb-4">
                        <input class="btn btn-success" type="submit" value="Wyślij">
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>
