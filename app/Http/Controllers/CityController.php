<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use Validator;
use DB;

class CityController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }
    //Default city listing
    public function list(Request $request){
       
        $list = City::latest()->get();
        //print_r($list);die;
        $data["pageTitle"]="City";
        $data["list"]=$list;
        return view("city.list",$data);

    }
    //Default city add form
    public function add(Request $request){
       
        $data["pageTitle"]="City Add";
        return view("city.add",$data);

    }
    //Default city edit form

    public function edit(Request $request, $id=null){
       
        $id = $request->id; 
      
        $data['city'] = City::find($id);
        $data["pageTitle"]="City Add";
        return view("city.add",$data);

    }
    //Default city add/edit form subimmision
    public function manage(Request $request){
        $rules = array(
            'city_name' => 'required|unique:city,city_name,NULL,id',
            'latitude' => 'required',
            'longitude' => 'required',
              );
            $this->validate($request, $rules);
            $id = $request->id;

            if($id){
            $cat=City::find($id);
            $cat->city_name=$request->city_name;
            $cat->latitude=$request->latitude;
            $cat->longitude=$request->longitude;
            $result= $cat->save();

            if( $result){
                $data['success'] = "city has been updaed succesfully";
                 }
                  else{
                $data['error'] = "city has not been updated succesfully";
                 }
          }
           else{
            $cat=new City();
            $cat->city_name=$request->city_name;
            $cat->latitude=$request->latitude;
            $cat->longitude=$request->longitude;
            $result= $cat->save();

            if( $result){
                $data['success'] = "city has been added succesfully";
                 }
                  else{
                $data['error'] = "city has not been added succesfully";
                 }
        }
        return redirect('city-list')->with($data);
    }
    //Default city delete
    public function delete(Request $request,$id=null){
        $dataId =$id;
        if($dataId)
        {
            $info = City::find($dataId);
            if($info){
                try{
                    $deleteData= $info->delete();
                    $data['success'] = "city has been Deleted succesfully";
                }
                catch(\Exception $e){
                   
                    $msg= $e->getMessage();
                }

            }
        }
        return redirect()->back()->with($data);
    }
    public function search(Request $request){
       
        $data["pageTitle"]="City Search";
        return view("city.search",$data);

    }

    //check whether the city with in 100 km or not from default city.
    public function searchmanage(Request $request){
           $rules = array(
            'latitude' => 'required',
            'longitude' => 'required',
              );
            $this->validate($request, $rules);
            $latitude = $request->latitude;
            $longitude = $request->longitude;
           //  $latitude ='22.6035';
           //  $longitude ='88.4040';
            $query = "SELECT *, (((acos(sin((".$latitude."*pi()/180)) * sin((`latitude`*pi()/180)) + cos((".$latitude."*pi()/180)) * cos((`latitude`*pi()/180)) * cos(((".$longitude."- `longitude`) * pi()/180)))) * 180/pi()) * 60 * 1.1515 * 1.609344) as distance FROM `city` having  distance < 100";
            $result = DB::select($query);
           
            if( !empty($result)){
                $data['success'] = "Your city is in 100 km from default city";
                 }
             else{
                $data['danger'] = "Your city is no in 100 km from default city";
             }
        
            return redirect()->back()->with($data);
    }

}