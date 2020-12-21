@extends('welcome')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Class</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('home') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="@if(isset($class)){{route('update',$class->id)}} @else {{ route('store') }}@endif" method="POST" enctype="multipart/form-data">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <label><strong>College</strong></label>
                <select name="college_id"  id="college_id" class="form-control">
                	<option value="">--select college--</option>
                	@if(!empty($colleges))
                	@foreach($colleges as $college)
                	<option value="{{$college->id}}" @if(isset($class) && $college->id == $class->college_id)) selected @endif>{{$college->college_name}}</option>
                	@endforeach
                	@endif
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <label><strong>Title</strong></label>
                <input name="title"  id="title" class="form-control" value="@if(isset($class)){{$class->title}}@endif"/>
           
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <label><strong>Contact No</strong></label>
                <input name="contact_no"  id="contact_no" class="form-control" pattern="\d{0,10}"  maxlength="10" value="@if(isset($class)){{$class->contact_no}}@endif"/>
           
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <label><strong>Email</strong></label>
                <input name="email"  id="email" class="form-control" value="@if(isset($class)){{$class->email}}@endif"/>
           
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <label><strong>Price</strong></label>
                <input name="price"  id="price" class="form-control" value="@if(isset($class)){{$class->price}}@endif"/>
           
            </div>
        </div>

    	@if(isset($class) && count($class->levels) > 0 )
    		<div class="levels">

    		@foreach($class->levels as $levels)
	        <div class="col-xs-12 col-sm-12 col-md-8">
	            <div class="form-group">
	                <label><strong>Levels</strong></label>
	                <input type="text" name="levels[]"  id="level" class="form-control" value="{{$levels->level}}"/>
	            </div>
	        </div>
	        @endforeach
	        <div class="col-xs-12 col-sm-12 col-md-4">
	            <div class="form-group">
	            	<br>
	                <a href="#" class="btn btn-primary add_new" id="add_new"><i class="fa fa-plus"></i></a>
	            </div>
	        </div>
    	</div>
    	@else
    	<div class="levels">
	        <div class="col-xs-12 col-sm-12 col-md-8">
	            <div class="form-group">
	                <label><strong>Levels</strong></label>
	                <input type="text" name="levels[]"  id="level" class="form-control" value="@if(isset($class)){{$class->level}}@endif"/>
	            </div>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-4">
	            <div class="form-group">
	            	<br>
	                <a href="#" class="btn btn-primary add_new" id="add_new"><i class="fa fa-plus"></i></a>
	            </div>
	        </div>
    	</div>
    	@endif
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <label><strong>description</strong></label>
                <textarea class="form-control" style="height:150px" name="description">@if(isset($class)){{$class->description}}@endif</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <label><strong>syllabus</strong></label>
                <input type="file" class="form-control" name="syllabus">
                @if(isset($class))
                <a href="{{asset('img/class/')}}/@if(isset($class)){{$class->syllabus}}@endif" target="_blank">view</a> 
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('home')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
   
</form>
<script type="text/javascript">
	var wrapper = $('.levels');
        var latest_id = "{{$latest_id}}";

        var count = parseInt(latest_id);
        $(wrapper).on('click', '#add_new', function(e){
        	count++;

        	var fieldHTML = '<div class="col-xs-12 col-sm-12 col-md-8" id="'+count+'"><div class="form-group"><label><strong>Levels</strong></label><input type="text" id="level_'+count+'" name="levels[]" class="form-control form-control"/></div></div>';

        	$(wrapper).append(fieldHTML);
        	return false;

        });
</script>
@endsection