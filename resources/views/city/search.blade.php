@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           
            <div class="card">

                <div class="card-header">Search City</div>

                <div class="card-body">
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
                
                    <form method="POST" id="formData" action="{{ route('city-search-manage') }}">
                        @csrf
			              @if (count($errors) > 0)
                          <div class="alert alert-danger">
                          <ul>
                          @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                          @endforeach
                            </ul>
                           </div>
                           @endif
                        <input type="hidden"  id="latitude" name="latitude"/>   
                        <input type="hidden"  id="longitude" name="longitude"/>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">City</label>

                            <div class="col-md-6">
                                <input id="city_name" type="text" class="form-control" value="{{old('city_name')}}" name="city_name" required >
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
      <script src="https://maps.googleapis.com/maps/api/js?key='AIzaSyAjlfDOtpukvc2j-YSJxXpTYOkNKTwBaB8'&libraries=places"></script>
      <script type="text/javascript">
         google.maps.event.addDomListener(window, 'load', function () {
             var places = new google.maps.places.Autocomplete(document.getElementById('city_name'));
             google.maps.event.addListener(places, 'place_changed', function () {
               var place = places.getPlace();
                    $('#latitude').val(place.geometry['location'].lat());
                    $('#longitude').val(place.geometry['location'].lng());
         
             });
         });
      </script>



