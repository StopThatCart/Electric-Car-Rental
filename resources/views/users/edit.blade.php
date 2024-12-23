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
            <h1>{{__('edit')}} {{__('user_data')}}</h1>
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
                <form method="POST" action="{{ route('users.update', $u->id) }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    @if($u->id != 1)
                    <div class="form-group mb-2">
                        <label for="brand_id">{{__('assigned brand')}}</label>
                            <select id="brand_id" name="brand_id" class="form-control">
                            @foreach ($brands as $b)
                                @if($b->id == 1)
                                <option value="{{ $b->id }}" @if($u->brand_id == $b->id) selected @endif>
                                    {{ __('none')}}</option>
                                @else
                                <option value="{{ $b->id }}"  @if($u->brand_id == $b->id) selected @endif>
                                    {{ $b->brand }}
                                </option>
                                @endif

                            @endforeach
                            </select>
                    </div>
                    @endif
                    <div class="form-group mb-2">
                        <label for="name">{{__('name')}}</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $u->name }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">E-mail</label>
                        <input id="email" name="email" type="text" class="form-control" value="{{ $u->email }}">
                    </div>
                    @if($u->id != 1)
                    <div class="form-group mb-2">
                        <label for="role_id">{{__('role')}}</label>
                        <select id="role_id" name="role_id" class="form-control">
                            <option value="2" @if($u->role_id == 2) selected @endif>{{__('employee')}}</option>
                            <option value="3" @if($u->role_id == 3) selected @endif>{{__('user')}}</option>
                        </select>
                    </div>
                    @endif
                    <div class="text-center mt-4 mb-4">
                        <input class="btn btn-success" type="submit" value="{{__('send')}}">
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>
