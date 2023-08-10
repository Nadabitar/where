@extends('Admin.index' , ['notifications' => $notifications])

@section('content')
        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">
                    <div class="row">
                        <!-- card1 start -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="icofont icofont-ui-user bg-c-blue card1-icon"></i>
                                    <span class="text-c-blue f-w-600">Registred Users</span>
                                    <h4>{{\App\Models\User::where('userType' , 'user')->count()}}</h4>
                                    <div>
                                        <span class="f-left m-t-10 text-muted">
                                            <i class="text-c-blue f-16 icofont icofont-warning m-r-10"></i>Get more space
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card1 end -->
                        <!-- card1 start -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="icofont  icofont-ui-home bg-c-pink card1-icon"></i>
                                    <span class="text-c-pink f-w-600">Registred Places</span>
                                    <h4>{{\App\Models\Places::where('isAccepted' , 1)->count()}}</h4>
                                    <div>
                                        <span class="f-left m-t-10 text-muted">
                                            <i class="text-c-pink f-16 icofont icofont-calendar m-r-10"></i>Last 24 hours
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card1 end -->
                        <!-- card1 start -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="icofont icofont-list bg-c-green card1-icon"></i>
                                    <span class="text-c-green f-w-600">Categories</span>
                                    <h4>{{\App\Models\categoris::where('status' , 1)->count()}}</h4>
                                    <div>
                                        <span class="f-left m-t-10 text-muted">
                                            <i class="text-c-green f-16 icofont icofont-tag m-r-10"></i>Tracked via microsoft
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card1 end -->
                        <!-- card1 start -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="icofont  icofont-location-pin bg-c-yellow card1-icon"></i>
                                    <span class="text-c-yellow f-w-600">Regions</span>
                                    <h4>{{\App\Models\Region::where('status' , 1)->count()}}</h4>
                                    <div>
                                        <span class="f-left m-t-10 text-muted">
                                            <i class="text-c-yellow f-16 icofont icofont-refresh m-r-10"></i>Just update
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card1 end -->
                        <!-- Statestics Start -->
                        <div class="col-md-12 col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Statestics</h5>
                                    <div class="card-header-left ">
                                    </div>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="icofont icofont-simple-left "></i></li>
                                            <li><i class="icofont icofont-maximize full-card"></i></li>
                                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                                            <li><i class="icofont icofont-error close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div id="statestics-chart" style="height:517px;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xl-4">
                                <div class="card fb-card">
                                    <div class="card-header">
                                        <i class="icofont icofont-location-pin"></i>
                                        <div class="d-inline-block">
                                            <h5>Registred Places</h5>
                                            <span>now you have</span>
                                        </div>
                                    </div>
                                    <div class="card-block text-center">
                                        <div class="row">
                                            <div class="col-6 b-r-default">
                                                <h2>{{\App\Models\Places::where('isAccepted' , 1)->count()}}</h2>
                                                <p class="text-muted">Active</p>
                                            </div>
                                            <div class="col-6">
                                                <h2>{{\App\Models\Places::where('isAccepted' , 0)->count()}}</h2>
                                                <p class="text-muted">un Accepted yet</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card dribble-card">
                                    <div class="card-header">
                                        <i class="icofont icofont-ui-user"></i>
                                        <div class="d-inline-block">
                                            <h5>Registred users</h5>
                                            <span>now you have</span>
                                        </div>
                                    </div>
                                    <div class="card-block text-center">
                                        <div class="row">
                                            <div class="col-6 b-r-default">
                                                <h2>{{\App\Models\User::where('userType' , 'user')->where('gender' , 'famle')->count()}}</h2>
                                                <p class="text-muted">Famle</p>
                                            </div>
                                            <div class="col-6">
                                                <h2>{{\App\Models\User::where('userType' , 'user')->where('gender' , 'male')->count()}}</h2>
                                                <p class="text-muted">Male</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card twitter-card">
                                    <div class="card-header">
                                        <i class="icofont icofont-certificate-alt-1"></i>
                                        <div class="d-inline-block">
                                            <h5>Categories && Regions</h5>
                                            <span>now you have</span>
                                        </div>
                                    </div>
                                    <div class="card-block text-center">
                                        <div class="row">
                                            <div class="col-6 b-r-default">
                                                <h2>{{\App\Models\categoris::where('status' , 1)->count()}}+</h2>
                                                <p class="text-muted">Categoies</p>
                                            </div>
                                            <div class="col-6">
                                                <h2>{{\App\Models\Region::where('status' , 1)->count()}}</h2>
                                                <p class="text-muted">Regions</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                        <!-- Email Sent End -->
                        <!-- Data widget start -->
                        <div class="col-md-12 col-xl-6">
                            <div class="card project-task">
                                <div class="card-header">
                                    <div class="card-header-left ">
                                        <h5>Most Popular Category </h5>
                                    </div>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="icofont icofont-simple-left "></i></li>
                                            <li><i class="icofont icofont-maximize full-card"></i></li>
                                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                                            <li><i class="icofont icofont-error close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block p-b-10">
                                    @php
                                        $total = \App\Models\Categoris::where('status' , 1)->count();
                                    @endphp
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Category Name</th>
                                                    <th>How time Used</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="task-contain">
                                                            <h6 class="bg-c-blue d-inline-block text-center">{{$popularCat[0]->name[0]}}</h6>
                                                            <p class="d-inline-block m-l-20">{{$popularCat[0]->name}}</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="d-inline-block m-r-20"> {{$popularCat[0]->count}} : {{$total}}</p>
                                                        <div class="progress d-inline-block">
                                                            <div class="progress-bar bg-c-blue" role="progressbar" aria-valuemin="0" aria-valuemax="100"  style="width:{{($popularCat[0]->count / $total) * 100}}%">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="task-contain">
                                                            <h6 class="bg-c-pink d-inline-block text-center">{{$popularCat[1]->name[0]}}</h6>
                                                            <p class="d-inline-block m-l-20">{{$popularCat[1]->name}}</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="d-inline-block m-r-20">{{$popularCat[1]->count}}:  {{$total}}</p>
                                                        <div class="progress d-inline-block">
                                                            <div class="progress-bar bg-c-pink" role="progressbar" aria-valuemin="0" aria-valuemax="100"  style="width:{{($popularCat[1]->count / $total) * 100}}%">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="task-contain">
                                                            <h6 class="bg-c-yellow d-inline-block text-center">{{$popularCat[2]->name[0]}}</h6>
                                                            <p class="d-inline-block m-l-20">{{$popularCat[2]->name}}</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="d-inline-block m-r-20">{{$popularCat[2]->count}} :  {{$total}}</p>
                                                        <div class="progress d-inline-block">
                                                            <div class="progress-bar bg-c-yellow" role="progressbar" aria-valuemin="0" aria-valuemax="100"  style="width:{{($popularCat[2]->count / $total) * 100}}%">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="task-contain">
                                                            <h6 class="bg-c-green d-inline-block text-center">{{$popularCat[3]->name[0]}}</h6>
                                                            <p class="d-inline-block m-l-20">{{$popularCat[3]->name}}</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="d-inline-block m-r-20">{{$popularCat[3]->count}} : {{$total}}</p>
                                                        <div class="progress d-inline-block">
                                                            <div class="progress-bar bg-c-green" role="progressbar" aria-valuemin="0" aria-valuemax="100"  style="width:{{($popularCat[3]->count / $total) * 100}}%">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="task-contain">
                                                            <h6 class="bg-c-blue d-inline-block text-center">{{$popularCat[4]->name[0]}}</h6>
                                                            <p class="d-inline-block m-l-20">{{$popularCat[4]->name}}</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="d-inline-block m-r-20">{{$popularCat[4]->count}}: {{$total}}</p>
                                                        <div class="progress d-inline-block">
                                                            <div class="progress-bar bg-c-blue" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:{{($popularCat[4]->count / $total) * 100}}%">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Donut chart start -->
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Donut chart</h5>
                                    <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                                    <div class="card-header-right">                                                             <i class="icofont icofont-spinner-alt-5"></i>                                                         </div>
                                </div>
                                <div class="card-block">
                                    <div id="donut"  data-info="{{json_encode($popularCat)}}"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Donut chart Ends -->
                    </div>
                </div>

                <div id="styleSelector">

                </div>
            </div>
        </div>
@endsection


@section('script')
    <!-- Todo js -->
<script src="{{asset("backend/assets/js/raphael/raphael.min.js")}}"></script>
<script src="{{asset("backend/assets/js/morris.js/morris.js")}}"></script>
<!-- Custom js -->
<script>
    $(document).ready(function() {
    donutChart();
        function donutChart(){
            let canvas = document.getElementById('donut');
            let info = JSON.parse(canvas.dataset.info);
            data = [];
            for (let i = 0; i < info.length; i++) {
                data[i] = {
                label : info[i].name,
                value : info[i].count,
            }
                
            }
            console.log('info',info);
            window.areaChart = Morris.Donut({
                element: 'donut',
                redraw: true,
                data: data,
                colors: ['#00b98e', '#ff6922', '#0e2e50' , '#FC6180' , '#93BE52' , '#4680ff' , '#ab7967' , '#f9ff00']
            });
        }
});
        
</script>
@endsection