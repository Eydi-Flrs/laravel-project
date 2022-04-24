<x-admin-master>
    @section('content')
        <h1>All Users</h1>
{{--        @if(session('message'))--}}
{{--            <div class="alert alert-danger">{{session('message')}}</div>--}}
{{--        @elseif(session('post-created-message'))--}}
{{--            <div class="alert alert-success">{{session('post-created-message')}}</div>--}}
{{--        @elseif(session('post-updated-message'))--}}
{{--            <div class="alert alert-success">{{session('post-updated-message')}}</div>--}}
{{--        @endif--}}

        @if(session('user-deleted'))
                    <div class="alert alert-danger">{{session('user-deleted')}}</div>
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
                            <th>Id</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Last seen</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td><a href="{{route('user.profile.show',$user->id)}}">{{$user->name}}</a></td>
{{--                                <td><img height="40px" src="{{$user->avatar}}" alt=""></td>--}}
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                <td>{{$user->updated_at->diffForHumans()}}</td>
                                <td>
                                    {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                </td>
                                <td>
                                    @if(Cache::has('user-is-online-' . $user->id))
                                        <span class="text-success">Online</span>
                                    @else
                                        <span class="text-secondary">Offline</span>
                                    @endif
                                </td>
                                <td>
                                    {{--                                    @can('view',$post)--}}
                                    <form method="post" action="{{route('user.destroy',$user->id)}}" enctype="multipart/form-data">
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
        <div class="d-flex">
            <div class="mx-auto">
{{--                {{$user->links()}}--}}
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
