<?php

namespace App\Http\Controllers\Admin;

use App\Models\Collection;
use App\Models\Menu;
use App\Models\Package;
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


				 $events=PartnerEvent::get();

	 return view('siteadmin.events.index', ['events'=>$events]);


    }


    public function edit(Request $request, $id){
          $organizers=Partner::active()->get();
          $event = PartnerEvent::findOrFail($id);
          $collections=Collection::active()->get();
          return view('siteadmin.events.edit',['event'=>$event, 'organizers'=>$organizers, 'collections'=>$collections]);
    }



    public function add(Request $request){
        $organizers=Partner::active()->whereIn('type', ['organizers', 'restaurant'])->get();
        $collections=Collection::active()->get();
        return view('siteadmin.events.add', ['organizers'=>$organizers, 'collections'=>$collections]);
    }

    public function store(Request $request){

			$request->validate([
			    'partner_id'=>'required|integer',
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

                $name=str_replace(' ', '_',                                   $request->header_image->getClientOriginalName());

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
                                'tnc'=>$request->tnc,                                                               'custom_package_details'=>$request->custom_package_details,
                                'isactive'=>$request->isactive,
                                'markasfull'=>$request->markasfull,
                                'creator_id'=>auth()->user()->id,
                                'partner_id'=>$request->partner_id
                                ]))
            {
                    if(!empty($request->collection_id)){
                        $event->collections()->detach();
                        $event->collections()->attach($request->collection_id);
                    }
                    return redirect()->route('admin.event')->with('success', 'Events has been created');
            }
            return redirect()->back()->with('error', 'Events create failed');

        }

    public function update(Request $request, $id){


        $event=PartnerEvent::findOrFail($id);
        $request->validate([
            'partner_id'=>'required|integer',
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

            $name=str_replace(' ', '_',                                   $request->header_image->getClientOriginalName());

            $path1='events/'.$name;

            Storage::put($path1, file_get_contents($file));

        }else{
            $path1=DB::raw('header_image');
        }

        if(isset($request->small_image)){
            // 2nd image
            $file=$request->small_image->path();

            $name=str_replace(' ', '_', $request->small_image->getClientOriginalName());

            $path2='events/'.$name;

            Storage::put($path2, file_get_contents($file));

        }else{
            $path2=DB::raw('small_image');
        }

        $ecollection=$event->collection;

        if($event->update(['title'=>$request->title,
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
            'creator_id'=>auth()->user()->id,
            'partner_id'=>$request->partner_id
        ]))

        {

            if(!empty($request->collection_id)){
                if(!empty($request->collection_id)){
                    $event->collections()->detach();
                    $event->collections()->attach($request->collection_id);
                }
            }else{
                $event->collections()->detach();
            }
            return redirect()->route('admin.event')->with('success', 'Events has been created');


        }
        return redirect()->back()->with('error', 'Events create failed');


    }


    public function ajaxpartnerevent(Request $request, $id){
          $partner=Partner::findOrFail($id);
          return $partner->packages;
    }
}
