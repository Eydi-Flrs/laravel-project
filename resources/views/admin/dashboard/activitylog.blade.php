<x-admin-master>
    @section('content')
        <h1>Activity Log</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Activity Log</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>User_id</th>
                                <th>User_name</th>
                                <th>Stat</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($activityLogs as $activityLog)
                                <tr>
                                    <td>{{$activityLog->user_id}}</td>
                                    <td>{{$activityLog->user_name}}</td>
                                    <td>{{$activityLog->stat}}</td>
                                    <td>{{$activityLog->activity_description}}</td>
                                    <td>{{$activityLog->date}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
        {{--        <div class="d-flex">--}}
        {{--            <div class="mx-auto">--}}
        {{--                {{$activityLogs->links()}}--}}
        {{--            </div>--}}
        {{--        </div>--}}

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
