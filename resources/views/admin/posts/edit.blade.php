<x-admin-master>
    @section('content')
        <h1>Edit a Post</h1>

{{--        <form method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            @method('PATCH')--}}
{{--            <div class="form-group">--}}
{{--                <label for="title">Title</label>--}}
{{--                <input type="text"--}}
{{--                       name="title"--}}
{{--                       class="form-control"--}}
{{--                       id="title"--}}
{{--                       aria-describedby=""--}}
{{--                       placeholder="Enter Title"--}}
{{--                       value="{{$post->title}}"--}}
{{--                >--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <div><img height="100px" src="{{$post->post_image}}" alt=""></div>--}}
{{--                <label for="file">File</label>--}}
{{--                <input type="file"--}}
{{--                       name="post_image"--}}
{{--                       class="form-control-file"--}}
{{--                       id="post_image"--}}
{{--                       aria-describedby="">--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <textarea name="body" id="body" class="form-control" cols="30" rows="10">{{$post->body}}</textarea>--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--        </form>--}}


        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <h3>Authors</h3>

                        <table class="table table-sm table-responsive" >
                            <thead>
                            <tr>
                                <th class="col-sm-3">Lastname</th>
                                <th class="col-sm-3">Firstname</th>
                                <th class="col-sm-2">M.I</th>
                                <th class="col-sm-1">Suffix</th>
                                <th class="col-sm-3">Email</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($post->authors as $author)
                            <tr>
                                <td class="col-sm-3"><input value="{{$author->lastname}}" type="text" class="form-control form-control-user @error('lastname') is-invalid @enderror" id="lastname" name="lastname[]" placeholder="Last Name" required></td>
                                <td class="col-sm-3"><input value="{{$author->firstname}}"type="text" class="form-control form-control-user @error('firstname') is-invalid @enderror" id="firstname" name="firstname[]" placeholder="First Name" required></td>
                                <td class="col-sm-2"><input value="{{$author->middle_initial}}" type="text" class="form-control form-control-user" id="middle_initial" name="middle_initial[]" placeholder="Middle Initial"></td>
                                <td class="col-sm-1"><input value="{{$author->suffix}}" type="text" class="form-control form-control-user" id="suffix"  name="suffix[]" placeholder="Suffix"></td>
                                <td class="col-sm-3"><input value="{{$author->email}}"type="email" class="form-control form-control-user" id="email" name="email[]" placeholder="Email"></td>
                                <td>
                                    @if($loop->first)
                                        <a href="javascript:void(0)" class="btn btn-primary addRow">+</a>
                                    @else
                                        <a href='javascript:void(0)' class='btn btn-danger deleteRow'>-</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="course">Course</label>
                                <select class="form-select" aria-label="Default select example" id="course" name="course" required>
                                    <option @if($post->course=="Bachelor of Science in Information System") selected @endif value="Bachelor of Science in Information System">Bachelor of Science in Information System</option>
                                    <option @if($post->course=="Bachelor of Science in Information Technology") selected @endif value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
                                    <option @if($post->course=="Bachelor of Science in Computer Science")selected @endif value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="type">Type</label>
                                <select class="form-select" aria-label="Default select example" id="type" name="type">
                                    <option @if($post->type=="Thesis Paper")selected @endif value="Thesis Paper">Thesis Paper</option>
                                    <option @if($post->type=="Book")selected @endif value="Book">Book</option>

                                </select>
                            </div>
                        </div>



                        <h3>Publication Info</h3>
                        <div class="form-group ">
                            <label for="title">Title</label><input value="{{$post->title}}" type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter Title" required>
                        </div>



                        <div class="form-group row">

                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="category_id">Categories</label>
                                <select class="form-select" aria-label="Default select example" id="category_id" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option @if($post->category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($tags->count()>0)
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label for="tag_id">Tags</label>
                                    <select class="form-select" aria-label="Default select example" id="tag_id" name="tag_id[]" multiple required>
                                        @foreach($tags as $tag)
                                            <option
                                                @if(isset($post))
                                                @if($post->hasTag($tag->id)) selected @endif
                                                @endif
                                            value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="col-sm-4">
                                <label for="date_published">Date Published</label><input  value="{{$post->date_published}}" type="date" class="form-control form-control-user" id="date_published" name="date_published" placeholder="Date published">
                            </div>
                            <div class="col-sm-4">
                                <label for="pages">Pages</label><input value="{{$post->pages}}" type="number" class="form-control form-control-user" id="pages" name="pages" placeholder="Pages" required>
                            </div>
                        </div>

                        <h3>Advanced Info (applicable for books only)</h3>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-2 mb-sm-0">
                                <label for="volume">Volume</label><input value="{{$post->volume}}" type="text" class="form-control form-control-user" id="volume" name="volume" placeholder="Volume" >
                            </div>
                            <div class="col-sm-6">
                                <label for="series">Series</label><input value="{{$post->series}}" type="text" class="form-control form-control-user" id="series" name="series" placeholder="Series" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-2 mb-sm-0">
                                <label for="publisher">Publisher</label><input value="{{$post->publisher}}" type="text" class="form-control form-control-user" id="publisher" name="publisher"  placeholder="Publisher" >
                            </div>
                            <div class="col-sm-6">
                                <label for="year">Year Published</label><input value="{{$post->year}}" onkeypress="return onlyNumberKey(event)"   type="text" class="form-control form-control-user" id="year" minlength="4" maxlength="4" name="year"placeholder="Year Published" >
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="pdf">Attach PDF File</label><input value="{{$post->pdf}}" type="file" name="pdf" class="form-control-file" id="pdf" placeholder="Attach File" aria-describedby="">
                        </div>

                        <div class="form-group">
                            <label for="abstract">Abstract</label>
                            <textarea  name="abstract" id="body" class="form-control" cols="30" rows="10" required>{{$post->abstract}}</textarea>
{{--                            <input value="{{$post->abstract}}" id="abstract" type="hidden" name="abstract"  required>--}}
{{--                            <trix-editor input="abstract" ></trix-editor>--}}
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>

        </div>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
        <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js')}}"></script>
        <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

            $('tbody').on('click','.addRow',function (){

                var tr=
                    "<tr>"+
                    " <td class='col-sm-3'><input type='text' class='form-control' form-control-user id='lastname' name='lastname[]' placeholder='Last Name' required></td>"+
                    " <td class='col-sm-3'><input type='text' class='form-control' form-control-user id='firstname' name='firstname[]' placeholder='First Name' required></td>"+
                    " <td class='col-sm-2'><input type='text' class='form-control' form-control-user id='middle_initial' name='middle_initial[]' placeholder='Middle Initial' required></td>"+
                    " <td class='col-sm-1'><input type='text' class='form-control' form-control-user id='suffix' name='suffix[]' placeholder='Suffix' required></td>"+
                    " <td class='col-sm-3'><input type='text' class='form-control' form-control-user id='email' name='email[]' placeholder='Email' required></td>"+
                    "<td><a href='javascript:void(0)' class='btn btn-danger deleteRow'>-</a></td>"+
                    "</tr>"
                $('tbody').append(tr);

            });

            $('tbody').on('click','.deleteRow',function (){
                $(this).parent().parent().remove();
            });


        </script>
    @endsection
</x-admin-master>
