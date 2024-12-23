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
            <h1>{{__('login')}}</h1>
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
            <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                <form method="POST" act ion="{{ route('login.authenticate') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-2">
                        <label for="email">E-mail</label>
                        <input id="email" name="email" type="text" class="form-control" placeholder="bob123@email.com">
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">{{__('password')}}</label>
                        <input id="password" name="password" type="password" class="form-control">
                    </div>
                    <div class="text-center mt-4 mb-4">
                        <input class="btn btn-primary" type="submit" value="{{__('log in')}}">
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>

