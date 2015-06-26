@extends('app')
@section('content')
<div class="container">
    <h1>Edit Category: {{ $category->name }}</h1>
    @if ($errors->any())
        <ul class="alert">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    {!! Form::open(['route'=>['categories.update', $category->id], 'method'=>'PUT']) !!}
        <div class="form-group">
            {!! Form::label('name') !!}
            {!! Form::text('name',  $category->name, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description') !!}
            {!! Form::textarea('description', $category->description, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Update Category',  ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}
</div>
@endsection
