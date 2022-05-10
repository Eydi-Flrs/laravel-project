<x-home-master>
    @section('content')



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
             <p>Views: {{$post->views}}</p>
             <p>
                <div class="product-wish">
                    <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                </div>
             </p>
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
