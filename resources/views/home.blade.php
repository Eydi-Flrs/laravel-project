<x-home-master>

    @section('content')
        <br>
        <form method="get" class="form-inline" action="{{route('search')}}">
            @csrf
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="text" name="search" id="search" class="form-control mr-sm-2" placeholder="Search for...">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Go!</button>
                </div>

            </div>
        </form>

            <h1 class="my-4">Academic Resources</h1>
        <!-- Blog Post -->
        @foreach($posts as $post)

            <div class="card mb-4">
                <div class="card-body">
                    <div style="float: left">
                        <img src="{{$post->qr}}">
                    </div>

                    <h2 class="card-title">{{$post->title}}</h2>
                    <div>
                        <div style="text-align: justify" >
                            <p>Views: {{$post->views}}</p>
                            <p class="card-text">{{Str::limit($post->abstract,'280','...')}}</p>
                            <a href="{{route('post',$post->id)}}" class="btn btn-primary">Read More &rarr; </a>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    {{$post->created_at->diffForHumans()}}
                    <a href="#">KMS Admin</a>
                </div>
            </div>
        @endforeach

        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
                <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">Newer &rarr;</a>
            </li>
        </ul>
    @endsection

    @section('categories_widget')
        <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            @foreach($categories as $category)
                            <li>
                                <a href="#">{{$category->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    @endsection
</x-home-master>

