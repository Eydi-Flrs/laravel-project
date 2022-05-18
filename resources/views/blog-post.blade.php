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


           <div class="col-sm-12 mb-12 mb-sm-5">
{{--                    <embed src="{{$post->pdf}}" width="800px" height="2100px" />--}}
                    <a href="{{$post->pdf}}" class="btn btn-primary btn-user">
                        View Pdf File
                    </a>
           </div>






        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js" integrity="sha512-dw+7hmxlGiOvY3mCnzrPT5yoUwN/MRjVgYV7HGXqsiXnZeqsw1H9n9lsnnPu4kL2nx2bnrjFcuWK+P3lshekwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endsection
    @section('pdfview')
            @foreach($post->authors as $author)
                <div class="card m-1" style="width:768px; height:1344px; background-repeat:no-repeat; background-image:url('https://www.sony-asia.com/image/93375262915162c04b81617da973a2c4?fmt=pjpeg&wid=330&bgcolor=FFFFFF&bgc=FFFFFF') "></div>
            @endforeach

        @endsection
</x-home-master>
