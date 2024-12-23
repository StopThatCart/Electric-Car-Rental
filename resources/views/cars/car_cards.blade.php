<!doctype html>
<html lang="pl">

@include('shared.header')

<body>
    @include('shared.nav')


    <div class="container mt-5 mb-5">
        <div class="row">
            <h1 class="text-center">{{__('cars')}}</h1>
        </div>
        <div class="row">
            @forelse ($cars as $c)
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card">
                    @if($c->img && file_exists(public_path('storage/img/'.$c->img)))
                    <img src="{{ asset('storage/img/'.$c->img) }}" alt="{{ $c->img }}">
                @else
                    <img src="{{ asset('storage/img/default.jpg') }}" alt="default">
                @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $c->brand->brand.' '.$c->model }}</h5>
                        <p class="card-text">@if(Session::get("locale") =='en'){{ __($c->description_en)}}@else{{ __($c->description)}}@endif</p>
                        <a class="btn btn-primary" href="{{route('cars.show', $c->id)}}">{{__('more')}}</a>
                    </div>
                </div>
            </div>
            @empty
                    <p>{{__('empty')}}.</p>
            @endforelse
        </div>
    </div>



</body>

</html>
