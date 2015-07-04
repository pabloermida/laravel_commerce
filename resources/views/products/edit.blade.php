@extends('app')
@section('content')
<div class="container">
    <h1>Edit Product: {{ $product->name }}</h1>
    @if ($errors->any())
        <ul class="alert">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    {!! Form::open(['route'=>['products.update', $product->id], 'method'=>'PUT']) !!}
        <div class="form-group">
            {!! Form::label('category', 'Category:') !!}
            {!! Form::select('category_id', $categories, $product->category_id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name') !!}
            {!! Form::text('name',  $product->name, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description') !!}
            {!! Form::textarea('description', $product->description, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tags') !!}
            {!! Form::textarea('tags', $product->tags_to_text, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price') !!}
            {!! Form::text('price', $product->price, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('featured') !!}
            {!! Form::checkbox('featured', 1, $product->featured) !!}
        </div>
        <div class="form-group">
            {!! Form::label('recommend') !!}
            {!! Form::checkbox('recommend', 1, $product->recommend) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Update Product',  ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}
</div>
@endsection
