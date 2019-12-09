<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Storage;

class EventController extends Controller
{
    //
      public function index(Request $request){
		  
		  
				 $events=Event::get();
				 
	 return view('siteadmin.events.index', ['events'=>$events]);


    }

    public function edit(Request $request, $id){

    }

    public function add(Request $request){
        return view('siteadmin.events.add');
    }

    public function store(Request $request){
		
			$request->validate([
			'title'=>'required|max:150',
			'header_image'=>'required|image',
			'small_image'=>'required|image',
			'description'=>'required|max:1000',
			'venue_name'=>'required|max:100',
			'venue_adderss'=>'required|max:250',
			'lat'=>'required',
			'lang'=>'required',
			'startdate'=>'required',
			'enddate'=>'nullable',
			'tnc'=>'required',
			'custom_package_details'=>'required',
			'isactive'=>'required',
			'markasfull'=>'required'
			
			
			]);
		
		$file=$request->header_image->path();
		
		$name=str_replace(' ', '_', $request->header_image->getClientOriginalName());
		
		$path='events/'.$name;
		
		Storage::put($path, $file);
		
		// 2nd image 
		$file=$request->small_image->path();
		
		$name1=str_replace(' ', '_', $request->small_image->getClientOriginalName());
		
		$path='events/'.$name;
		
		Storage::put($path, $file);
		
		if(Event::create(['title'=>$request->title,
							'header_image'=>$path,
							'small_image'=>$path,
							'description'=>$request->description,
							'venue_name'=>$request->venue_name,
							'venue_adderss'=>$request->venue_adderss,
							 'lat'=>$request->lat,
							 'lang'=>$request->lang,
							 'startdate'=>$request->startdate,
							 'enddate'=>$request->enddate,
							 'tnc'=>$request->tnc,
							 'custom_package_details'=>$request->custom_package_details,
							  'isactive'=>$request->isactive,
							  'markasfull'=>$request->markasfull,
							'partner_id'=>auth()->user()->id
							]))
							
							{
				return redirect()->route('admin.events')->with('success', 'Events has been created');
		

    }
    	return redirect()->back()->with('error', 'Events create failed');

    }

    public function update(Request $request, $id){

    }
}
