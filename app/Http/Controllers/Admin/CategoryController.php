<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
			{

		$categories=Category::get();
		return view('siteadmin.category.index',['categories'=>$categories]);

			}


	public function add(Request $request)
			{
							return view('siteadmin.category.add');
			}


	public function store(Request $request)
			{
				$request->validate([
				'name'=>'required|max:100',
				'image'=>'required|image',
				'isactive'=>'required'

				]);


                    $file=$request->image->path();

                    $name=str_replace(' ', '_', $request->image->getClientOriginalName());

                    $path='category/'.$name;

                    Storage::put($path, file_get_contents($file));


				 if(Category::create(['name'=>$request->name,
									'image'=>$path,
									'isactive'=>$request->isactive,
									'creator_id'=>auth()->user()->id
								]))
                {

									return redirect()->route('admin.category')->with('success','Menus has been created');

                }

									return redirect()->back()->with('error', 'Menus create failed');
		}


            public function edit(Request $request, $id){
              $category = Category::findOrFail($id);

              return View('siteadmin.category.edit',['category'=>$category]);

              }

            public function update (Request $request, $id){

                  $request->validate([
                  'name'=>'required|max:100',
                  'isactive'=>'required',
                   'image'=>'nullable|image'
                  ]);
                if(isset($request->image)){
                  $file=$request->image->path();

              		$name=str_replace(' ', '_', $request->image->getClientOriginalName());

              		$path='category/'.$name;

              		Storage::put($path, file_get_contents($file));
                }else{
                    $path=DB::raw('image');
                }
                $category = category::findOrFail($id);

              if($category->update(['name'=>$request->name,

                          'isactive'=>$request->isactive,
                          'creator_id'=>auth()->user()->id,
                            'image'=>$path
                        ])){

                	return redirect()->route('admin.category')->with('success','Menus has been updated');
                }else {

              if($category->update(['name'=>$request->name,

                      'isactive'=>$request->isactive,
                      'creator_id'=>auth()->user()->id,
                      'image'=>$path

                    ])){
                      	return redirect()->route('admin.category')->with('success','Menus has been updated');
                                }
                              return redirect()->back()->with('error', 'Menus update failed');
                        }

		              }


}
