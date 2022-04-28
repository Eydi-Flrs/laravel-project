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

                    <a href="#" class="btn btn-danger" id="archivedAllSelected">Archived Selected</a>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="chkCheckAll"></th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Course</th>
                            <th>Author</th>
                            <th>Date Published</th>
                            <th>Views</th>
                            <th>Archived</th>
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
                            <th>Archived</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($posts as $post)
                            <tr id="pid{{$post->id}}">
                                <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{$post->id}}"/></td>
                                <td>{{$post->id}}</td>
                                <td><a href="{{route('post.edit',$post->id)}}">{{$post->title}}</a></td>
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
                                    <form method="post" action="{{route('post.destroy',$post->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Archived</button>
                                    </form>
                                </td>
                            </tr>
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
            <script>
                $(function(e){
                    $("#chkCheckAll").click(function(){
                        $(".checkBoxClass").prop('checked',$(this).prop('checked'));
                    });

                    $('#archivedAllSelected').click(function (e){
                        e.preventDefault();
                        var allids=[];

                        $("input:checkbox[name=ids]:checked").each(function (){
                           allids.push($(this).val());
                        });

                        $.ajax({
                            url:"{{route('post.deleteChecked')}}",
                            type:"DELETE",
                            data:{
                                _token:$("input[name=_token]").val(),
                                ids:allids
                            },
                            success:function (response){
                                $.each(allids,function(key,val){
                                    $("#pid"+val).remove();
                                })
                            }
                        });
                    })


                });
            </script>
        @endsection


</x-admin-master>
