<x-home-master>
    @section('profile')
            <div class="container rounded bg-white mt-5 mb-5">
            <form method="post" action="{{route('user.profile.update',$user)}}" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-3 ">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                            <img class="rounded-circle"  id="output" src="{{$user->avatar}}" width="90%"><span class="font-weight-bold">{{$user->name}}</span>
                        </div>
                        <div class="form-group">
                            <input type="file" name="avatar"  accept="image/*" id="file"  onchange="loadFile(event)">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="p-3 py-5">
                            <div class="card mb-12">

                                <div class="card-body justify-content">

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h3>User Profile for: {{$user->name}}</h3>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-6">  <label for="firstname">Name</label><input type="text" name="firstname" class="form-control" value="{{$user->firstname}}"></div>

                                        <div class="col-md-6">  <label for="firstname">LastName</label><input type="text" name="lastname" class="form-control" value="{{$user->lastname}}"></div>
                                    </div>
                                    <div class=" form-group row">
                                        <div class="col-md-12"> <label for="email">Email</label> <input type="text" class="form-control" name="email" value="{{$user->email}}" ></div>

                                        <div class="col-md-12"> <label for="contact_number">Contact Number</label><input type="text" name="contact_number" class="form-control" value="{{$user->contact_number}}" ></div>
                                    </div>
                                    <br>
                                    <div class="form-group row">

                                        <div class="col-sm-6">
                                            <input type="password"
                                                   name="password"
                                                   class="form-control"
                                                   id="password"
                                                   aria-describedby=""
                                                   placeholder="Password">
                                            @error('password')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">

                                            <input type="password"
                                                   name="password_confirmation"
                                                   class="form-control"
                                                   id="password_confirmation"
                                                   aria-describedby=""
                                                   placeholder="Confirm Password">
                                            @error('password_confirmation')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-primary" href="login.html">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @if(auth()->user()->userHasRole('ADMIN'))
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Make User admin</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td><input type="checkbox"
                                            @foreach($user->roles as $user_role)
                                                @if($user_role->slug == $role->slug)
                                                    checked
                                                   @endif
                                                @endforeach
                                            ></td>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                        <form method="post" action="{{route('user.role.attach',$user)}}">
                                            @csrf
                                            @method("PUT")
                                            <input type="hidden" name="role" value="{{$role->id}}">
                                            <button class="btn btn-primary
                                             @if($user->roles->contains($role))
                                                    disabled
                                                    @endif
                                            ">Attach</button>
                                        </form></td>
                                        <td>
                                        <form method="post" action="{{route('user.role.detach',$user)}}">
                                            @csrf
                                            @method("PUT")
                                            <input type="hidden" name="role" value="{{$role->id}}">
                                            <button class="btn btn-danger
                                             @if(!$user->roles->contains($role))
                                                    disabled
                                                    @endif
                                            ">Detach</button>
                                        </form></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <script>
            var loadFile = function(event) {
                var image = document.getElementById('output');
                image.src = URL.createObjectURL(event.target.files[0]);
            };
        </script>
    @endsection
</x-home-master>
