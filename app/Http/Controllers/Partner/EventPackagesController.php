<?php

namespace App\Http\Controllers\Partner;

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

      	$event_packages=Package::get();
      return view('partneradmin.package.index',['event_packages'=>$event_packages]);

    }

    public function edit(Request $request, $id){
        $partner=Partner::active()->where('user_id', auth()->user()->id)->firstOrFail();
        $events=PartnerEvent::where('partneractive', 1)->where('partner_id', $partner->id)->get();
        $package = Package::where('partner_id',$partner->id)->where('id', $id)->firstOrfail();
        $menus=Menu::active()->where('partner_id', $partner->id)->get();
      return view('partneradmin.package.edit',['package'=>$package,'events'=>$events, 'menus'=>$menus]);


    }

    public function add(Request $request){
        $partner=Partner::active()->where('user_id', auth()->user()->id)->firstOrFail();
        $events=PartnerEvent::where('partneractive', 1)->where('partner_id', $partner->id)->get();
        //var_dump($events);die;
        $menus=Menu::active()->where('partner_id', $partner->id)->get();
        return view('partneradmin.package.add',['events'=>$events, 'menus'=>$menus]);
    }

    public function store(Request $request){
      $request->validate([
        'package_name'=>'required|max:50',
        'text_under_name'=>'required|max:50',
        'price'=>'required',
        'custom_package_detail'=>'required',
        'isactive'=>'required',

      ]);

      if(Package::create([
        'package_name'=>$request->package_name,
        'text_under_name'=>$request->text_under_name,
        'price'=>$request->price,
        'custom_package_detail'=>$request->custom_package_detail,
        'isactive'=>$request->isactive,
        'event_id'=>auth()->user()->id
        ])){

            return redirect()->route('partner.package')->with('success', 'Package has been created');
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

                ]);
                  $package = Package::findOrfail($id);
                $events=PartnerEvent::where('isactive', 1)->get();

                if($package->update([
                  'package_name'=>$request->package_name,
                  'text_under_name'=>$request->text_under_name,
                  'price'=>$request->price,
                  'custom_package_detail'=>$request->custom_package_detail,
                  'isactive'=>$request->isactive,
                  'event_id'=>auth()->user()->id
                  ])){

                      return redirect()->route('partner.package')->with('success', 'Package has been updated');
                }

                  return redirect()->back()->with('error', 'Package update failed');

                  }






                }
