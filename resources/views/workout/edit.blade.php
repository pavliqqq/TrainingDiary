@extends('layouts.main')
@section('content')
    <div>
        <form action="{{route('workout.update',$workout->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="date">Date</label>
                <input
                    value="{{ $workout->date }}"

                    type="date" name="date" class="form-control" id="date" placeholder="Date">
                @error('date')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea type="text" name="notes" class="form-control" id="notes"
                          placeholder="Notes">{{ $exercise->notes }}</textarea>
                @error('notes')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
@endsection
