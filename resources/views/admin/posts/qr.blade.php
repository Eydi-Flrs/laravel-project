<x-admin-master>
    @section('content')
        <div class="row">
            @foreach($posts as $post)
                <div class="col-4 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$post->title}}</div>
                                    <img src="{{$post->qr}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @endsection
</x-admin-master>
