<x-admin-master>
    @section('content')
        @section('content')
            @if(session('tag-updated'))
                <div class="alert alert-success">
                    {{session('tag-updated')}}
                </div>
            @endif
            <div class="row">
                <div class="col-sm-6">
                    <h1>Edit:{{$tag->name}}</h1>

                    <form method="post" action="{{route('tags.update',$tag->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$tag->name}}">
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
    @endsection
</x-admin-master>
