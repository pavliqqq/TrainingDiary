<div>
    @foreach($exercises as $exercise)
        <div><a href="#">{{ $exercise->id . '. ' . $exercise->name }}</a></div>
    @endforeach
</div>
