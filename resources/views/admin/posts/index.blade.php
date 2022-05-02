<x-admin-master>
    @section('content')
        <h1>All Posts</h1>
        @if(session('message'))
           <div class="alert alert-danger">{{session('message')}}</div>
            @elseif(session('post-created-message'))
            <div class="alert alert-success">{{session('post-created-message')}}</div>
            @elseif(session('post-updated-message'))
            <div class="alert alert-success">{{session('post-updated-message')}}</div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <form action="{{route('post.deleteChecked')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="delete_all" class="btn btn-danger like" value="archived selected">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="options"></th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Course</th>
                            <th>Author</th>
                            <th>Date Published</th>
                            <th>Views</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                           <th></th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Course</th>
                            <th>Author</th>
                            <th>Date Published</th>
                            <th>Views</th>
                            <th>Edit</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($posts as $post)
                            <tr id="pid{{$post->id}}">
                                <td><input type="checkbox" name="checkBoxArray[]" class="checkBoxes" value="{{$post->id}}"/></td>
                                <td>{{$post->id}}</td>
                                <td><a href="/post/{{$post->id}}">{{$post->title}}</a></td>
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
{{--                                        <input type="hidden" name="post" value={{$post->id}}>--}}
{{--                                        <input type="submit" name= "delete_single" class="btn btn-danger" value="Archived">--}}
                                    <a href="{{route('post.edit',$post->id)}}" class="btn btn-primary">Edit</a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </form>
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
            <script>

            </script>
            <script>
                $(function(e){
                    $("#options").click(function(){
                        $(".checkBoxes").prop('checked',$(this).prop('checked'));
                    });
                });
            </script>
        @endsection


</x-admin-master>
