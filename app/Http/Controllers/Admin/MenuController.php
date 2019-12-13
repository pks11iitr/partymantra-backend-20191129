<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
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
      $menu = Menu::findOrFail($id);
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

		Storage::put($path, file_get_contents($file));

		if(Menu::create(['name'=>$request->name,
							'image'=>$path,
							'price'=>$request->price,
							'cut_pice'=>$request->cut_pice,
							'description'=>$request->description,
							'isactive'=>$request->isactive,
							'creator_id'=>auth()->user()->id,
							'category_id'=>auth()->user()->id,
							'partner_id'=>$request->partner_id
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

    if(isset($request->image)){
        $file=$request->image->path();

        $name=str_replace(' ', '_', $request->image->getClientOriginalName());

        $path='menus/'.$name;

        Storage::put($path, file_get_contents($file));

    }else{
        $path=DB::raw('image');
    }

    $partners=Partner::where('isactive', 1)->get();
    $menu = Menu::findOrFail($id);

    if($menu->update(['name'=>$request->name,

							'price'=>$request->price,
							'cut_pice'=>$request->cut_pice,
							'description'=>$request->description,
							'isactive'=>$request->isactive,
                            'image'=>$path,
							'creator_id'=>auth()->user()->id,
							'category_id'=>auth()->user()->id,
                            'partner_id'=>$request->partner_id
  ])){
    		return redirect()->route('admin.menu')->with('success', 'Menus has been updated');

    }
      	return redirect()->back()->with('error', 'Menus update failed');

    }


    public function partnermenus(Request $request, $id){
          return Menu::active()->where('partner_id', $id)->get();
    }

}
