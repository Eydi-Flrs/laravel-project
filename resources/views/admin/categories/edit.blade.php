<x-admin-master>
    @section('content')
        @section('content')
            @if(session('category-updated'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{session('category-updated')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
