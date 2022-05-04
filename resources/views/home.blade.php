<x-home-master>

    @section('content')

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


</x-home-master>

