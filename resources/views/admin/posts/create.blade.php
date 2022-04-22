<x-admin-master>
    @section('content')
        <h1>Create Post</h1>


{{--            <div class="form-group">--}}
{{--                <label for="title">Title</label>--}}
{{--                <input type="text"--}}
{{--                       name="title"--}}
{{--                       class="form-control"--}}
{{--                       id="title"--}}
{{--                       aria-describedby=""--}}
{{--                       placeholder="Enter Title">--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label for="file">File</label>--}}
{{--                <input type="file"--}}
{{--                       name="post_image"--}}
{{--                       class="form-control-file"--}}
{{--                       id="post_image"--}}
{{--                       aria-describedby="">--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <textarea name="body" id="body" class="form-control" cols="30" rows="10"></textarea>--}}
{{--            </div>--}}



        <div class="col-md-12">


                        <div class="card mb-4">
                            <div class="card-body">

                                <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <h3>Authors</h3>

                                        <table class="table table-sm table-responsive" >
                                            <thead>
                                            <tr>
                                                <th class="col-sm-3">Lastname</th>
                                                <th class="col-sm-3">Firstname</th>
                                                <th class="col-sm-2">M.I</th>
                                                <th class="col-sm-1">Suffix</th>
                                                <th class="col-sm-3">Email</th>
                                                <th><a href="javascript:void(0)" class="btn btn-primary addRow">Add</a></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="col-sm-3"><input type="text" class="form-control form-control-user" id="lastname" name="lastname[]" placeholder="Last Name" required></td>
                                                    <td class="col-sm-3"><input type="text" class="form-control form-control-user" id="firstname" name="firstname[]" placeholder="First Name"required></td>
                                                    <td class="col-sm-2"><input type="text" class="form-control form-control-user" id="middle_initial" name="middle_initial[]" placeholder="Middle Initial"></td>
                                                    <td class="col-sm-1"><input type="text" class="form-control form-control-user" id="suffix"  name="suffix[]" placeholder="Suffix"></td>
                                                    <td class="col-sm-3"><input type="email" class="form-control form-control-user" id="email" name="email[]" placeholder="Email"></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-danger deleteRow">Delete</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>


                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                        <label for="course">Course</label>
                                        <select class="form-select" aria-label="Default select example" id="course" name="course">
                                            <option selected value="Bachelor of Science in Information System">Bachelor of Science in Information System</option>
                                            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
                                            <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science</option>
                                        </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="type">Type</label>
                                            <select class="form-select" aria-label="Default select example" id="type" name="type">
                                                <option selected value="Thesis Paper">Thesis Paper</option>
                                                <option value="Book">Book</option>

                                            </select>
                                        </div>
                                    </div>



                                    <h3>Publication Info</h3>
                                    <div class="form-group ">
                                        <label for="title">Title</label><input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter Title" required>
                                    </div>



                                    <div class="form-group row">

                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <label for="category_id">Categories</label>
                                            <select class="form-select" aria-label="Default select example" id="category_id" name="category_id">
                                                @foreach($categories as $category)
                                                    <option selected value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($tags->count()>0)
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <label for="tag_id">Tags</label>
                                            <select class="form-select" aria-label="Default select example" id="tag_id" name="tag_id[]" multiple>
                                                @foreach($tags as $tag)
                                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                        <div class="col-sm-4">
                                            <label for="date_published">Date Published</label><input type="date" class="form-control form-control-user" id="date_published" name="date_published" placeholder="Date published" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="pages">Pages</label><input type="number" class="form-control form-control-user" id="pages" name="pages" placeholder="Pages" required>
                                        </div>
                                    </div>

                                    <h3>Advanced Info (applicable for books only)</h3>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <label for="volume">Volume</label><input type="text" class="form-control form-control-user" id="volume" name="volume" placeholder="Volume" >
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="series">Series</label><input type="text" class="form-control form-control-user" id="series" name="series" placeholder="Series" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <label for="publisher">Publisher</label><input type="text" class="form-control form-control-user" id="publisher" name="publisher"  placeholder="Publisher" >
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="year">Year Published</label><input  onkeypress="return onlyNumberKey(event)"   type="text" class="form-control form-control-user" id="year" minlength="4" maxlength="4" name="year"placeholder="Year Published" >
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="pdf">Attach PDF File</label><input type="file" name="pdf" class="form-control-file" id="pdf" placeholder="Attach File" aria-describedby="" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="abstract">Abstract</label>
                                        <textarea name="abstract" id="body" class="form-control" cols="30" rows="10" required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                            </div>
                        </div>

        </div>


        <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
        <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js')}}"></script>
        <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css')}}" rel="stylesheet"/>

        <script>
        $("#year").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });

        function onlyNumberKey(evt) {
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
        </script>
        <script>
            $('thead').on('click','.addRow',function (){
                var tr=
                    "<tr>"+
                    " <td class='col-sm-3'><input type='text' class='form-control' form-control-user id='lastname' name='lastname[]' placeholder='Last Name' required></td>"+
                    " <td class='col-sm-3'><input type='text' class='form-control' form-control-user id='firstname' name='firstname[]' placeholder='First Name' required></td>"+
                    " <td class='col-sm-2'><input type='text' class='form-control' form-control-user id='middle_initial' name='middle_initial[]' placeholder='Middle Initial' required></td>"+
                    " <td class='col-sm-1'><input type='text' class='form-control' form-control-user id='suffix' name='suffix[]' placeholder='Suffix' required></td>"+
                    " <td class='col-sm-3'><input type='text' class='form-control' form-control-user id='email' name='email[]' placeholder='Email' required></td>"+
                    "<td><a href='javascript:void(0)' class='btn btn-danger deleteRow'>Delete</a></td>"+
                    "</tr>"
                $('tbody').append(tr);
            });

            $('tbody').on('click','.deleteRow',function (){
               $(this).parent().parent().remove();
            });


        </script>
    @endsection
</x-admin-master>
