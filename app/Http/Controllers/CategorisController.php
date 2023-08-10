<?php

namespace App\Http\Controllers;

use App\Models\Categoris;
use App\Http\Requests\StoreCategorisRequest;
use App\Http\Requests\UpdateCategorisRequest;
use App\Traits\GenralTraits;
use App\Traits\ImageTraits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategorisController extends Controller
{
  use GenralTraits , ImageTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoris = Categoris::latest()->get();
        
        return $this->returnData('categoris' , $categoris , 'success' );
    }

    public function show()
    {
      $categories =Categoris::latest()->get();
      $notifications = auth()->user()->unreadNotifications;
      return view('Admin.category.index' , compact('categories' , 'notifications'));
    }
    public function store(StoreCategorisRequest $request){
        $request->validated();


        $data = $request->all();
        if($request->input('name')== null)
        {
            $data['isParent'] = false;
        }else{
            $data['isParent'] = true;
        }
        $data['svg'] = $request->hasFile('image')? $this->uploadImage($request->file('image')->getRealPath()): $this->returnError(201 , 'image is required') ;
        $status = Categoris::create($data);
        if($status){
            return redirect()->route('category.All')->with([
                'message' => 'Category updated successfully',
                'alert-type' => 'success'
            ]);
      }else{
        return back()->with(['error' => 'something went error']);
      }
    }

    public function create()
    {
      $categories =Categoris::all();
      $notifications = auth()->user()->unreadNotifications;
      return view('Admin.category.create' , compact('categories' , 'notifications' ));
    }

    public function categoyStatus(Request $request){
      if($request->mode == 'true'){
        DB::table('categoris')->where('id' , $request->id)->update(['status' => 1]);
      }else{
        DB::table('categoris')->where('id' , $request->id)->update(['status' => 0]);
      }
      return response()->json(['msg' => 'Status Updated Successful' , 'status' => true]);
    }

    public function edit($id)
    {
      $category = Categoris::find($id);
      $notifications = auth()->user()->unreadNotifications;
      if($category){
        return View('Admin.category.edite' , compact('category' , 'notifications'));
      }else{
        return back()->with('error' , 'Data not Found');
      }
    }
    public function update(UpdateCategorisRequest $request , $id)
    {
      $category = Categoris::find($id);
      $category->name = $request->name; 
      if ($request->isParent == 'on') {
          $category->isParent = 1; 
      }
      else{
          $category->isParent = 0; 
      }
      $category->parentId = $request->parentId; 
      $category->svg = $request->hasFile('image')? $this->uploadImage($request->file('image')->getRealPath()): $this->returnError(201 , 'image is required') ;
      $status = $category->update();
      if($status){
          return redirect()->route('category.All')->with([
              'message' => 'Category updated successfully',
              'alert-type' => 'success'
          ]);
      }else{
          return back()->with(['error' => 'something went error']);
      }    
    }

    public function destroy($id)
    {
      $banner = Categoris::find($id);
      if($banner){
        $status = $banner->delete();
        if($status){
          return redirect()->route('category.All')->with([
              'message' => 'Category Deleted successfully',
              'alert-type' => 'success'
          ]);
        }else{
          return back()->with(['error' => 'something went error']);
        }
      }else{
        return back()->with('error' , 'Data not Found');
      }
    }



    public function get_cat_by_parent(Request $request)
    {
        $category = new Categoris();
        return response()->json(['data' =>  $category->getAllChildByParent($request->id) , 'success' => true] , 200);
    }

    
    public function searchByName(Request $request){
      $validation = Validator::make($request->all() , [
          'word' => 'required|string'
      ]);
      if($validation->fails()){
          return response()->json($validation->errors());
      }
      $categories = Categoris::where('parentId' , null)->Where(function (Builder $query) use ($request){
        $query->where('name','LIKE' ,"%{$request->word}%")
        ->orWhere('name','LIKE' ,"%{$request->word}")
        ->orWhere('name','LIKE' ,"{$request->word}%");
    })->get();

      return $this->returnData('categories' , $categories);
  }
}
