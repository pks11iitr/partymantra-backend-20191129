<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Storage;

class PartnerController extends Controller
{
    public function index(Request $request){
		
				 $partners=Partner::get();
				 
	 return view('siteadmin.partners.index', ['partners'=>$partners]);


    }

    public function edit(Request $request, $id){

    }

    public function add(Request $request){
        return view('siteadmin.partners.add');
    }

    public function store(Request $request){
		
		
		
			$request->validate([
			'name'=>'required|max:250',
			'header_image'=>'required|image',
			'small_image'=>'required|image',
			'description'=>'nullable|max:1000',
			'address'=>'nullable|max:250',
			'lat'=>'nullable',
			'lang'=>'nullable',
			'short_address'=>'required|max:50',
			'contact_no'=>'required',
			'type'=>'required',
			'per_person_text'=>'required',
			'isactive'=>'required'
			
			]);
		
		$file=$request->header_image->path();
		
		$name=str_replace(' ', '_', $request->header_image->getClientOriginalName());
		
		$path='partners/'.$name;
		
		Storage::put($path, $file);
		
		// 2nd image 
		$file=$request->small_image->path();
		
		$name1=str_replace(' ', '_', $request->small_image->getClientOriginalName());
		
		$path='partners/'.$name;
		
		Storage::put($path, $file);
		
		if(Partner::create(['name'=>$request->name,
							'header_image'=>$path,
							'small_image'=>$path,
							'description'=>$request->description,
							'address'=>$request->address,
							'short_address'=>$request->short_address,
							 'lat'=>$request->lat,
							 'lang'=>$request->lang,
							 'contact_no'=>$request->contact_no,
							 'type'=>$request->type,
							 'per_person_text'=>$request->per_person_text,
							 'isactive'=>$request->isactive,
							'user_id'=>auth()->user()->id
							]))
							
							{
				return redirect()->route('admin.partners')->with('success', 'Partners has been created');
		}	
		
		return redirect()->back()->with('error', 'Partners create failed');

    }

    public function update(Request $request, $id){

    }


}
