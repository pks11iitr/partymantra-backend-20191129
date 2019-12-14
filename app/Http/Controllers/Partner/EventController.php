<?php

namespace App\Http\Controllers\Partner;

use App\Models\Collection;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PartnerEvent;
use Illuminate\Support\Facades\DB;
use Storage;

class EventController extends Controller
{
    //
      public function index(Request $request){

                $partner=Partner::active()->where('user_id', auth()->user()->id)->firstOrFail();
				 $events=PartnerEvent::where('partner_id', $partner->id)->get();

	 return view('partneradmin.events.index', ['events'=>$events]);


    }

    public function edit(Request $request, $id){
        $partner=Partner::active()->where('user_id', auth()->user()->id)->firstOrFail();
        $event=PartnerEvent::where('partner_id', $partner->id)->where('id', $id)->firstOrFail();
        $collections=Collection::active()->get();
      return view('partneradmin.events.edit',['collections'=>$collections, 'events'=>$event]);

    }

    public function add(Request $request){

        //var_dump($organizers->toArray());die;
        $collections=Collection::active()->get();
        return view('partneradmin.events.add', ['collections'=>$collections]);
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
			'markasfull'=>'required',
			]);
	        $partner=Partner::where('user_id',auth()->user()->id)->firstOrFail();
		if(isset($request->header_image)){
            $file=$request->header_image->path();

            $name=str_replace(' ', '_',
            $request->header_image->getClientOriginalName());

            $path1='events/'.$name;

            Storage::put($path1, file_get_contents($file));

        }

		if(isset($request->small_image)){
            // 2nd image
            $file=$request->small_image->path();

            $name=str_replace(' ', '_', $request->small_image->getClientOriginalName());

            $path2='events/'.$name;

            Storage::put($path2, file_get_contents($file));

        }

//var_dump(auth()->user()->id);
//die();

		if($event=PartnerEvent::create(['title'=>$request->title,
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
							  'isactive'=>0,
							  'partneractive'=>$request->isactive,
							  'markasfull'=>$request->markasfull,
							  'partner_id'=>$partner->id,
                              'creator_id'=>auth()->user()->id,
							]))

							{
                                if(!empty($request->collection_id)){
                                    $event->collections()->detach();
                                    $event->collections()->attach($request->collection_id);
                                }
				                return redirect()->route('partner.event')->with('success', 'Events has been created');


                             }
    	return redirect()->back()->with('error', 'Events create failed');

    }

    public function update(Request $request, $id){
        $partner=Partner::active()->where('user_id', auth()->user()->id)->firstOrFail();
        $events=PartnerEvent::where('partner_id', $partner->id)->where('id', $id)->firstOrFail();
      $request->validate([

    'title'=>'required|max:150',
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

          }else{
          $path1=DB::raw('header_image');
      }

      if(isset($request->small_image)){
              // 2nd image
              $file=$request->small_image->path();

              $name=str_replace(' ', '_', $request->small_image->getClientOriginalName());

              $path2='events/'.$name;

              Storage::put($path2, $file);

          }else{
          $path2=DB::raw('small_image');
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
                                     'isactive'=>false,
                                     'partneractive'=>$request->isactive,
         							  'markasfull'=>$request->markasfull,
         							'partner_id'=>$partner->id,
                       'creator_id'=>auth()->user()->id,
               	])){
                 if(!empty($request->collection_id)){
                     if(!empty($request->collection_id)){
                         $events->collections()->detach();
                         $events->collections()->attach($request->collection_id);
                     }
                 }else{
                     $events->collections()->detach();
                 }
                    return redirect()->route('partner.event')->with('success', 'Events has been created');

                }
                return redirect()->back()->with('error', 'Events update failed');
    }
}
