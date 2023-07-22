@extends('layouts.master')
@section('content')
<div class="container" style="diplay:inline;">
<div class="row">

@foreach ( $uploads as $upload)
<div class="col-md-4">

<div class="card" >
        @php
            $fileExtension = pathinfo($upload->path, PATHINFO_EXTENSION);
        @endphp
        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
            <img class="card-img-top" style="width: 415px; height: 213px" src="{{ asset("storage/$upload->path") }}" alt="Image">
        @elseif (in_array($fileExtension, ['pdf']))
            <embed src="{{ asset("storage/$upload->path") }}" width="415" height="213" type="application/pdf">
        @elseif (in_array($fileExtension, ['doc', 'docx']))
            <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset("storage/$upload->path")) }}" width="415" height="213"></iframe>
        @else
            <p>Unsupported file type: {{ $fileExtension }}</p>
        @endif  <div class="card-body">
    <h5 class="card-title">{{$upload->name}}</h5>
   
  </div>

   <form action="{{route('download.file',$upload->id)}}" >
    <button type="submit" class="btn btn-primary">Download</button>
            

    </form>

</div>
</div>
@endforeach
</div>
</div>

@endsection