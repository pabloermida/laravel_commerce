@extends('app')
@section('content')
<div class="container">
    <h1>Create Product</h1>
    @if ($errors->any())
        <ul class="alert">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    {!! Form::open(['route'=>'products.store']) !!}
        <div class="form-group">
            {!! Form::label('category', 'Category:') !!}
            {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tags') !!}
            {!! Form::textarea('tags', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price') !!}
            {!! Form::text('price', 0, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('featured') !!}
            {!! Form::checkbox('featured', 1) !!}
        </div>
        <div class="form-group">
            {!! Form::label('recommend') !!}
            {!! Form::checkbox('recommend', 1) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Add Product', ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}
</div>
@endsection
