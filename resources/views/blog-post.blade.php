<x-home-master>
    @section('content')
{{--        <!-- Title -->--}}
{{--            <h1 class="mt-4">{{$post->title}}</h1>--}}
{{--            <!-- Author -->--}}
{{--            <p class="lead">--}}
{{--                by--}}
{{--                <a href="#">{{$post->user->name}}</a>--}}
{{--            </p>--}}
{{--            <hr>--}}
{{--            <!-- Date/Time -->--}}
{{--            <p>Posted on {{$post->created_at->diffForHumans()}}</p>--}}
{{--            <hr>--}}
{{--            <!-- Preview Image -->--}}
{{--            <img class="img-fluid rounded" src="{{$post->post_image}}" alt="">--}}

{{--            <hr>--}}
{{--            <!-- Post Content -->--}}
{{--            <p>{{$post->body}}</p>--}}
{{--            <hr>--}}
{{--            <!-- Comments Form -->--}}
{{--            <div class="card my-4">--}}
{{--                <h5 class="card-header">Leave a Comment:</h5>--}}
{{--                <div class="card-body">--}}
{{--                    <form>--}}
{{--                        <div class="form-group">--}}
{{--                            <textarea class="form-control" rows="3"></textarea>--}}
{{--                        </div>--}}
{{--                        <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div style="float: right">
                <img src="{{$post->qr}}">
            </div>

            <!-- Title -->
            <h1 class="my-5">{{$post->title}}</h1>
            <!-- Author -->
            <h4>Authors:</h4>
            @foreach($post->authors as $author)
            {{$author->name."  ,"}}
            @endforeach
            <hr>
            <!-- Date/Time -->
            <p>Published Date: {{$post->date_published}}</p>

            <div class="card mb-4">
                <div class="card-body">
                    <div>
                        <div style="text-align: justify" >
                            <h1>Abstract</h1  >
                            <p>{{$post->abstract}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="col-sm-12 mb-12 mb-sm-5">
{{--                    <embed src="{{$post->pdf}}" width="800px" height="2100px" />--}}
                    <a href="{{$post->pdf}}" class="btn btn-primary btn-user">
                        View Pdf File
                    </a>
                </div>
            </div>

    @endsection
</x-home-master>
