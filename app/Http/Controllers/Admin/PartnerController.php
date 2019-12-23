<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Storage;

class PartnerController extends Controller
{
    public function index(Request $request){

				 $partners=Partner::get();

	 return view('siteadmin.partners.index', ['partners'=>$partners]);


    }

    public function edit(Request $request, $id){

		$partners=Partner::findOrFail($id);
		return view('siteadmin.partners.edit', ['partners'=>$partners]);

    }

    public function add(Request $request){
        return view('siteadmin.partners.add');
    }

    public function store(Request $request){



			$request->validate([
			'contact_no'=>'required|digits:10',
			'mobile'=>'required|digits:10',
			'password'=>'required|max:25',
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

		//create use
		$user=User::where('mobile',$request->mobile)->first();
		if(!$user)
			$user=User::create([
				'mobile' => $request->mobile,
				'password' => Hash::make($request->password),
                'status'=>$request->isactive
			]);
        else{
            return redirect()->back()->with('error', 'Partner Mobile Already registered');
        }

        if(isset($request->header_image)){
            $file=$request->header_image->path();

            $name=str_replace(' ', '_', $request->header_image->getClientOriginalName());

            $path1='partners/'.$name;

            Storage::put($path1, file_get_contents($file));
        }

        if(isset($request->small_image)){
            // 2nd image
            $file=$request->small_image->path();

            $name=str_replace(' ', '_', $request->small_image->getClientOriginalName());

            $path2='partners/'.$name;

            Storage::put($path2, file_get_contents($file));

        }

		if(Partner::create([
		                    'user_id'=>$user->id,
		                    'name'=>$request->name,
							'header_image'=>$path1,
							'small_image'=>$path2,
							'description'=>$request->description,
							'address'=>$request->address,
							'short_address'=>$request->short_address,
							 'lat'=>$request->lat,
							 'lang'=>$request->lang,
							 'contact_no'=>$request->contact_no,
							 'type'=>$request->type,
                            'per_person_text'=>$request->per_person_text,
                            'isactive'=>$request->isactive,
							'user_id'=>$user->id
							]))

							{
				return redirect()->route('admin.partners')->with('success', 'Partners has been created');
		}

		return redirect()->back()->with('error', 'Partners create failed');

    }

    public function update(Request $request, $id){

        $partners=Partner::findOrFail($id);
		$request->validate([
			'contact_no'=>'required|digits:10',
			'name'=>'required|max:250',
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

      //enable disable user to login
      $user=$partners->user;
      $user->status=$request->isactive;
      $user->save();

      if(isset($request->header_image)){
          $file=$request->header_image->path();

          $name=str_replace(' ', '_', $request->header_image->getClientOriginalName());

          $path1='partners/'.$name;

          Storage::put($path1, file_get_contents($file));
      }else{
          $path1=DB::raw('header_image');
      }

      if(isset($request->small_image)){
          // 2nd image
          $file=$request->small_image->path();

          $name=str_replace(' ', '_', $request->small_image->getClientOriginalName());

          $path2='partners/'.$name;

          Storage::put($path2, file_get_contents($file));

      }else{
          $path2=DB::raw('small_image');
      }


		if($partners->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'address'=>$request->address,
            'short_address'=>$request->short_address,
            'lat'=>$request->lat,
            'lang'=>$request->lang,
            'contact_no'=>$request->contact_no,
            'type'=>$request->type,
            'per_person_text'=>$request->per_person_text,
            'isactive'=>$request->isactive,
		])) {
                return redirect()->route('admin.partners')->with('success', 'Partners has been updated');

            }

        return redirect()->route('admin.partners')->with('error', 'Partner Update failed');


    }

    public function changepartnerpassword(Request $request, $id){
        $partner=Partner::findOrFail($id);
        $user=$partner->user();
        $user->password=Hash::make($request->password);
        return redirect()->back()->with('success', 'Pasword has been changed');
    }


}
