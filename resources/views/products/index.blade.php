@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Products</h1>

        @if (Auth::user() && Auth::user()->hasRole('admin'))
            <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Products</a>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td class="d-flex">
                            @auth
                               <a href="{{ route('products.buy', $product->id) }}" class="btn  btn-sm btn-primary mr-2">Comprar</a>
                           @else
                               <a href="{{ route('login') }}" class="btn btn-primary">Comprar</a>
                           @endauth
                              @if (Auth::user() && Auth::user()->hasRole('admin'))
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btnbtn sm btn-danger">Delete</button>
                                </form>
                                @endif
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
