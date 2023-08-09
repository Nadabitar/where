<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Traits\GenralTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class RegionController extends Controller
{
    use GenralTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $region = Region::latest()->get();
        return $this->returnData('region' , $region , 'success' );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::latest()->get();
        $notifications = auth()->user()->unreadNotifications;
        return view('Admin.region.create' ,  compact('regions' , 'notifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRegionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function regionStatus(Request $request)
    {
        if($request->mode == 'true'){
            DB::table('regions')->where('id' , $request->id)->update(['status' => '1']);
        }else{
            DB::table('regions')->where('id' , $request->id)->update(['status' => '0']);
        }
        return response()->json(['msg' => 'Status Updated Successful' , 'status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        $regions = Region::latest()->get();
        $notifications = auth()->user()->unreadNotifications;
        return view('Admin.region.index' , compact('regions' , 'notifications'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::find($id);
        $notifications = auth()->user()->unreadNotifications;
        return  view('Admin.region.edite' , compact('region' , 'notifications'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegionRequest  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegionRequest $request, $id)
    {
        $region = Region::find($id);
        $region->name = $request->name; 
        if ($request->isParent == 'on') {
            $region->isParent = 1; 
        }
        else{
            $region->isParent = 0; 
        }
        $region->parentId = $request->parentId; 
        $status = $region->update();
        if($status){
            return redirect()->route('region.All')->with([
                'message' => 'Region updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        //
    }

    public function get_street_by_region($id)
    {
        $region = new Region();
        return response()->json(['data' =>   $region->getAllStreetByRegion($id) , 'success' => true] , 200);
    }

    public function get_streets_by_region(Request $request)
    {
        
        $region = new Region();
        return response()->json(['data' =>   $region->getAllStreetsByRegion($request->id) , 'success' => true] , 200);
    }
}
