<!doctype html>
<html lang="pl">

@include('shared.header')

<body>
    @include('shared.nav')

    <div class="container mt-5 mb-5">
        <div class="row mb-1">
            @if (session('error'))
            <div class="row d-flex justify-content-center">
                <div class="alert alert-danger">{{ session('error') }}</div>
            </div>
            @endif
            @if (session('message'))
            <div class="row d-flex justify-content-center">
                <div class="alert alert-success">{{ session('message') }}</div>
            </div>
            @endif
            <h1>{{__('brands')}}</h1>
            <div class="text-left">
                <a class="btn btn-primary btn-lg" href="{{route('brands.create')}}">{{__('add new brand')}}</a>
            </div>
            <div class="col-md-4">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('brand name')}}</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $b)
                    <tr>
                        <td>{{$b->id}}</td>
                        <td>{{__($b->brand)}}</td>
                        @can('is-admin') <td>
                        <a class="btn btn-sm btn-primary " href="{{route('brands.edit', $b->id)}}">{{__('edit')}}</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('brands.destroy', $b->id) }}">
                                    @csrf
                                    @can('is-admin')
                                    @method('DELETE')
                                    <input class="btn btn-sm btn-danger" type="submit" value="{{__('delete')}}"></button>
                                    @endcan
                                </form>
                       @endcan</td>
                    </tr>
                    @empty
                <tr>
                    <th scope="row" colspan="6">{{__('empty')}}</th>
                </tr>
                @endforelse
                </tbody>
            </table>
    </div>

</body>

</html>
