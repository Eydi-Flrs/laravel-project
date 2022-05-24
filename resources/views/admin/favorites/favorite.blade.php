<x-home-master>
    @section('content')
        <div style="height:80vh">


        <h1>Saved Academic resource</h1>

        @if(session('message'))
            <div class="alert alert-danger alert-dismissible fade show">{{session('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
                                                        <input type="hidden" value="{{$post->title}}" name="title"/>
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
