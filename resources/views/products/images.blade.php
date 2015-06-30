@extends('app')
@section('content')
<div class="container">
    <h1>Images of {{ $product->name }}</h1>
    <p>
        <a href="{{ route('products.images.create', ['id'=>$product->id]) }}" class="btn btn-default">New Image</a>
    </p>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Extension</th>
            <th>Action</th>
        </tr>
        @foreach($product->images as $image)
            <tr>
                <td>{{ $image->id }}</td>
                <td><img src="{{ $image->location }}" width="80"></td>
                <td>{{ $image->extension }}</td>
                <td> <a href="{{ route('products.image.destroy', ['id'=>$image->id]) }}">Delete</a></td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('products') }}" class="btn btn-default">Back</a>

</div>
@endsection
