<?php

namespace App\Http\Controllers\Partner;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PartnerEvent;
use Storage;

class EventController extends Controller
{
    //
      public function index(Request $request){


				 $events=PartnerEvent::get();

	 return view('partneradmin.events.index', ['events'=>$events]);


    }

    public function edit(Request $request, $id){

      $events = PartnerEvent::findOrFail($id);
      return view('partneradmin.events.edit',['events'=>$events]);

    }

    public function add(Request $request){
        $organizers=Partner::where('isactive', 1)->where('type', 'organizers')->get();
        //var_dump($organizers->toArray());die;
        return view('partneradmin.events.add', ['organizers'=>$organizers]);
    }

    public function store(Request $request){

			$request->validate([

			'title'=>'required|max:150',
			'header_image'=>'required|image',
			'small_image'=>'required|image',
			'description'=>'required|max:1000',
			'venue_name'=>'required|max:100',
			'venue_adderss'=>'nullable',
			'lat'=>'required',
			'lang'=>'required',
			'startdate'=>'required',
			'enddate'=>'nullable',
			'tnc'=>'required',
			'custom_package_details'=>'required',
			'isactive'=>'required',
			'markasfull'=>'required'
			]);
	$partner=Partner::where('user_id',auth()->user()->id)->first();
		if(isset($request->header_image)){
            $file=$request->header_image->path();

            $name=str_replace(' ', '_',
            $request->header_image->getClientOriginalName());

            $path1='events/'.$name;

            Storage::put($path1, $file);

        }

		if(isset($request->small_image)){
            // 2nd image
            $file=$request->small_image->path();

            $name=str_replace(' ', '_', $request->small_image->getClientOriginalName());

            $path2='events/'.$name;

            Storage::put($path2, $file);

        }

//var_dump(auth()->user()->id);
//die();

		if(PartnerEvent::create(['title'=>$request->title,
							'header_image'=>$path1,
							'small_image'=>$path2,
							'description'=>$request->description,
							'venue_name'=>$request->venue_name,
							'venue_adderss'=>$request->venue_adderss,
							 'lat'=>$request->lat,
							 'lang'=>$request->lang,
							 'startdate'=>$request->startdate,
							 'enddate'=>$request->enddate,
							 'tnc'=>$request->tnc,
							 'custom_package_details'=>$request->custom_package_details,
							  'isactive'=>$request->isactive,
							  'markasfull'=>$request->markasfull,
							'partner_id'=>$partner->id,
              'creator_id'=>auth()->user()->id,
							]))

							{
				return redirect()->route('partner.event')->with('success', 'Events has been created');


    }
    	return redirect()->back()->with('error', 'Events create failed');

    }

    public function update(Request $request, $id){
  $events = PartnerEvent::findOrFail($id);
      $request->validate([

    'title'=>'required|max:150',
      'header_image'=>'required|image',
      'small_image'=>'required|image',
      'description'=>'required|max:1000',
      'venue_name'=>'required|max:100',
      'venue_adderss'=>'nullable',
      'lat'=>'required',
      'lang'=>'required',
      'startdate'=>'required',
      'enddate'=>'nullable',
      'tnc'=>'required',
      'custom_package_details'=>'required',
      'isactive'=>'required',
      'markasfull'=>'required'
      ]);

      if(isset($request->header_image)){
              $file=$request->header_image->path();

              $name=str_replace(' ', '_',
              $request->header_image->getClientOriginalName());

              $path1='events/'.$name;

              Storage::put($path1, $file);

          }

      if(isset($request->small_image)){
              // 2nd image
              $file=$request->small_image->path();

              $name=str_replace(' ', '_', $request->small_image->getClientOriginalName());

              $path2='events/'.$name;

              Storage::put($path2, $file);

          }

          $partner=Partner::where('user_id',auth()->user()->id)->first();

             if($events->update(['title'=>$request->title,
         							'header_image'=>$path1,
         							'small_image'=>$path2,
         							'description'=>$request->description,
         							'venue_name'=>$request->venue_name,
         							'venue_adderss'=>$request->venue_adderss,
         							 'lat'=>$request->lat,
         							 'lang'=>$request->lang,
         							 'startdate'=>$request->startdate,
         							 'enddate'=>$request->enddate,
         							 'tnc'=>$request->tnc,
         							 'custom_package_details'=>$request->custom_package_details,
         							  'isactive'=>$request->isactive,
         							  'markasfull'=>$request->markasfull,
         							'partner_id'=>$partner->id,
                       'creator_id'=>auth()->user()->id,




               	])){

                    return redirect()->route('partner.event')->with('success', 'Events has been created');

                } else {

                  if($events->update(['title'=>$request->title,
              							'description'=>$request->description,
              							'venue_name'=>$request->venue_name,
              							'venue_adderss'=>$request->venue_adderss,
              							 'lat'=>$request->lat,
              							 'lang'=>$request->lang,
              							 'startdate'=>$request->startdate,
              							 'enddate'=>$request->enddate,
              							 'tnc'=>$request->tnc,
              							 'custom_package_details'=>$request->custom_package_details,
              							  'isactive'=>$request->isactive,
              							  'markasfull'=>$request->markasfull,
              							'partner_id'=>$partner->id,
                            'creator_id'=>auth()->user()->id,




                     ])){

                          return redirect()->route('partner.event')->with('success', 'Events has been created');
                     }


                }
                return redirect()->back()->with('error', 'Events create failed');
    }
}
