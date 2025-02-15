@extends('layouts.main')
@section('content')
    <div>
        <div><a href="#">{{ $workout->id . '. ' . $workout->date }}</a></div>
    </div>
    <div class="d-inline-flex">
        <a href="{{route('workout.edit',$workout->id)}}" class="btn btn-info mt-3">Edit</a>
        <form action="{{route('workout.delete',$workout->id)}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger mt-3">
        </form>
    </div>
    <div>
        <a href="{{route('workout.index')}}" class="btn btn-secondary mt-3">Back</a>
    </div>
@endsection
