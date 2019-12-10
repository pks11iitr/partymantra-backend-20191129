<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Storage;
use App\Models\Event;
use App\Models\Partner;
class BannerController extends Controller
{
    public function index(Request $request)
    {
		$banners=Banner::get();
		return view('siteadmin.banners.index');
		
		
	}
	
	  function ajexdataa(Request $request)
            {
 
       $events=Event::get();
		$restaurants=Partner::where('type', 'restaurant')->get();
   

                        }
	
	
	public function add(Request $request)
	{
		
		return view('siteadmin.banners.add');
	}
	public function store(Request $request)
	{
	
	}
	public function update(Request $request)
	{
		
	}
	public function edit(Request $request)
	{
		
	}
	
	
    
}
