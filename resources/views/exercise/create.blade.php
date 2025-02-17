@extends('layouts.main')
@section('content')
    <div>
        <form action="{{route('exercise.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input
                    value="{{old('name')}}"

                    type="text" name="name" class="form-control" id="name" placeholder="Name">
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <textarea type="text" name="category" class="form-control" id="category"
                          placeholder="Category">{{old('category')}}</textarea>
                @error('category')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input
                    value="{{old('image')}}"

                    type="file" name="image" class="form-control" id="image" placeholder="Image">
                @error('image')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </form>
    </div>
@endsection
