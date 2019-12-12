<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Storage;
class MenuController extends Controller
{
    //

      public function index(Request $request){
		  $menus=Menu::get();

		 return view('siteadmin.menus.index', ['menus'=>$menus]);

    }

    public function edit(Request $request, $id){
        $partners=Partner::where('isactive', 1)->get();
      $menu = menu::findOrFail($id);
      return view('siteadmin.menus.edit',['menu'=>$menu,'partners'=>$partners]);

    }

    public function add(Request $request){
        $partners=Partner::where('isactive', 1)->get();
        return view('siteadmin.menus.add', ['partners'=>$partners]);
    }

    public function store(Request $request){

			$request->validate([
			'name'=>'required|max:100',
			'image'=>'required|image',
			'price'=>'required',
			'cut_pice'=>'required',
			'isactive'=>'required'

			]);

		$file=$request->image->path();

		$name=str_replace(' ', '_', $request->image->getClientOriginalName());

		$path='menus/'.$name;

		Storage::put($path, $file);

		if(Menu::create(['name'=>$request->name,
							'image'=>$path,
							'price'=>$request->price,
							'cut_pice'=>$request->cut_pice,
							'description'=>$request->description,
							'isactive'=>$request->isactive,
							'creator_id'=>auth()->user()->id,
							'category_id'=>auth()->user()->id,
							'partner_id'=>auth()->user()->id
							]))

							{
				return redirect()->route('admin.menu')->with('success', 'Menus has been created');
		}

		return redirect()->back()->with('error', 'Menus create failed');



    }

    public function update(Request $request, $id){
      $request->validate([
      'name'=>'required|max:100',
      'image'=>'required|image',
      'price'=>'required',
      'cut_pice'=>'required',
      'isactive'=>'required'

      ]);

    $file=$request->image->path();

    $name=str_replace(' ', '_', $request->image->getClientOriginalName());

    $path='menus/'.$name;

    Storage::put($path, $file);

    $partners=Partner::where('isactive', 1)->get();
    $menu = menu::findOrFail($id);

    if($menu->update(['name'=>$request->name,

							'price'=>$request->price,
							'cut_pice'=>$request->cut_pice,
							'description'=>$request->description,
							'isactive'=>$request->isactive,
							'creator_id'=>auth()->user()->id,
							'category_id'=>auth()->user()->id,
							'partner_id'=>auth()->user()->id
  ])){
    		return redirect()->route('admin.menu')->with('success', 'Menus has been updated');

    }else {
      if($menu->update(['name'=>$request->name,

  							'price'=>$request->price,
  							'cut_pice'=>$request->cut_pice,
  							'description'=>$request->description,
  							'isactive'=>$request->isactive,
  							'creator_id'=>auth()->user()->id,
  							'category_id'=>auth()->user()->id,
  							'partner_id'=>auth()->user()->id
                ])){
                  		return redirect()->route('admin.menu')->with('success', 'Menus has been updated');

      }
      	return redirect()->back()->with('error', 'Menus update failed');
    }

    }

}
