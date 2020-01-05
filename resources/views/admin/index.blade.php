@extends('admin.app')
@section('title', trans('admin.statistics'))
@section('content')
	<div class="row">
		<div class="col-lg-3 col-md-6">
			<div class="card-box">
				<h4 class="header-title m-t-0 m-b-30">Users</h4>
				<div class="widget-chart-1">
					<div class="widget-chart-box-1">
						<input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050 "
						       data-bgColor="#F9B9B9" value="{{ \App\Helpers\Helper::percent($users, $verified) }}"
						       data-skin="tron" data-angleOffset="180" data-readOnly=true
						       data-thickness=".15"/>
					</div>

					<div class="widget-detail-1" dir="auto">
						<h2 class="p-t-10 m-b-0">
							<span class="text-success">({{ $verified }})</span>
						</h2>
					</div>
				</div>
			</div>
		</div><!-- end col -->

		<div class="col-lg-3 col-md-6">
			<div class="card-box">
				<h4 class="header-title m-t-0 m-b-30">Profiles</h4>

				<div class="widget-chart-1">
					<div class="widget-detail-1">
						<h2 class="p-t-10 m-b-0">{{ $profiles }}</h2>
					</div>
				</div>
			</div>
		</div><!-- end col -->

		<div class="col-lg-3 col-md-6">
			<div class="card-box">
				<h4 class="header-title m-t-0 m-b-30">Profiles Views</h4>

				<div class="widget-chart-1">
					<div class="widget-detail-1">
						<h2 class="p-t-10 m-b-0">{{ $views }}</h2>
					</div>
				</div>
			</div>
		</div><!-- end col -->

		<div class="clearfix"></div>

		<div class="col-lg-6">
			<div class="card-box">
				<h4 class="header-title m-t-0 m-b-30">Last 30 Days Profiles</h4>

				<canvas id="lineChart" height="160"></canvas>
			</div>
		</div><!-- end col-->

		<div class="col-lg-6">
			<div class="card-box">
				<h4 class="header-title m-t-0 m-b-30">Last 30 Days Users</h4>

				<canvas id="UsersChart" height="160"></canvas>
			</div>
		</div><!-- end col-->

	</div>
	<!-- end row -->
@stop

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
	<script>
        var lineChart = {
            type: 'line',
            data: {
                labels: {!! $analytics['profiles']->keys() !!},
                datasets: [
                    {
                        label: "Profiles",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "#10c469",
                        borderColor: "#10c469",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "red",
                        pointBackgroundColor: "#fff",
                        pointBorderWidth: 4,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "#10c469",
                        pointHoverBorderColor: "#eef0f2",
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        data: {!! $analytics['profiles']->values() !!}
                    }
                ]
            }
        };

        new Chart(
            document.getElementById("lineChart").getContext('2d'),
            lineChart
        );

        var lineChart = {
            type: 'line',
            data: {
                labels: {!! $analytics['users']->keys() !!},
                datasets: [
                    {
                        label: "Users",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "#10c469",
                        borderColor: "#10c469",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "red",
                        pointBackgroundColor: "#fff",
                        pointBorderWidth: 4,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "#10c469",
                        pointHoverBorderColor: "#eef0f2",
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        data: {!! $analytics['users']->values() !!}
                    }
                ]
            }
        };

        new Chart(
            document.getElementById("UsersChart").getContext('2d'),
            lineChart
        );

	</script>
@stop
