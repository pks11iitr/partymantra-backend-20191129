<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cusine;

class CusineController extends Controller
{
    //
     public function index(Request $request){
		 
		 $cusines=Cusine::get();
		 
		 return view('siteadmin.cusines.index', ['cusines'=>$cusines]);

    }

    public function edit(Request $request, $id){
		$cusine=Cusine::findOrFail($id);
		return view('siteadmin.cusines.edit', ['cusine'=>$cusine]);

    }


    public function add(Request $request){
        return view('siteadmin.cusines.add');
    }

    public function store(Request $request){
		
		$request->validate([
			'name'=>'required|max:100'
		]);
		
		if(Cusine::create(['name'=>$request->name, 
		'creator_id'=>auth()->user()->id])){
				return redirect()->route('admin.cusines')->with('success', 'Cusine has been created');
		}	
		
		return redirect()->back()->with('error', 'Cusine create failed');

    }

    public function update(Request $request, $id){
		
		$request->validate([
			'name'=>'required|max:100'
		]);
		
		
		if(Cusine::update(['name'=>$request->name
							
							]))
							{
								
								
					return redirect()->route('admin.cusines')->with('success', 'Cusine has been updated');
		}	
		
		return redirect()->back()->with('error', 'Cusine create failed');

    }


}
