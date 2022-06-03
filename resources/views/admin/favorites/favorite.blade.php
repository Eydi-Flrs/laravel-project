<x-home-master>
    @section('contactus')
        <div style="height:80vh">
        <div class="p-3 py-5">

        <h1 class="m-5">Saved Academic Resources</h1>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        

        @if(session('message'))
      
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{session('message')}}
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

                                    <div class="card m-3 ">
                                        <div class="d-flex align-items-center">
                                        <div class="card-body row" style= "background-color: #ffe9aa;">
                                            <h5 class="card-title fw-bold"><a style="color: #000000;"  href="{{route('post',[$post->id,$post->slug])}}">{{$post->title}}</a></h5>
                                            <div class="col-md-11"><p class="card-text">{{Str::limit($post->abstract,'280','...')}}</p></div>

                                                <div class="col-md-1" > <form action="{{route('favorite.destroy',$post->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" value="{{$post->title}}" name="title"/>
                                                        <button type="submit" class="btn btn-warning"><i class="fa fa-trash fa-sm fa-fw mr-2 text-gray-400 " aria-hidden="true"></i> </button>
                                                    </form></div>
                                        </div>
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
        </div>
    </div>
    @endsection





</x-home-master>
