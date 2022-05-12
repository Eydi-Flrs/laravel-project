<x-home-master>
    @section('search')
        <div class="my-4">
            <form method="get" class="form-inline" action="{{route('search')}}">
                @csrf
                <div class="form-group row">
                    <h4>Advance Search</h4>
                    <div class="col-md-3">
                        <input type="text" name="title" id="search" class="form-control mr-sm-2" placeholder="Title">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="author" id="search" class="form-control mr-sm-2" placeholder="Author">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" aria-label="Default select example" id="category_id" name="category_id" >
                            <option selected value="">Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" aria-label="Default select example" id="year" name="year" >
                            <option selected value="">Year</option>
                            @for($i=0;$i<8;$i++)
                                <li>
                                    <option value="{{$carbon->year-$i}}">{{$carbon->year-$i}}</option>
                                </li>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>

    @endsection

    @section('content')



        <!-- Blog Post -->
        @foreach($posts as $post)

            <div class="card mb-4 my-4">
                <div class="card-body">
                    <div style="float: left">
                        <img src="{{$post->qr}}">
                    </div>
                    <a href="{{route('post',$post->id)}}"  style="text-decoration: none; color: #1a1e21"><h2 class="card-title">{{$post->title}}</h2></a>
                    <div>
                        <div style="text-align: justify" >
                            <p>Views: {{$post->views}}</p>
                            <p class="card-text">{{Str::limit($post->abstract,'280','...')}}</p>
                            <a href="{{route('post',$post->id)}}" class="btn btn-primary">Read More &rarr; </a>



                                    <form action="{{route('favorite.store')}}" method="post" enctype="multipart/form-data" autocomplete="off" >
                                        @csrf
                                        <input type="hidden" value="{{$post->id}}" name="post_id">
                                                <button @foreach($favorites as $favorite) @if($favorite->post_id === $post->id) hidden @else  @endif   @endforeach type="submit" class="btn btn-success">Add to Favorites</button>
                                    </form>
{{--                                    <form action="{{route('favorite.store')}}" method="post" enctype="multipart/form-data" autocomplete="off" >--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" value="{{$post->id}}" name="post_id">--}}
{{--                                        <button  @foreach($favorites as $favorite) @if($post->id !== $favorite->post_id)  @else disabled  @endif   @endforeach type="submit" class="btn btn-success">Remove to Favorites</button>--}}
{{--                                    </form>--}}




{{--                                    @if($favorite->post_id == $post->id)--}}
{{--                            <form action="{{route('favorite.store')}}" method="post" enctype="multipart/form-data" autocomplete="off" >--}}
{{--                                   @csrf--}}
{{--                                   <input type="hidden" value="{{$post->id}}" name="post_id">--}}
{{--                                   <button  type="submit" class="btn btn-danger"> Remove to Favorites</button>--}}
{{--                            </form>--}}
{{--                                @endif--}}

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
                                <a href="{{route('search.category',$category->id)}}">{{$category->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    @endsection

    @section('year')
            <div class="card my-4">
                <h5 class="card-header">Year</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                @for($i=0;$i<7;$i++)
                                    <li>
                                        <a href="{{route('search.year',$carbon->year-$i)}}">{{$carbon->year-$i}}</a>
                                    </li>
                                @endfor
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        @endsection

    @section('tags')
            <div class="card my-4">
                <h5 class="card-header">Tag</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                @foreach($tags as $tag)
                                    <li>
                                        <a href="{{route('search.tag',$tag->id)}}">{{$tag->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        @endsection
</x-home-master>

