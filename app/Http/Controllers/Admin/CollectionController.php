<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Support\Facades\DB;
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
			'cover_image'=>'required|image',
            'small_image'=>'required|image',
            'isactive'=>'required|in:0,1',
            'istop' =>'required|in:0,1',
            'priority'=>'required|integer',
            'about'=>'required',
            'type'=>'required|in:party,event,restaurant'
		]);

		$file=$request->cover_image->path();

		$name=str_replace(' ', '_', $request->cover_image->getClientOriginalName());

		$path1='collections/'.$name;

		Storage::put($path1, file_get_contents($file));

        $file=$request->cover_image->path();

        $name=str_replace(' ', '_', $request->cover_image->getClientOriginalName());

        $path2='collections/'.$name;

        Storage::put($path2, file_get_contents($file));


        if(Collection::create(['name'=>$request->name,
					'cover_image'=>$path1,
                    'small_image'=>$path2,
					'istop'=>$request->istop,
					'priority'=>$request->priority,
					'isactive'=>$request->isactive,
					'created_by'=>auth()->user()->id,
                    'about'=>$request->about,
                    'type'=>$request->type
            ])){
				return redirect()->route('admin.collection')->with('success', 'Collection has been created');
		}

		return redirect()->back()->with('error', 'Collection create failed');

    }

    public function update(Request $request, $id){
      $request->validate([
        'name'=>'required|max:250',
          'isactive'=>'required|in:0,1',
            'istop' =>'required|in:0,1',
            'priority'=>'required|integer',
          'about'=>'required',
          'cover_image'=>'nullable|image',
          'small_image'=>'nullable|image',
          'type'=>'required|in:party,event,restaurant'
      ]);

      if(!empty($request->cover_image)){
          $file=$request->cover_image->path();

          $name=str_replace(' ', '_', $request->cover_image->getClientOriginalName());

          $path1='collections/'.$name;

          Storage::put($path1, file_get_contents($file));
      }else{
          $path1=DB::raw('cover_image');
      }

        if(!empty($request->small_image)){
            $file=$request->small_image->path();

            $name=str_replace(' ', '_', $request->small_image->getClientOriginalName());

            $path2='collections/'.$name;

            Storage::put($path2, file_get_contents($file));
        }else{
            $path2=DB::raw('small_image');
        }

      $collection = collection::findOrfail($id);

      if($collection->update(['name'=>$request->name,
		'created_by'=>auth()->user()->id,
          'small_image'=>$path2,
          'cover_image'=>$path1,
          'istop'=>$request->istop,
          'priority'=>$request->priority,
          'isactive'=>$request->isactive,
          'about'=>$request->about,
          'type'=>$request->type

      ])){

        		return redirect()->route('admin.collection')->with('success', 'Collection has been updated');
      }
          return redirect()->back()->with('error', 'Collection update failed');


    }
}
