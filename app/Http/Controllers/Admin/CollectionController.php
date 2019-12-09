<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use Storage;
class CollectionController extends Controller
{
    //
    
    public function index(Request $request){
		
		 $collections=Collection::get();
		 
		 return view('siteadmin.collections.index', ['collections'=>$collections]);


    }

    public function edit(Request $request, $id){

    }

    public function add(Request $request){
        return view('siteadmin.collections.add');
    }

    public function store(Request $request){
		$request->validate([
			'name'=>'required|max:250',
			'cover_image'=>'required|image'
			
		]);
		
		$file=$request->cover_image->path();
		
		$name=str_replace(' ', '_', $request->cover_image->getClientOriginalName());
		
		$path='collections/'.$name;
		
		Storage::put($path, $file);
		
		if(Collection::create(['name'=>$request->name,
					'cover_image'=>$path,
					
					'created_by'=>auth()->user()->id])){
				return redirect()->route('admin.collection')->with('success', 'Collection has been created');
		}	
		
		return redirect()->back()->with('error', 'Collection create failed');

    }

    public function update(Request $request, $id){

    }
}
