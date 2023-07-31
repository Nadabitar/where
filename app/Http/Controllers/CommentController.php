<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStore;
use App\Models\Comment;
use App\Models\Places;
use App\Models\Service;
use App\Models\User;
use App\Traits\GenralTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Double;

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
            $user = User::where('id' , $userId)->first();
            $result =  $user->makeComment()->attach($placeId , 
            [   
                "content" => $request->content ,
                "rate" => $request->rating,
            ]);
            $this->calculateRating( $placeId);
            if (!$result) {
                return  $this->returnSuccessMessage("Added successfully");
            }else{  return  $this->returnError(400,"Some thing went error");}
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
        select places.placeName , places.details , places.image , places.rate  ,comments.* 
        from places 
        JOIN comments on  places.id = comments.placeId 
        where comments.userId = ?' , [ Auth::user()->id]);
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
        $result = DB::delete('delete from comments where id=?' , [ $request->commentId ]);
    
            if ($result) {
                return  $this->returnSuccessMessage("Deleted successfully");
            }else{
                return  $this->returnError('400',"Something went error");
            }
    }

    public function calculateRating($id){

        $place = Places::find($id);
        
        $rating = DB::select("select SUM(comments.rate) / COUNT(comments.userId) as rate FROM comments where comments.placeId = ?" , [$id]);
        $place->rate = doubleval($rating[0]->rate);
        $place->update();

        
    }

    function getCommetsForPlaces($id) {
        $comments = Places::with('comment')->where('id' ,$id)->latest()->first();
        // dd( $comments );
        $promo =Service::where(['placeId'=> $id , 'isPromo' => true ])->latest()->get();
        $place = Places::where('accountId' , Auth::user()->id)->first();
        return view('subscriber.pages.AllComments' , compact('comments'))->with([
            'place' => $place ,
            'promo'=> $promo,
            'comments' => $comments->comment,
        ]);;
    }

    function searchCommentsByName(Request $request) {
        $validation = Validator::make($request->all() , [
            'name' => 'sometimes',
            'date' => 'sometimes' , 
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        // ----------------------------


        $place = Places::where('accountId' , Auth::user()->id)->first();
        $comments = Places::whereHas('comment')->where('id' ,$place->id)->latest()->first();
        $promo =Service::where(['placeId'=>$place->id , 'isPromo' => true ])->latest()->get();
        if ($request->name && $request->date) {
            $comments= $comments->comment->where('created_at' ,'>=' , $request->date)->where('fullName' , $request->name);
        } else if($request->name) {
            $comments= $comments->comment->where('created_at' ,'>=' , $request->date);
        }else if($request->date) {
            $comments= $comments->comment->where('fullName' , $request->name);
        }


        //  dd($comments);
        return view('subscriber.pages.AllComments',compact('comments' , 'place' , 'promo'));
    }

}
