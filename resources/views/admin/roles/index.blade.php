<x-admin-master>
    @section('content')
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('roles.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Create</button>
                </form>
            </div>
            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Oprtions</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Oprtions</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </tfoot>
                                <tbody>
{{--                                @foreach($roles as $role)--}}
{{--                                    <tr>--}}
{{--                                        <td><input type="checkbox"--}}
{{--                                                   @foreach($user->roles as $user_role)--}}
{{--                                                   @if($user_role->slug == $role->slug)--}}
{{--                                                   checked--}}
{{--                                                @endif--}}
{{--                                                @endforeach--}}
{{--                                            ></td>--}}
{{--                                        <td>{{$role->id}}</td>--}}
{{--                                        <td>{{$role->name}}</td>--}}
{{--                                        <td>{{$role->slug}}</td>--}}
{{--                                        <form method="post" action="{{route('user.role.attach',$user)}}">--}}
{{--                                            @csrf--}}
{{--                                            @method("PUT")--}}
{{--                                            <input type="hidden" name="role" value="{{$role->id}}">--}}
{{--                                            <td><button class="btn btn-primary--}}
{{--                                             @if($user->roles->contains($role))--}}
{{--                                                    disabled--}}
{{--                                                    @endif--}}
{{--                                                    ">Attach</button></td>--}}
{{--                                        </form>--}}
{{--                                        <form method="post" action="{{route('user.role.detach',$user)}}">--}}
{{--                                            @csrf--}}
{{--                                            @method("PUT")--}}
{{--                                            <input type="hidden" name="role" value="{{$role->id}}">--}}
{{--                                            <td><button class="btn btn-danger--}}
{{--                                             @if(!$user->roles->contains($role))--}}
{{--                                                    disabled--}}
{{--                                                    @endif--}}
{{--                                                    ">Detach</button></td>--}}
{{--                                        </form>--}}



{{--                                    </tr>--}}
{{--                                @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
