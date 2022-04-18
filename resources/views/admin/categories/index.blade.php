<x-admin-master>
@section('content')
        @if(session('message'))
            <div class="alert alert-danger">{{session('message')}}</div>
        @elseif(session('category-created-message'))
            @endif
    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Manage Categories</h1>
            <div class="d-flex flex-row-reverse bd-highlight">

                <a data-toggle="modal" data-target="#deleteModal">
                    <button class="btn btn-primary" type="submit">
                        Delete
                    </button>

                </a>
            </div>
        </div>

        <!-- DataTales Example -->

        <div class="row">


            <div class="col-lg-6">


                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Manage Categories</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Delete</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{$category->id}}</td>
                                                <td>{{$category->name}}</td>
                                                <td>{{$category->slug}}</td>
                                                <td>
                                                    {{--                                    @can('view',$post)--}}
                                                    <form method="post" action="{{route('categories.destroy',$category->id)}}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    {{--                                    @endcan--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-lg-6">

                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="card mb-4">
                            <div class="card-body">



                                <div class="form-group row">

                                    <form class="form-inline" action="{{route('categories.store')}}" method="post">
                                        @csrf
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="category" class="sr-only">category</label>
                                            <input type="text" class="form-control" id="category" name="category" placeholder="name">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">add</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    @endsection
</x-admin-master>
