<x-home-master>
@section('homepage')
    <div style="background-image: url({{asset('/storage/images/profile/lib.jpg')}});
        min-height: 500px;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;">
        <div  style="
            color: #fff;
            padding: 18px;
            font-size: 25px;
            letter-spacing: 10px;">
            <span style="position: absolute;
            left: 0;
            top: 25%;
            width: 100%;
            text-align: center;
            color: white;"><img src="{{asset('/storage/images/profile/yellowcos.png')}}" style="height: 6rem;" alt=""><h1 class="fw-bold "
style="text-shadow: 2px 3px #000000; "><br>KNOWLEDGE MANAGEMENT SYSTEM</h1></span>
        </div>
        </div>
{{--<img src="{{asset('/storage/images/profile/COS.jpg')}}" class="img-fluid d-block w-100% " alt="Responsive image">--}}
@endsection
    @section('search')
        <div class="my-4">
            <form method="get" class="form-inline" action="{{route('search')}}" autocomplete="off">
                @csrf
                <div class="form-group row">
                    <h4>Advanced Search</h4>
                    <div class="col-md-6">
                        <input type="text" name="title" id="search" class="form-control mr-sm-2" placeholder="Title">
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="author" id="search" class="form-control mr-sm-2" placeholder="Author">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-md-3 m-1">
                        <select class="form-select" aria-label="Default select example" id="category_id" name="category_id" >
                            <option selected value="">Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 m-1">
                        <select class="form-select" aria-label="Default select example" id="year" name="year" >
                            <option selected value="">Year</option>
                            @for($i=0;$i<7;$i++)
                                <li>
                                    <option value="{{$carbon->year-$i}}">{{$carbon->year-$i}}</option>
                                </li>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-2 m-1">
                        <select class="form-select" aria-label="Default select example" id="course" name="course" >
                            <option selected value="">Course</option>
                            <option value="Bachelor of Science in Information System">Bachelor of Science in Information System</option>
                            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
                            <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science</option>
                        </select>
                    </div>

                    <div class="col-md-2 m-1">
                        <select class="form-select" aria-label="Default select example" id="type" name="type" >
                            <option selected value="">Type</option>
                            <option value="Thesis Paper">Thesis Paper</option>
                            <option value="Book">Books</option>
                        </select>
                    </div>

                    <div class="col-md-1 m-1">
                        <button class="btn btn-secondary my-2 my-sm-0" style="width: 160px;" type="submit">Search</button>
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
                    <div class="row">
                        <div class="col-xs-6 col-lg-3">
                            {{--                    <div style="float: left;margin-right: 2rem;">--}}
                            @foreach($post->images as $image)
                                @if ($loop->first)
                                    <img style="height: 20em" src="{{$image->image}}" alt="">
                                @endif
                            @endforeach
                        </div>
                        <div class="col-xs-6 col-lg-9">
                            <a href="{{route('post',[$post->id,$post->slug])}}"  style="text-decoration: none; color: #1a1e21; "><h2 class="card-title">{{$post->title}}</h2></a>

                            <div style="text-align: justify" >
                                <p>Views: {{$post->views}}</p>

                                <p class="card-text">{{Str::limit($post->abstract,'280','...')}}</p>
                                <div class="form-group row">
                                    <div class="col-sm-3">

                                        <a href="{{route('post',[$post->id,$post->slug])}}" >
                                            <button class="btn btn-primary ">
                                                Read More &raquo;
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-sm-4">
                                        <form action="{{route('favorite.store')}}" method="post" enctype="multipart/form-data" autocomplete="off" >
                                            @csrf
                                            <input type="hidden" value="{{$post->id}}" name="post_id">
                                            <button @foreach($favorites as $favorite) @if($favorite->post_id === $post->id)  hidden
                                                    @endif   @endforeach type="submit" class="btn btn-success ">Read It Later &raquo; </button>
                                            {{--need lumabas message--}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer text-muted">
                    {{$post->created_at->diffForHumans()}}
                    <a href="#">KMS Admin</a>
                </div>
            </div>
        @endforeach

{{--        <!-- Pagination -->--}}
{{--        <ul class="pagination justify-content-center mb-4">--}}
{{--            <li class="page-item">--}}
{{--                <a class="page-link" href="#">&larr; Older</a>--}}
{{--            </li>--}}
{{--            <li class="page-item disabled">--}}
{{--                <a class="page-link" href="#">Newer &rarr;</a>--}}
{{--            </li>--}}
{{--        </ul>--}}

            <div class="d-flex">
                <div class="mx-auto">
                    {{$posts->links()}}
                </div>
            </div>
    @endsection

    @section('categories_widget')

                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            @foreach($categories as $category)
                            <li>
                                <a href="{{route('search.category',[$category->id,$category->slug])}}">{{$category->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>


    @endsection

    @section('year')

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


        @endsection

    @section('tags')

                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                @foreach($tags as $tag)
                                    <li>
                                        <a href="{{route('search.tag',[$tag->id,$tag->slug])}}">{{$tag->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

        @endsection
        @section('top-views')
            <div class="card my-4">
                <h5 class="card-header">Top Views</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled mb-0">
                                @foreach($allposts->sortByDesc('views')->take(10) as $key=>$post)
                                  <h5> {{++$key}})<a href="{{route('post',[$post->id,$post->slug])}}"> {{$post->title}} </a>:  {{$post->views." views"}}</h5>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        @endsection
</x-home-master>

