<?php

namespace App\Http\Controllers\Admin;

use App\Models\Collection;
use App\Models\Document;
use App\Models\Facility;
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
          $collections=Collection::active()->where('type', 'event')->get();
          $facilities=Facility::get();
          $covers=[];
          foreach($event->covers as $c){
              if($c->package_name=='Men' && $c->isactive){
                  $covers['men']=$c->price;
              }
              if($c->package_name=='Women' && $c->isactive){
                  $covers['women']=$c->price;
              }
              if($c->package_name=='Couple' && $c->isactive){
                  $covers['couple']=$c->price;
              }
          }
          return view('siteadmin.events.edit',['event'=>$event, 'organizers'=>$organizers, 'collections'=>$collections, 'facilities'=>$facilities, 'covers'=>$covers]);
    }



    public function add(Request $request){
        $organizers=Partner::active()->whereIn('type', ['organizers', 'restaurant'])->get();
        $facilities=Facility::get();
        $collections=Collection::active()->where('type', 'event')->get();
        return view('siteadmin.events.add', ['organizers'=>$organizers, 'collections'=>$collections, 'facilities'=>$facilities]);
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
                'per_person_text'=>'nullable',
                'custom_package_details'=>'nullable',
                'isactive'=>'required',
                'partneractive'=>'required',
                'istop'=>'required',
                'priority'=>'required|integer'
			]);

            if(isset($request->header_image)){
                $file=$request->header_image->path();

                $name=str_replace(' ', '_',                                   $request->header_image->getClientOriginalName());

                $path1='events/'.$name;

                Storage::put($path1, file_get_contents($file), 'public');

            }

            if(isset($request->small_image)){
                // 2nd image
                $file=$request->small_image->path();

                $name=str_replace(' ', '_', $request->small_image->getClientOriginalName());

                $path2='events/'.$name;

                Storage::put($path2, file_get_contents($file), 'public');

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
                                'tnc'=>$request->tnc,
                                'per_person_text'=>$request->per_person_text,                                                               'custom_package_details'=>$request->custom_package_details,
                                'isactive'=>$request->isactive,
                                'partneractive'=>$request->partneractive,
                                'markasfull'=>$request->markasfull,
                                'creator_id'=>auth()->user()->id,
                                'partner_id'=>$request->partner_id,
                                'istop'=>$request->istop,
                                'priority'=>$request->priority,
                                ]))
            {
                    if(!empty($request->collection_id)){
                        $event->collections()->detach();
                        $event->collections()->attach($request->collection_id);
                    }
                    if(!empty($request->facilities)){
                        $event->facilities()->detach();
                        $event->facilities()->attach($request->facilities);
                    }

                    $men=Package::create(['event_id'=>$event->id, 'partner_id'=>$event->partner_id, 'package_name'=>'Men', 'text_under_name'=>'a', 'custom_package_detail'=>'a', 'created_by'=>auth()->user()->id, 'isactive'=>false, 'partneractive'=>true, 'price'=>0, 'package_type'=>'cover']);
                    $women=Package::create(['event_id'=>$event->id, 'partner_id'=>$event->partner_id, 'package_name'=>'Women', 'text_under_name'=>'a', 'custom_package_detail'=>'a', 'created_by'=>auth()->user()->id, 'isactive'=>false, 'partneractive'=>true, 'price'=>0, 'package_type'=>'cover']);
                    $couple=Package::create(['event_id'=>$event->id, 'partner_id'=>$event->partner_id, 'package_name'=>'Couple', 'text_under_name'=>'a', 'custom_package_detail'=>'a', 'created_by'=>auth()->user()->id, 'isactive'=>false, 'partneractive'=>true, 'price'=>0, 'package_type'=>'cover']);

                    if(!empty($request->cover)){
                        if(in_array('men', $request->cover)){
                            $men->price=$request->charge['men'];
                            $men->isactive=true;
                            $men->save();
                        }
                        if(in_array('women', $request->cover)){
                            $women->price=$request->charge['women'];
                            $women->isactive=true;
                            $women->save();
                        }
                        if(in_array('couple', $request->cover)){
                            $couple->price=$request->charge['couple'];
                            $couple->isactive=true;
                            $couple->save();
                        }
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
            'per_person_text'=>'required',
            'custom_package_details'=>'nullable',
            'isactive'=>'required',
            'partneractive'=>'required',
            'markasfull'=>'required',
            'istop'=>'required',
            'priority'=>'required|integer',
            'header_image'=>'nullable|image',
            'small_image'=>'nullable|image',
        ]);

        if(!empty($request->header_image)){
            $file=$request->header_image->path();

            $name=str_replace(' ', '_',                                   $request->header_image->getClientOriginalName());

            $path1='events/'.$name;

            Storage::put($path1, file_get_contents($file), 'public');

        }else{
            $path1=DB::raw('header_image');
        }

        if(!empty($request->small_image)){
            // 2nd image
            $file=$request->small_image->path();

            $name=str_replace(' ', '_', $request->small_image->getClientOriginalName());

            $path2='events/'.$name;

            Storage::put($path2, file_get_contents($file), 'public');

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
            'per_person_text'=>$request->per_person_text,
            'custom_package_details'=>$request->custom_package_details,
            'isactive'=>$request->isactive,
            'partneractive'=>$request->partneractive,
            'markasfull'=>$request->markasfull,
            'creator_id'=>auth()->user()->id,
            'partner_id'=>$request->partner_id,
            'istop'=>$request->istop,
            'priority'=>$request->priority,
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
            if(!empty($request->facilities)){
                $event->facilities()->detach();
                $event->facilities()->attach($request->facilities);
            }else{
                $event->facilities()->detach();
            }

            $covers=$event->covers;

            if(!empty($request->cover)){
                foreach($covers as $c){
                    if($c->package_name=='Men'){
                        if(in_array('men', $request->cover)){
                            $c->price=$request->charge['men'];
                            $c->isactive=true;
                            $c->save();
                        }else{
                            //$c->price=$request->charge['men'];
                            $c->isactive=false;
                            $c->save();
                        }
                    }
                    if($c->package_name=='Women'){
                        if(in_array('women', $request->cover)){
                            $c->price=$request->charge['women'];
                            $c->isactive=true;
                            $c->save();
                        }else{
                            //$c->price=$request->charge['men'];
                            $c->isactive=false;
                            $c->save();
                        }
                    }
                    if($c->package_name=='Couple'){
                        if(in_array('couple', $request->cover)){
                            $c->price=$request->charge['couple'];
                            $c->isactive=true;
                            $c->save();
                        }else{
                            //$c->price=$request->charge['men'];
                            $c->isactive=false;
                            $c->save();
                        }
                    }
                }

            }


            return redirect()->route('admin.event')->with('success', 'Events has been created');


        }
        return redirect()->back()->with('error', 'Events create failed');


    }

    public function addgallery(Request $request, $id){
        $event=PartnerEvent::findOrFail($id);
        if(!empty($request->gallery)){

            $request->validate([
               'gallery.*'=>'required|image'
            ]);

            foreach($request->gallery as $file){

                $event->saveDocument($file, 'events');
            }
        }
        return redirect()->back()->with('success', 'Images have been uploaded');
    }

    public function deletegallery(Request $request, $id){
        Document::where('id', $id)->where('entity_type', 'App\Models\PartnerEvent')->delete();
        return redirect()->back()->with('success', 'Images has been deleted');
    }

}
