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
      if ($request->perPage) {
        $categoris = Categoris::latest()->paginate($request->perPage);
      }
      else{
        $categoris = Categoris::latest()->get();
      }

      return $this->returnData('categoris' , $categoris , 'success' );
    }

    public function show()
    {
      $categories =Categoris::latest()->get();
      return view('Admin.category.index' , compact('categories'));
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
        return view('Admin.category.create' , compact('categories'));
    }

    public function categoyStatus(Request $request){
      if($request->mode == 'true'){
        DB::table('categories')->where('id' , $request->id)->update(['status' => 'active']);
      }else{
        DB::table('categories')->where('id' , $request->id)->update(['status' => 'unactive']);
      }
      return response()->json(['msg' => 'Status Updated Successful' , 'status' => true]);
    }

    public function edit($id)
    {
      $category = Categoris::find($id);
      if($category){
        return View('Admin.category.edite' , compact('category'));
      }else{
        return back()->with('error' , 'Data not Found');
      }
    }
    public function update(UpdateCategorisRequest $request , $id)
    {
      $request->validated();
      $data = $request->all();
      if($request->input('title')== null)
      {
        $data['isParent'] = false;
      }else{
        $data['isParent'] = true;
      }
      $category = Categoris::find($id);
      $category['svg'] = $request->hasFile('image')? $this->uploadImage($request->file('image')->getRealPath()): $this->returnError(201 , 'image is required') ;
      $status =$category->fill($data)->save();
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
