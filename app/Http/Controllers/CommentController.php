<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStore;
use App\Models\Comment;
use App\Models\Places;
use App\Models\User;
use App\Traits\GenralTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    use GenralTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'placeId' => 'string|required',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }

        $comments = DB::select('select comments.* , users.fullName , users.gender
        from comments 
        Join users 
        on users.id = comments.userId 
        where  placeId = ? 
        ORDER BY comments.created_at Desc
        ' , [$request->placeId]); 

        return $this->returnData('comments' , $comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStore $request)
    {
        $request->validated();
        // ----------------------------

        if (!Auth::check()) {
            return $this->returnError(404 , 'Not Authenticated');
        }
        $userId  = auth()->user()->id;
        // return $userId;
        $placeId = $request->placeId;

        // $ratingCount = Places::where('id' , $placeId)->whereHas('comment' , function($query) use ($userId){
        //     $query->where('userId' , $userId);
        // })->first();
        // // $ratingCount = Places::where('id' , $placeId)->with('comment')->get();
            $user = User::where('id' , $userId)->first();
            $result =  $user->makeComment()->attach($placeId , 
            [   "content" => $request->content ,
                "rate" => $request->rating,
            ]   );

            if ($result) {
                return  $this->returnSuccessMessage("Added successfully");
            }else{  return  $this->returnError(  400,"Added successfully");}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $user = User::where('id' , Auth::user()->id)->with('makeComment')->first();
        $user = DB::select(' 
        select comments.* ,places.id as placeId , places.placeName , places.details , places.image , regions.name as region
        from comments join places
        on comments.placeId = places.id 
        and places.categoryId = regions.id
        where userId = ?' , [ Auth::user()->id]);
        if ($user) {
            return $this->returnData('comment' , $user);
        }else{
            return $this->returnError('400' , "Something went error");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'commentId' => 'string|required',
            'content' => 'required|string' , 
            'rating' => 'required|integer'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        // ----------------------------

        if (!Auth::check()) {
            return $this->returnError(404 , 'Not Authenticated');
        }
        $comment = DB::select("select * from comments where id = ?" , [$request->commentId]);
        
        $result = DB::update('update comments set content = ? , rate = ? where id = ? ' , [
        $request->content,
        $request->rating,
        $request->commentId,
        ]);

        if ($result) {
            return  $this->returnSuccessMessage("updated successfully");
        }else{
            return  $this->returnError('400',"Something went error");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'commentId' => 'string|required',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        // ----------------------------
        $result = DB::delete('dELETE FROM Customers WHERE CustomerName=?' , [ $request->commentId ]);
    
            if ($result) {
                return  $this->returnSuccessMessage("Deleted successfully");
            }else{
                return  $this->returnError('400',"Something went error");
            }
    }
}
