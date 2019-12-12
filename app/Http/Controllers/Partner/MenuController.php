<?php

namespace App\Http\Controllers\Partner;

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

		 return view('partneradmin.menus.index', ['menus'=>$menus]);

    }

    public function edit(Request $request, $id){

        $menus=Menu::findOrFail($id);
      	 return view('partneradmin.menus.edit',['menus'=>$menus]);


    }

    public function add(Request $request){

        $partners=Partner::where('isactive', 1)->get();
        return view('partneradmin.menus.add', ['partners'=>$partners]);
    }

    public function store(Request $request){

			$request->validate([
			'name'=>'required|max:100',
			'image'=>'required|image',
			'price'=>'required',
			'cut_pice'=>'required',
			'isactive'=>'required'

			]);
	$partner=Partner::where('user_id',auth()->user()->id)->first();


             if(isset($request->image)){
		$file=$request->image->path();

		$name=str_replace(' ', '_', $request->image->getClientOriginalName());

		$path='menus/'.$name;

		Storage::put($path, $file);

}

	if(Menu::create([
              'name'=>$request->name,
							'image'=>$path,
							'price'=>$request->price,
							'cut_pice'=>$request->cut_pice,
							'description'=>$request->description,
							'isactive'=>$request->isactive,
							'creator_id'=>auth()->user()->id,
							'partner_id'=>$partner->id,
							]))

							{
				return redirect()->route('partner.menu')->with('success', 'Menus has been created');
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

    		Storage::put($path, $file);

     $menus=Menu::findOrFail($id);

  	$partner=Partner::where('user_id',auth()->user()->id)->first();
        if($menus->update([
          'name'=>$request->name,
          'image'=>$path,
          'price'=>$request->price,
          'cut_pice'=>$request->cut_pice,
          'description'=>$request->description,
          'isactive'=>$request->isactive,
          'creator_id'=>auth()->user()->id,
          'partner_id'=>$partner->id,

      							])){
                      return redirect()->route('partner.menu')->with('success', 'Menus has been created');


                    }

    }
    else
    {
      if($menus->update([

        'name'=>$request->name,

        'price'=>$request->price,
        'cut_pice'=>$request->cut_pice,
        'description'=>$request->description,
        'isactive'=>$request->isactive,
        'creator_id'=>auth()->user()->id,
        'partner_id'=>$partner->id,
    							])){

                    return redirect()->route('partner.menu')->with('success', 'Menus has been created');

                  }

    }
	return redirect()->back()->with('error', 'Menus create failed');
}

}
