<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">{{__('electric car rental')}}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
           <div class="dropdown">
                <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{__('language')}}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('locale','pl')}}">{{__('pl')}}</a></li>
                    <li><a class="dropdown-item" href="{{ route('locale','en')}}">{{__('en')}}</a></li>
                </ul>
            </div>
             </li>
          <li class="nav-item">
            <a class="nav-link" href="/">Start</a>
          </li>
            @can('is-admin-or-worker')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cars.index') }}">{{__('cars')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('offers.index') }}">{{__('offers')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rents.index') }}">{{__('rents')}}</a>
                </li>
            @elsecan('is-user')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cars.car_cards') }}">{{__('cars')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rents.index') }}">{{__('my rents')}}</a>
                </li>
            @endcan
            @can('is-admin')
                <li class="nav-item">
                     <a class="nav-link" href="{{ route('users.index') }}">{{__('accounts')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('brands.index') }}">{{__('brands')}}</a>
                </li>
            @endcan
        </ul>

        <ul class="navbar-nav mb-2 mb-lg-0">
            @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.show', Auth::user()->id) }}">{{__('my account')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">{{ Auth::user()->name }}, {{__('Logout')}}</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{__('login')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{__('register')}}</a>
                </li>
            @endif
        </ul>


      </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
  </nav>
