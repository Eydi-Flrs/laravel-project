<x-admin-master>
@section('content')
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('message'))
            <div class="alert alert-danger alert-dismissible fade show">{{session('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('category-created-message'))
                <div class="alert alert-success alert-dismissible fade show">{{session('category-created-message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('category-updated'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{session('category-updated')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Manage Categories</h1>
            <div class="d-flex flex-row-reverse bd-highlight">


            </div>
        </div>

        <!-- DataTales Example -->
        <div class="row">
            <div class="col-lg-6">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                            </div>
                            <br>
                            <div class="form-group row">

                                <form class="form-inline" action="{{route('categories.store')}}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="name" class="sr-only">category</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="name">
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">add</button>

                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Post Count</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Post Count</th>
                                            <th>Delete</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{$category->id}}</td>
                                                <td><a href="{{route('categories.edit',$category->id)}}">{{$category->name}}</a></td>
                                                <td>{{$category->slug}}</td>
                                                <td>{{$category->posts->count()}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$category->id}}">
                                                        Delete
                                                    </button>
                                                </td>
                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal-{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to permanently delete "{{strtoupper($category->name)}}" ?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                {{--                                    @can('view',$post)--}}
                                                                <form method="post" action="{{route('categories.destroy',$category->id)}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                                {{--                                    @endcan--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                </div>
            </div>


    @endsection
</x-admin-master>
