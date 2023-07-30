@extends('layouts.rider.master')
@section('title','Location')
@section('content')
  <div class="container-fluid">


  <div>
    <table class="table table-striped">
      <thead>
        <tr>

          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Action</th>

        </tr>
      </thead>
      <tbody>

        @foreach ($list as $l)
        <tr>
          <th scope="row">{{$l->name}}</th>
          <th scope="row">{{$l->email}}</th>
          <th scope="row">
            <a href="" class="btn btn-outline-secondary ">Edit</a>

            <a class="btn btn-outline-danger " wire:click="$emit('destroy',{{$l->id}})">Delete</a>
          </th>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</div>
@endsection