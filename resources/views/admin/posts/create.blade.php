<x-admin-master>
    @section('content')
        <h1>Create Post</h1>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></div>

        @endif
        <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data" autocomplete="off">
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
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="col-sm-3"><input type="text" class="form-control form-control-user @error('lastname') is-invalid @enderror" id="lastname" name="lastname[]" placeholder="Last Name" required></td>
                                                    <td class="col-sm-3"><input type="text" class="form-control form-control-user @error('firstname') is-invalid @enderror" id="firstname" name="firstname[]" placeholder="First Name" required></td>
                                                    <td class="col-sm-2"><input type="text" class="form-control form-control-user" id="middle_initial" name="middle_initial[]" placeholder="Middle Initial"></td>
                                                    <td class="col-sm-1"><input type="text" class="form-control form-control-user" id="suffix"  name="suffix[]" placeholder="Suffix"></td>
                                                    <td class="col-sm-3"><input type="email" class="form-control form-control-user" id="email" name="email[]" placeholder="Email"></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-primary addRow">+</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>


                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                        <label for="course">Course</label>
                                        <select class="form-select" aria-label="Default select example" id="course" name="course" required>
                                            <option value="none">none</option>
                                            <option value="Bachelor of Science in Information System">Bachelor of Science in Information System</option>
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
                                    <br>
                                    <h3>Publication Info</h3>
                                    <div class="form-group ">
                                        <label for="title">Title</label><input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter Title" required>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <label for="category_id">Categories</label>
                                            <select class="form-select" aria-label="Default select example" id="category_id" name="category_id" required>
                                                @foreach($categories as $category)
                                                    <option selected value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($tags->count()>0)
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <label for="tag_id">Tags</label>
                                            <select class="form-control select2" aria-label="Default select example" id="tag_id" name="tag_id[]" multiple="multiple"  multiple="multiple" required>
                                                @foreach($tags as $tag)
                                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif

                                        <div class="col-sm-4">
                                            <label for="pages">Pages</label><input type="number" class="form-control form-control-user" id="pages" name="pages" placeholder="Pages">
                                        </div>
                                    </div>

                                    <h3>Date</h3>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="month">Month:</label>
                                            <select class="form-select" name="month" id="month">
                                                <option value="none">None</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="day">Day:</label>
                                            <select class="form-select" name="day" id="day" >
                                                 <option value="none">None</option>
                                                @for($i=1;$i<=31;$i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="year">Year Published</label><input onkeypress="return onlyNumberKey(event)"   type="text" class="form-control form-control-user" id="year" minlength="4" maxlength="4" name="year" placeholder="Year Published" required>
                                        </div>
                                    </div>

                                    <h3>Additional Info (applicable for books only)</h3>

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
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <label for="isbn">ISBN</label><input type="text" class="form-control form-control-user" id="isbn" name="isbn"  placeholder="ISBN" >
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <label for="dcc">DCC</label><input type="text" class="form-control form-control-user" id="dcc" name="dcc"  placeholder="DCC" >
                                        </div>
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <label for="authornumber">Author number</label><input type="text" class="form-control form-control-user" id="authornumber" name="authornumber"  placeholder="Author no." >
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label for="pdf">Attach PDF File</label><input type="file" name="pdf" class="form-control-file" id="pdf" placeholder="Attach File" aria-describedby="" required accept="application/pdf">
                                    </div>

                                    <div class="form-group">
                                        <label for="files">Upload images</label>
                                        <input type="file" name="images[]" id="" class="form-control" multiple accept="image/*" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="abstract">Abstract/Summary/Description</label>
                                        <textarea name="abstract" id="body" class="form-control" cols="30" rows="10" required></textarea>
{{--                                        <input id="abstract" type="hidden" name="abstract" required>--}}
{{--                                        <trix-editor input="abstract"></trix-editor>--}}
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                            </div>
                        </div>

        </div>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
        <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js')}}"></script>
        <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{--        <script src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
{{--                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
{{--                crossorigin="anonymous"></script>--}}

{{--        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"--}}
{{--                integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="--}}
{{--                crossorigin="anonymous"></script>--}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

        <script>
            $('.select2').select2({
                tokenSeparators: [',', ' '],
                placeholder: "Select or type keywords"
            });
        </script>
        {{--   end-tag selector--}}


        <script>
            const monthSelect = document.getElementById("month");
            const daySelect = document.getElementById("day");
            const yearSelect = document.getElementById("year");

            const months = ['January', 'February', 'March', 'April',
                'May', 'June', 'July', 'August', 'September', 'October',
                'November', 'December'];
            (function populateMonths(){
                for(let i = 0; i < months.length; i++){
                    const option = document.createElement('option');
                    option.textContent = months[i];
                    option.name='month';
                    monthSelect.appendChild(option);
                }
                monthSelect.value = "none";
            })();

            // let previousDay;
            // function populateDays(month){
            //     //Delete all of the children of the day dropdown
            //     //if they do exist
            //     while(daySelect.firstChild){
            //         daySelect.removeChild(daySelect.firstChild);
            //     }
            //     //Holds the number of days in the month
            //     let dayNum;
            //     //Get the current year
            //     let year = yearSelect.value;
            //
            //     if(month === 'January' || month === 'March' ||
            //         month === 'May' || month === 'July' || month === 'August'
            //         || month === 'October' || month === 'December') {
            //         dayNum = 31;
            //     } else if(month === 'April' || month === 'June'
            //         || month === 'September' || month === 'November') {
            //         dayNum = 30;
            //     }else{
            //         //Check for a leap year
            //         if(new Date(year, 1, 29).getMonth() === 1){
            //             dayNum = 29;
            //         }else{
            //             dayNum = 28;
            //         }
            //     }
            //     //Insert the correct days into the day <select>
            //     for(let i = 1; i <= dayNum; i++){
            //         const option = document.createElement("option");
            //         option.textContent = i;
            //         daySelect.appendChild(option);
            //     }
            //     if(previousDay){
            //         daySelect.value = previousDay;
            //         if(daySelect.value === ""){
            //             daySelect.value = previousDay - 1;
            //         }
            //         if(daySelect.value === ""){
            //             daySelect.value = previousDay - 2;
            //         }
            //         if(daySelect.value === ""){
            //             daySelect.value = previousDay - 3;
            //         }
            //     }
            // }

            // populateDays(monthSelect.value);
            // populateYears();
            //
            // yearSelect.onchange = function() {
            //     populateDays(monthSelect.value);
            // }
            // monthSelect.onchange = function() {
            //     populateDays(monthSelect.value);
            // }
            // daySelect.onchange = function() {
            //     previousDay = daySelect.value;
            // }

        </script>
        <script>
{{--        $("#year").datepicker({--}}
{{--                format: "yyyy",--}}
{{--                viewMode: "years",--}}
{{--                minViewMode: "years"--}}
{{--            });--}}

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
                    " <td class='col-sm-1'><input type='text' class='form-control' form-control-user id='suffix' name='suffix[]' placeholder='Suffix'></td>"+
                    " <td class='col-sm-3'><input type='text' class='form-control' form-control-user id='email' name='email[]' placeholder='Email'></td>"+
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
