<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		/*@page { margin-top: 130px; }*/

		html, body{
			font-family: "Calibri", sans-serif;
			font-size: 10pt;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}
		table thead {
			text-align: center;
			text-transform: uppercase;
		}
		td, th {
			border: 1px solid #000;
			padding: 0.30em;
		}
		tr{
			page-break-before: auto;
		}
		.project_cost {
			text-align: right;
		}
		.field_month, .field_year, .monitored_by {
			text-align: center;
		}
		/*#header{
			position: fixed;
			top: -65px;
		}*/
		h1, h2, h3, h4,h5{
			padding: 0px;
			margin: 0px;
		}
		.center{
			text-align: center;
		}
		.right{
			text-align: right;
		}
	</style>
</head>
<body>
	<div id="header">
	 	<h4  class="center" style="text-transform: uppercase;">Provincial Planning and Development Office</h4>
	 	<h4  class="center" style="text-transform: uppercase;">Monitoring and Evaluation Division</h4>
	 	<h4 class="center" >List of Project Monitored
				@if($type == 1)
				{{date('F Y', strtotime($month_selected))}}
				@elseif($type == 2)
					for the year of ({{$year}})
				@elseif($type == 3)
						@if($quarter_number == 0)
							<span>All</span>
						@elseif($quarter_number == 1)
							<span>1st</span>
						@elseif($quarter_number == 2)
							<span>2nd</span>
						@elseif($quarter_number == 3)
							<span>3rd</span>
						@elseif($quarter_number == 4)
							<span>4th</span>
						@endif
						Quarter ({{$year}}) Report 
				@endif
	 	</h4>

	 
	</div>
	
	<h4></h4>
	<table>
		<thead>
			<tr>
				<th>#</th>
				@foreach($report_fields as $header)
					
					@if($header == "control_number")
						<th >Control Number</th>
					@endif
					@if($header == "title")
						<th >Title</th>
					@endif
					@if($header == "location")
						<th >Location</th>
					@endif
					@if($header == "project_cost")
						<th >Project <br>Cost</th>
					@endif
					@if($header == "fund_source")
						<th >Fund <br>Source</th>
					@endif
					@if($header == "mode_of_implementation")
						<th >Implementation <br>Procedure</th>
					@endif

					@if($header == "contractor")
						<th >Contractor</th>
					@endif
					@if($header == "field_month")
						<th >Month</th>
					@endif
					@if($header == "field_year")
						<th >Year</th>
					@endif
					@if($header == "monitored_by")
						<th >Monitor</th>
					@endif
				@endforeach
			</tr>
		</thead>
			<?php foreach ($project as $key => $value): ?>
				<tr>
					<?php 
					    $mode_of_implementation = "";
			            if($value->mode_of_implementation == 0)
			            {
			                $mode_of_implementation = "By Contract";
			            }else{
			                $mode_of_implementation = "By Administration";
			            }
			            $location = "";
			            if(!!$value->location_barangay)
			            {
			                $location .= $value->location_barangay->barangay . ", ";
			            }
					?>
					
					<td>
						{{$key + 1}}
					</td>

					<?php foreach ($report_fields as $index => $fields): ?>
						@if($fields == "control_number")
							<td>{{$value->control_number}}</td>
						@endif
						@if($fields == "title")
							<td>{{$value->title}}</td>
						@endif
						@if($fields == "location")
							<td >{{$location . $value->location_municipality->municipality ?? ""}}</td>
						@endif
						@if($fields == "project_cost")
							<td class="right" width="auto">{{'PHP ' . $value->project_cost}}</td>
						@endif
						@if($fields == "fund_source")
							<td >{{App\Http\Controllers\ProjectManagementController::fund_source($value->fund_source, $value->specific_fund_source) . ' (' . $value->fund_source_year . ')'}}</td>
						@endif
						@if($fields == "mode_of_implementation")
							<td>{{$mode_of_implementation}}</td>
						@endif

						@if($fields == "contractor")
							<td >{{$value->contractor ?? "-"}}</td>
						@endif
						@if($fields == "field_month")
							<td >{{date('F', strtotime($value->date_monitored))}}</td>
						@endif
						@if($fields == "field_year")
							<td >{{date('Y', strtotime($value->date_monitored))}}</td>
						@endif
						@if($fields == "monitored_by")
							<td >{{$value->rel_monitor_by->monitor ?? "Not set"}}</td>
						@endif
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
		@if(count($project) <= 0)
		<tbody>
			<tr>
				<td colspan="{{count($report_fields)}}" style="text-align: center;">No item found!</td>
			</tr>
		</tbody>
		@endif
	</table>

	<p><b>Total number of projects monitored: {{count($project)}}</b></p>
</body>
</html>