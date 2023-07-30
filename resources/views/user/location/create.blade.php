@extends('layouts.user.master')
@section('title','Location')
@section('content')
<div id="output"></div>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Location</h1>
        {{-- <a href="{{route('superadmin.domain.create')}}" class="btn btn-secondary"> </a> --}}
    </div>

    <div>
        <div class="w-75 mx-auto">
            <form method="post" action="{{route('user.location.store')}}" class="user">
                @csrf
                <div class="form-group row">

                    <div class="col-sm-6 col-5 mb-3 mb-sm-0">
                        <input readonly="readonly" id="name" name="address" type="text" class="form-control form-control-user " id="exampleFirstName"
                            placeholder="Address">
                        @error('name')
                        <span>{{$message}}</span>
                        @enderror
                        <input id="latlng" type="hidden" name="latlng" value="">
                    </div>



                </div>


                <button type="submit" class="btn btn-dark btn-user">
                    Submit
                </button>

            </form>
        </div>

        
    </div>


</div>
  
   <div class="mt-4 w-50 mx-auto" id="gmp-map"></div>




@endsection
