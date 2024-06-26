<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Partner;
use App\Models\PartnerEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Storage;
class EventPackagesController extends Controller
{
    //

    public function index(Request $request){

      	$event_packages=Package::where('package_type', 'other')->get();
      return view('siteadmin.package.index',['event_packages'=>$event_packages]);

    }

    public function edit(Request $request, $id){
        $organizers=Partner::active()->get();
      $events=PartnerEvent::where('isactive', 1)->get();
      $package = Package::findOrfail($id);
      //var_dump($package->menus);die;
      return view('siteadmin.package.edit',['package'=>$package,'events'=>$events, 'organizers'=>$organizers]);


    }

    public function add(Request $request){
        $organizers=Partner::active()->get();
        $events=PartnerEvent::where('isactive', 1)->get();
        return view('siteadmin.package.add',['events'=>$events, 'organizers'=>$organizers]);
    }

    public function store(Request $request){

      $request->validate([
        'package_name'=>'required|max:50',
        'text_under_name'=>'required|max:50',
        'price'=>'required',
        'custom_package_detail'=>'required',
        'isactive'=>'required',
        'partneractive'=>'required',
        'event_id'=>'nullable',
          'partner_id'=>'nullable'
      ]);
        $event=PartnerEvent::findOrFail($request->event_id);
      if($package=Package::create([
        'package_name'=>$request->package_name,
        'text_under_name'=>$request->text_under_name,
        'price'=>$request->price,
        'custom_package_detail'=>$request->custom_package_detail,
        'isactive'=>$request->isactive,
        'partneractive'=>$request->partneractive,
        'event_id'=>$request->event_id,
          'partner_id'=>$request->partner_id,
          'created_by'=>auth()->user()->id,
          'forparty'=>$request->forparty,
          'fordining'=>$request->fordining,
        ])){

            if(!empty($request->menus)){
                $package->menus()->attach($request->menus);
            }else{

            }

            return redirect()->route('admin.package')->with('success', 'Package has been created');
      }

        return redirect()->back()->with('error', 'Package create failed');

        }



              public function update(Request $request,$id){
                $request->validate([
                  'package_name'=>'required|max:50',
                  'text_under_name'=>'required|max:50',
                  'price'=>'required',
                  'custom_package_detail'=>'required',
                  'isactive'=>'required',
                  'partneractive'=>'required',

                ]);
                  $package = Package::findOrfail($id);
                  $event=PartnerEvent::findOrFail($request->event_id);

                if($package->update([
                  'package_name'=>$request->package_name,
                  'text_under_name'=>$request->text_under_name,
                  'price'=>$request->price,
                  'custom_package_detail'=>$request->custom_package_detail,
                  'isactive'=>$request->isactive,
                  'partneractive'=>$request->partneractive,
                  'event_id'=>$request->event_id,
                    'partner_id'=>$request->partner_id,
                    'created_by'=>auth()->user()->id,
                    'forparty'=>$request->forparty,
                    'fordining'=>$request->fordining,
                  ])){
                    if(!empty($request->menus)){
                        $package->menus()->detach();
                        $package->menus()->attach($request->menus);
                    }else{
                        $package->menus()->detach();
                    }

                    return redirect()->route('admin.package')->with('success', 'Package has been updated');
                }

                  return redirect()->back()->with('error', 'Package update failed');

                  }


    public function ajaxselectmenuevent(Request $request, $id){
            $event=PartnerEvent::with('partner')->findOrFail($id);
            //var_dump($event->partner_id);
            return $event->partner->menus->where('isactive', 1);
    }



                }
