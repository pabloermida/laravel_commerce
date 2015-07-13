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
    {!! Form::model($category, ['route'=>['categories.update', $category->id], 'method'=>'PUT']) !!}
        @include('categories._form')
        <div class="form-group">
            {!! Form::submit('Update Category',  ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}
</div>
@endsection
