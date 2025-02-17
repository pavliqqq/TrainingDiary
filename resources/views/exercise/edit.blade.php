@extends('layouts.main')
@section('content')
    <div>
        <form action="{{route('exercise.update',$exercise->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="name">Name</label>
                <input
                    value="{{ $exercise->name }}"

                    type="text" name="name" class="form-control" id="name" placeholder="Name">
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <textarea type="text" name="category" class="form-control" id="category"
                          placeholder="Category">{{ $exercise->category }}</textarea>
                @error('category')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <img src="{{ asset($exercise->image) }}" alt="Текущее изображение" width="150">
                <div>
                    <label for="image">Загрузите новое изображение:</label>
                    <input type="file" name="image" id="image">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
@endsection
