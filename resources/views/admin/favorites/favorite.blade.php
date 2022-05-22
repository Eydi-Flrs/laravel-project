<x-home-master>
    @section('content')
        <div style="height:80vh">


        <h1>Favorites</h1>

        @if(session('message'))
            <div class="alert alert-danger">{{session('message')}}</div>
        @elseif(session('post-created-message'))
            <div class="alert alert-success">{{session('post-created-message')}}</div>
        @elseif(session('post-updated-message'))
            <div class="alert alert-success">{{session('post-updated-message')}}</div>
        @endif


                <div class="table-responsive">
                            @foreach($posts as $post)
                                    <div class="card w-75 m-3">
                                        <div class="card-body row">
                                            <h5 class="card-title"><a href="/post/{{$post->id}}">{{$post->title}}</a></h5>
                                            <div class="col-md-9"><p class="card-text">With supporting text below as a natural lead-in to additional content.</p></div>

                                                <div class="col-md-3"> <form action="{{route('favorite.destroy',$post->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">x</button>
                                                    </form></div>


                                        </div>
                                    </div>
                            @endforeach
                </div>
            <div class="d-flex">
                <div class="mx-auto">
                    {{$posts->links()}}
                </div>
            </div>
        </div>
    @endsection





</x-home-master>
