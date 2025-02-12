
    <div>
        <form method="post">
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
                <textarea type="text" name="category" class="form-control" id="category" placeholder="Content">{{old('content')}}</textarea>
                @error('category')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </form>
    </div>
