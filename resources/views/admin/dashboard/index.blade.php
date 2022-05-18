<x-admin-master>
    @section('content')
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <button onclick="window.print()">print analytics</button>
                <!-- Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Number of Users:</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$users->count()}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Academic Resources</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$posts->count()}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Categories</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$categories->count()}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Active Users:</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{$activeUser}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

            <div class="row">
                <!-- Pie Chart -->
                <div class="col-lg-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Books Per Category</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                @foreach($categories as $category)
                                        <span class="mr-2">
                                          <i class="fas fa-circle" id="{{$category->name}}" ></i> {{$category->name}}
                                        </span>
                                 @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Bar Chart -->
                <div class="col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Academic Resources Per Year ( {{$carbon->year}}-{{$carbon->year-6}} )</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-bar">
                                <canvas id="myBarChart"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- TOP Views-->
                <div class="col-lg-6">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Top Views</h6>
                        </div>
                        <div class="card-body">
                            <h3 class="font-weight-bold">Title<span class="float-right">Views:</span></h3>
                            @foreach($posts->sortByDesc('views')->take(10) as $post)
                                <h5>{{$post->title}}<span class="float-right">{{$post->views}}</span></h5>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- TOP Views-->
                <div class="col-lg-6">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Academic Resource Per Course</h6>
                        </div>
                        <div class="card-body">
                            <h3 class="font-weight-bold">Courses<span class="float-right">Count:</span></h3>

                                <h5>Bachelor of Science in Information Technology<span class="float-right">{{$posts->where('course','Bachelor of Science in Information Technology')->count()}}</span></h5>
                                <h5>Bachelor of Science in Computer Science<span class="float-right">{{$posts->where('course','Bachelor of Science in Computer Science')->count()}}</span></h5>
                                <h5>Bachelor of Science in Information System<span class="float-right">{{$posts->where('course','Bachelor of Science in Information System')->count()}}</span></h5>
                        </div>
                    </div>
                </div>
            </div>






                <!-- Bootstrap core JavaScript-->
                <script src="vendor/jquery/jquery.min.js"></script>
{{--                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>--}}

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="vendor/chart.js/Chart.min.js"></script>


                <script>
                    // Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#858796';

                    // Pie Chart Example
                    var ctx = document.getElementById("myPieChart");


                    const backgroundColor=[];
                    const borderColor=[];
                    for (i=0;i<{{$categories->count()}}; i++){
                        const r=Math.floor(Math.random()*255);
                        const g=Math.floor(Math.random()*255);
                        const b=Math.floor(Math.random()*255);
                        backgroundColor.push('rgba('+r+','+g+','+b+', 0.2)');
                        borderColor.push('rgba('+r+','+g+','+b+', 1)')
                    }

                    let x=0;
                     @foreach($categories as $category)
                        document.getElementById("{{$category->name}}").style.color = borderColor[x];
                        x++;
                     @endforeach


                    var myPieChart = new Chart(ctx, {

                        type: 'doughnut',
                        data: {
                            labels: [@foreach($categories as $category) "{{$category->name}}", @endforeach],
                            datasets: [{
                                data: [@foreach($categories as $category) "{{$category->posts->count()}}", @endforeach],
                                backgroundColor: borderColor,
                                hoverBackgroundColor: backgroundColor,
                                hoverBorderColor: "rgba(234, 236, 244, 1)",
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                caretPadding: 10,
                            },
                            legend: {
                                display: false
                            },
                            cutoutPercentage: 80,
                        },
                    });

                </script>

                <script>
                    // Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#858796';

                    function number_format(number, decimals, dec_point, thousands_sep) {
                        // *     example: number_format(1234.56, 2, ',', ' ');
                        // *     return: '1 234,56'
                        number = (number + '').replace(',', '').replace(' ', '');
                        var n = !isFinite(+number) ? 0 : +number,
                            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                            s = '',
                            toFixedFix = function(n, prec) {
                                var k = Math.pow(10, prec);
                                return '' + Math.round(n * k) / k;
                            };
                        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                        if (s[0].length > 3) {
                            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                        }
                        if ((s[1] || '').length < prec) {
                            s[1] = s[1] || '';
                            s[1] += new Array(prec - s[1].length + 1).join('0');
                        }
                        return s.join(dec);
                    }

                    // Bar Chart Example
                    var ctx = document.getElementById("myBarChart");
                    var myBarChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [ @for($i=0;$i<7;$i++) "{{$carbon->year-$i}}", @endfor],
                            datasets: [{
                                label: "Revenue",
                                backgroundColor: "#4e73df",
                                hoverBackgroundColor: "#2e59d9",
                                borderColor: "#4e73df",
                                data: [@for($i=0;$i<7;$i++) "{{$posts->where('year',$carbon->year-$i)->count()}}", @endfor],
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 25,
                                    top: 25,
                                    bottom: 0
                                }
                            },
                            scales: {


                                yAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: {{$posts->count()}},
                                        maxTicksLimit: 5,
                                        padding: 10,
                                        // Include a dollar sign in the ticks
                                        callback: function(value, index, values) {
                                            return number_format(value);
                                        }
                                    },
                                    gridLines: {
                                        color: "rgb(234, 236, 244)",
                                        zeroLineColor: "rgb(234, 236, 244)",
                                        drawBorder: false,
                                        borderDash: [2],
                                        zeroLineBorderDash: [2]
                                    }
                                }],
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                titleMarginBottom: 10,
                                titleFontColor: '#6e707e',
                                titleFontSize: 14,
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                caretPadding: 10,
                                callbacks: {
                                    label: function(tooltipItem, chart) {
                                        var datasetLabel = 'academic resource count';
                                        return datasetLabel + ':'+ number_format(tooltipItem.yLabel);
                                    }
                                }
                            },
                        }
                    });

                </script>

    @endsection





</x-admin-master>
