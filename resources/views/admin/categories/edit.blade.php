<x-admin-master>
    @section('content')
        @section('content')
            @if(session('category-updated'))
                <div class="alert alert-success">
                    {{session('category-updated')}}
                </div>
            @endif
            <div class="row">
                <div class="col-sm-6">
                    <h1>Edit:{{$category->name}}</h1>

                    <form method="post" action="{{route('categories.update',$category->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$category->name}}">
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
    @endsection
</x-admin-master>
