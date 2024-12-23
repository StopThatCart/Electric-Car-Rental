<!doctype html>
<html lang="pl">
  @include('shared.header')
  <body>
    @include('shared.nav')
    <div id="start" class="mb-5">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ URL::to('/') }}/img/carousel1.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>{{__('cheap and reliable')}}</h1>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{ URL::to('/') }}/img/carousel2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>{{__('environment friendly')}}</h1>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{ URL::to('/') }}/img/carousel3.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>{{__('guaranteed')}}</h1>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">{{__('previous')}}</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">{{__('next')}}</span>
        </button>
      </div>
    </div>

    <div class="container mb-5">
      <div class="row">
          <h1>{{__('cars')}}</h1>
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
                <p>{{__('empty')}}</p>
        @endforelse
      </div>
  </div>
<div id="all_cars"  class="text-center">
  <a class="btn btn-primary btn-lg" href="{{route('cars.car_cards')}}">{{__('show all cars')}}</a>
</div>
  <div id="cennik" class="container mt-5 mb-5">
    <div class="row">
        <h1>{{__('short offers')}}</h1>
    </div>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('car brand')}}</th>
                <th scope="col">{{__('car model')}}</th>
                <th scope="col">{{__('year')}}</th>
                <th scope="col">{{__('gear')}}</th>
                <th scope="col">{{__('period')}}</th>
                <th scope="col">{{__('price')}}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($offers as $o)
            <tr>
                <th scope="row">{{$o->id}}</th>
                <td>{{$o->car->brand->brand}}</td>
                <td>{{$o->car->model}}</td>
                <td>{{$o->car->year}}</td>
                <td>{{__($o->car->gear)}}</td>
                <td>{{$o->period}} {{__('days')}}</td>
                <td>{{$o->price}} PLN</td>
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
