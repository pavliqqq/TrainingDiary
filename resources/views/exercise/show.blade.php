@extends('layouts.main')
@section('content')
    <div>
        <div><a href="#">{{ $exercise->id . '. ' . $exercise->name }}</a></div>
    </div>
    <div>
        <a href="{{route('exercise.edit',$exercise->id)}}">Edit</a>
    </div>
    <div>
        <form action="{{route('exercise.delete',$exercise->id)}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    </div>
    <div>
        <a href="{{route('exercise.index')}}">Back</a>
    </div>
@endsection
