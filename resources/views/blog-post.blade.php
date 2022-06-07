<x-home-master>
    @section('contactus')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Karla:wght@500&family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">
        <div class="p-3 py-5">

            <div  style="float: right; margin-top: 10px; ">
                <img style="height: 10rem;" src="{{$post->qr}}">
            </div>
            <!-- Title -->
            <h1 class="my-2">{{$post->title}}</h1>
            <h6>Views: {{$post->views}}</h6>
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
{{--            @if(in_array($post->id,$paid))--}}

{{--                    <embed src="{{$post->pdf}}" width="800px" height="2100px" />--}}
                    <a href="{{route('pdf.download',$post->id)}}" class="btn btn-primary btn-user">
                        Download Pdf File
                    </a>
               <input type="text" value="{{$post->id}}" id="number" hidden>

{{--        @else--}}
{{--        <form action="{{route('payment',$post->id)}}" method="post">--}}
{{--            @csrf--}}
{{--            <input type="hidden" name="amount" value="5" >--}}
{{--            <input type="hidden" name="slug" value="{{$post->slug}}" >--}}
{{--            Want to get a Copy? --}}
{{--            <button type="submit" class="btn btn-warning btn-user">--}}
{{--                <i class="fa-brands fa-paypal fa-sm fa-fw mr-2 text-gray-400"> </i> Pay--}}
{{--            </button>--}}
{{--        </form>--}}
{{--        <div id="paypal-button-container"></div>--}}
{{--        @endif--}}
</div>
<br>
            <div class="card mb-4" >
                <div class="card-body" >
                    <div>
                        <div style="text-align: justify " >
                            <h1>Abstract</h1  >
                            <p>{{$post->abstract}}</p>
                        </div>
                    </div>
                </div>
            </div>



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
    <div style="width: 50rem; margin: auto;
    display: block; ">
            @foreach($post->images as $image)
                <div class="card m-1" style="width: 100%; height:84rem; background-repeat:no-repeat; background-size: contain; background-image:url('{{$image->image}}') "></div>
            @endforeach
</div>
</div>
        @endsection
</x-home-master>
