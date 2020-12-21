<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	</head>
	<body>
		<div class="card-header">
			<h3 class="card-title">Class Information:</h3>
		</div>
		<!--begin::Form-->
		<div class="card-body">

		    <table class="table table-striped" >
		        <tbody>
		        	
		            <tr>
		                <th scope="col">College Name</th>
		                <td>@if(isset($data)){{$data[0]->college_name}}@endif</td>
		            </tr>
		            <tr>
		                <th scope="col">Title</th>
		                <td>@if(isset($data)){{$data[0]->title}}@endif</td>
		            </tr>
		            <tr>
		                <th scope="row">Contact No</th>
		                <td>@if(isset($data[0]->contact_no)){{$data[0]->contact_no}}@endif</td>
		            </tr>
		            <tr>
		                <th scope="row">Email</th>
		                <td>@if(isset($data)){{$data[0]->email}}@endif</td>
		            </tr>
		            <tr>
		                <th scope="row">Price</th>
		                <td>@if(isset($data)){{$data[0]->price}}@endif</td>
		            </tr>
		            <tr>
		                <th scope="row">Description</th>
		                <td>@if(isset($data)){{$data[0]->description}}@endif</td>
		            </tr>
		            <tr>
		                <th scope="row">Levels</th>
		                <td>@if(count($data[0]->levels) > 0)
			                @php $count = 0; @endphp
			                @foreach($data[0]->levels as $level)
			                    @php $count++; @endphp
			                    {{$level->level}} @if($count < count($data[0]->levels)) , @endif
			                @endforeach
			                @endif
			            </td>
		            </tr>
		   
		        </tbody>
		    </table>
		</div>
		
	</body>
</html>