@extends('welcome')
@section('title', 'Class')

{{-- Content --}}
@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Class List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{route('create')}}"> Create New Class</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered dataTable" id="classesTable" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>College</th>
            <th>Class</th>
            <th>Levels</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($class as $c)
        <tr>
            <td>{{ $c->college_name }}</td>
            <td>{{ $c->title }}</td>
            <td>@if(count($c->levels) > 0)
                @php $count = 0; @endphp
                @foreach($c->levels as $level)
                    @php $count++; @endphp
                    {{$level->level}} @if($count < count($c->levels)) , @endif
                @endforeach
                @endif</td>
            <td> 
                <form action="{{ route('destroy',$c->id) }}" method="POST">
                <a class="btn btn-success" href="{{route('download',$c->id)}}"><i class="fa fa-download"></i></a>    
                <a class="btn btn-primary" href="{{route('create',$c->id)}}"><i class="fa fa-edit"></i></a>
                @csrf
                    @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
<script type="text/javascript">
    $(document).ready(function(){
    var theTable = $('#classesTable').DataTable({
        "pageLength": 5
    });
  });
</script>  
    
@endsection
