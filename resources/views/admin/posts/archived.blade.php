<x-admin-master>
    @section('content')
        <h1>All Posts</h1>
        @if(session('message'))
            <div class="alert alert-danger alert-dismissible fade show">{{session('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('post-created-message'))
            <div class="alert alert-success alert-dismissible fade show">{{session('post-created-message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('post-updated-message'))
            <div class="alert alert-success alert-dismissible fade show">{{session('post-updated-message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Course</th>
                            <th>Author</th>
                            <th>Date Published</th>
                            <th>Views</th>
                            <th>Restore</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Course</th>
                            <th>Author</th>
                            <th>Date Published</th>
                            <th>Views</th>
                            <th>Restore</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($posts as $post)
{{--                            @if(!is_null($post->deleted_at))--}}
                                <tr>

                                    <td>{{$post->id}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->category->name}}</td>
                                    <td>{{$post->course}}</td>
                                    <td>
                                        @foreach($post->authors as $author)
                                            {{$author->name}}
                                        @endforeach
                                    </td>
                                    <td>{{$post->date_published}}</td>
                                    <td>{{$post->views}}</td>
                                    <td>
                                        <form method="post" action="{{route('post.restore',$post->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">Restore</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#deleteModal-{{$post->id}}">
                                            Delete
                                        </a>

                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to permanently delete "{{strtoupper($post->title)}}" ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form method="post" action="{{route('post.destroy',$post->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="mx-auto">
                {{$posts->links()}}
            </div>
        </div>


    @endsection

    @section('scripts')
    <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

    @endsection
</x-admin-master>
