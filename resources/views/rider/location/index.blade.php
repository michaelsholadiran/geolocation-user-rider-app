@extends('layouts.rider.master')
@section('title','Location')
@section('content')
  <div class="container-fluid">


  <div>
    <table class="table table-striped">
      <thead>
        <tr>

          <th scope="col">User</th>
          <th scope="col">Address</th>
         
        </tr>
      </thead>
      <tbody>

        @foreach ($list as $l)
        <tr>
          <th scope="row">{{$l[1]}}</th>
          <th scope="row">{{$l[2]}}</th>
         

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</div>
@endsection