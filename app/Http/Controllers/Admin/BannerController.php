<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;
use Storage;
use App\Models\PartnerEvent;
use App\Models\Partner;
class BannerController extends Controller
{
    public function index(Request $request)
    {
		$banners=Banner::get();
		return view('siteadmin.banners.index',['banners'=>$banners]);


	}

	  function ajexdataa(Request $request)
            {
				$type=$request->type;
				if(!in_array($type, ['event', 'party', 'restaurant']))
					$type='event';
				switch($type){
					case 'event':return $events=PartnerEvent::get();
					case 'party':return $restaurants=Partner::where('type', 'restaurant')->where('allow_party', true)->get();
					case 'restaurant':return $restaurants=Partner::where('type', 'restaurant')->get();
				}
                        }


	public function add(Request $request)
	{
		return view('siteadmin.banners.add');
	}
	public function store(Request $request)
	{

	$request->validate([
			'entity_type'=>'nullable',
			'entity_id'=>'nullable',
			'isactive'=>'required',
			'image'=>'required|image',
            'priority'=>'required|integer',
            'placeholder'=>'required|integer'

		]);

		$file=$request->image->path();

		$name=str_replace(' ', '_', $request->image->getClientOriginalName());

		$path='banner/'.$name;

		Storage::put($path, file_get_contents($file), 'public');

	if(Banner::create(['entity_type'=>$request->entity_type,
					'entity_id'=>$request->entity_id,
					'isactive'=>$request->isactive,
					'image'=>$path,
                    'priority'=>$request->priority,
        'placeholder'=>$request->placeholder
					])){
				return redirect()->route('admin.banner')->with('success', 'Banner has been created');
		}

		return redirect()->back()->with('error', 'Banner create failed');

	}

      public function edit(Request $request, $id)
      {
        $banner = Banner::findOrFail($id);
        return view('siteadmin.banners.edit',['banner'=>$banner]);
      }


	       public function update(Request $request,$id)
	        {

            	$request->validate([
            			'entity_type'=>'nullable',
            			'entity_id'=>'nullable',
            			'isactive'=>'required',
                        'priority'=>'required|integer',
                        'image'=>'nullable|image',
                    'placeholder'=>'required|integer',


            		]);
                $banner = banner::findOrFail($id);
                if(!empty($request->image)){
                    $file=$request->image->path();

                    $name=str_replace(' ', '_', $request->image->getClientOriginalName());

                    $path='banner/'.$name;

                    Storage::put($path, file_get_contents($file), 'public');

                }else{
                    $path=DB::raw('image');
                }



          if($banner->update([
                    'entity_type'=>$request->entity_type,
        			'entity_id'=>$request->entity_id,
        			'isactive'=>$request->isactive,
                    'image'=>$path,
                    'priority'=>$request->priority,
                    'placeholder'=>$request->placeholder
          ])){
                return redirect()->route('admin.banner')->with('success', 'Banner has been updated');

          }
             	return redirect()->back()->with('error', 'Banner update failed');
          }

}
