@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">City List</div>
                    @if(session('success'))
                  <div class="callout alert alert-success alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                     <span style="color: white;">{{session('success')}}</span>
                   </div>
                     @endif
                      @if(session('danger'))
                          <div class="callout alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <span style="color: white;">{{session('danger')}}</span>
                           </div>
                        @endif

                <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">City</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(!empty($list))
                        @foreach($list as $key => $value)
                        
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $value->city_name }}</td>
                            <td><a href="{{ route('city-edit', $value->id) }}">Edit</a> | <a href="{{ route('city-delete',$value->id) }}">Delete</a></td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
