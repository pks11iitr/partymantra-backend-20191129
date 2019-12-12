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

      $collection = Collection::findOrfail($id);
      return view('siteadmin.collections.edit',['collection'=>$collection]);

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
      $request->validate([
        'name'=>'required|max:250',
        'cover_image'=>'required|image'

      ]);

      $file=$request->cover_image->path();

      $name=str_replace(' ', '_', $request->cover_image->getClientOriginalName());

      $path='collections/'.$name;

      Storage::put($path, $file);
      $collection = collection::findOrfail($id);

      if($collection->update(['name'=>$request->name,
		'created_by'=>auth()->user()->id
      ])){

        		return redirect()->route('admin.collection')->with('success', 'Collection has been updated');
      }else {
        if($collection->update(['name'=>$request->name,
  		'created_by'=>auth()->user()->id

            ])){

        		return redirect()->route('admin.collection')->with('success', 'Collection has been updated');
        }
          return redirect()->back()->with('error', 'Collection update failed');

}
    }
}
