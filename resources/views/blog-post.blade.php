<x-home-master>
    @section('content')



            <div style="float: right">
                <img src="{{$post->qr}}">
            </div>
            <!-- Title -->
            <h1 class="my-3">{{$post->title}}</h1>
        <h6>Views: {{$post->views}}</h6>
        <br>
            <!-- Author -->
            <h6>Authors: @foreach($post->authors as $author)
                    {{$author->name."  ,"}}
            @endforeach</h6>
        @if($post->type !='Book')
        <h6>email: @foreach($post->authors as $author)
                {{$author->email."  ,"}}
        @endforeach</h6>
        @endif

            @if($post->type ==='Book')
            <h6>Vol: {{$post->volume}} Series: {{$post->series}} Publisher: {{$post->publisher}}</h6>
            <h6>ISBN: {{$post->isbn}} DCC: {{$post->dcc}} Author No.: {{$post->authornumber}}</h6>
            @endif
    <!-- Date/Time -->
            <p>Published Date: {{$date}}</p>
            <hr>
            <h6>Category: {{$post->category->name}}</h6>
            <h6>Tags:
                @foreach($post->tags as $tag)
                    {{$tag->name."  ,"}}
                @endforeach
            </h6>


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

         @if(in_array($post->id,$paid))
           <div class="col-sm-12 mb-12 mb-sm-5">
{{--                    <embed src="{{$post->pdf}}" width="800px" height="2100px" />--}}
                    <a href="{{route('pdf.download',$post->id)}}" class="btn btn-primary btn-user">
                        Download Pdf File
                    </a>
               <input type="text" value="{{$post->id}}" id="number" hidden>
           </div>
        @else
        <form action="{{route('payment',$post->id)}}" method="post">
            @csrf
            <input type="hidden" name="amount" value="5" >
            <input type="hidden" name="slug" value="{{$post->slug}}" >
            <button type="submit" class="btn btn-primary btn-user">pay with paypal</button>
        </form>
{{--        <div id="paypal-button-container"></div>--}}
        @endif

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js" integrity="sha512-dw+7hmxlGiOvY3mCnzrPT5yoUwN/MRjVgYV7HGXqsiXnZeqsw1H9n9lsnnPu4kL2nx2bnrjFcuWK+P3lshekwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Sample PayPal credentials (client-id) are included -->
        <script src="https://www.paypal.com/sdk/js?client-id=ATnqekIBSFUGwgQ59m6DtJF8-aeBVZbkjK8Vwh8-LlVRtkxoif0CHqsCtpyQNd3AlSf5HimPJpQ5k1HB&currency=USD&intent=capture&enable-funding=venmo"></script>
        <script>

            const paypalButtonsComponent = paypal.Buttons({
                // optional styling for buttons
                // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
                style: {
                    color: "gold",
                    shape: "rect",
                    layout: "vertical"
                },

                // set up the transaction
                createOrder: (data, actions) => {
                    // pass in any options from the v2 orders create call:
                    // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
                    const createOrderPayload = {
                        purchase_units: [
                            {
                                amount: {
                                    value: "5"
                                }
                            }
                        ]
                    };

                    return actions.order.create(createOrderPayload);
                },

                // finalize the transaction
                onApprove: (data, actions) => {
                    const number=document.getElementById("number").value;
                    // window.location.href = '/posts/'.number.'/pdf';
                    const captureOrderHandler = (details) => {
                        const payerName = details.payer.name.given_name;
                        console.log('Transaction completed');

                    };

                    return actions.order.capture().then(captureOrderHandler);

                },


                // handle unrecoverable errors
                onError: (err) => {
                    console.error('An error prevented the buyer from checking out with PayPal');
                }
            });

            paypalButtonsComponent
                .render("#paypal-button-container")
                .catch((err) => {
                    console.error('PayPal Buttons failed to render');
                });
        </script>
    @endsection
    @section('pdfview')
            @foreach($post->images as $image)
                <div class="card m-1" style="width:768px; height:1344px; background-repeat:no-repeat; background-size: contain; background-image:url('{{$image->image}}') "></div>
            @endforeach

        @endsection
</x-home-master>
