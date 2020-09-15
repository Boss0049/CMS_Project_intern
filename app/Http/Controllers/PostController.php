<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Article;
use App\Http\Resources\Post as PostResource;
use Session;
use Cookie;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.test.cms',[
            'posts' => Post::all() 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    		$post = new Post ;

        	$post->title = "";
        	$post->keywords = "";
	        $post->description = "";
	        $post->content = "";
	        $post->datetime = "";
	       	$post->articleid = 1;

    	if($post->save()) {
            return new PostResource($post);
        }
    		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$post = Post::findOrFail($id);
    	return response()->json($post, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
    		$this->validate($request, [
    			'title' => 'required',
    			'keywords' => 'required',
    			'description' => 'required',
    			'content' => 'required',
    			'datetime' => 'required',
    			'articleid' => 'required'
    		]);

    		if($request->articleid == 'รีไฟแนนซ์'){
		        $request->articleid = 1;
		      }
		    else if($request->articleid == 'สินเชื่อบ้านแลกเงิน'){
		        $request->articleid = 2;
		      }
			else if($request->articleid == 'สินเชื่อบ้านใหม่'){
		        $request->articleid = 3;
		      }
		    else if($request->articleid == 'ความรู้ด้านการเงิน'){
		        $request->articleid = 4;
		      }
        	$post = Post::findOrFail($id) ;
        	$post->title = $request->title;
        	$post->keywords = $request->keywords;
	        $post->description = $request->description;
	        $post->content = $request->content;
	        $post->datetime = $request->datetime;
	        $post->cover = $this->saveImg($request);
	        $post->articleid = $request->articleid;

	        if($post->update()) {
            return new PostResource($post);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if($post->delete()) {
            return json_encode(true);
        }    
    }

    public function getAll()
    {   
        return $posts = Post::all();
    }
    
    public function testedit()
    {
    	return view('layouts.test.edit');
    }

    public function updatestatus(Request $request,$id)
    {
    	$post = Post::findOrFail($id) ;
    	$post->status = $request->status;

    	if($post->save()) {
            return new PostResource($post);
        }
    }

    public function saveEdit(Request $request) {
       $img = $request->file('image');
        

       $exploded = explode(",",$img);
       
       // remove extra parts
       // extention
       if(str_contains($exploded[0], 'gif')) {
        $ext = 'gif';
       }else if(str_contains($exploded[0], 'png')) {
        $ext = 'png';
       }else{
        $ext = 'jpg';
       }
      

       $filename = str_random() . "." . $ext ;
       // path of your local folder
       $path = public_path() . "/img_editor/";

       $img->move($path, $filename);
       return ( "/img_editor/" . $filename);
    } 

    // for cover
    public function saveImg(Request $request) 
    {

       $cov = $request->get('cover');

       // remove extra parts
       $exploded = explode(",",$cov);
       
       // extention
       if(str_contains($exploded[0], 'gif')) {
        $ext = 'gif';
       }else if(str_contains($exploded[0], 'png')) {
        $ext = 'png';
       }else{
        $ext = 'jpg';
       }

       // decode 
       $decode = base64_decode(substr($cov, strpos($cov, ",")+1));

       $filename = str_random() . "." . $ext ;

       // path of your local folder
       $path = public_path() . "/img/" . $filename;
        // $article = new Post;
        // $article->image = $path;      
        // $article->save();

       if(file_put_contents($path, $decode)) {
            return "/img/" . $filename;
       }else return "";
    }

    public function autosave(Request $request,$id)
    {
    	
        	$post = Post::findOrFail($id);
        	if($request->input('title') != null){
    			$post->title = $request->input('title'); 
    		}
    		else $post->title = "";

    		if($request->input('keywords') != null){
    			$post->keywords = $request->input('keywords'); 
    		}
    		else $post->keywords = "";

    		if($request->input('description') != null){
    			$post->description = $request->input('description'); 
    		}
    		else $post->description = "";

    		if($request->input('content') != null){
    			$post->content = $request->input('content'); 
    		}
    		else $post->content = "";

    		if($request->input('datetime') != null){
    			$post->datetime = $request->input('datetime'); 
    		}
    		else $post->datetime = "";
     
	        $post->cover = $this->saveImg($request);
	        $post->status = "record";
	       	
	       	if($post->save())
	       	{
            return new PostResource($post);
        }
        
    }

    public function lastid($id)
    {
    	$post = Post::orderBy('id', 'DESC')->first();
    	return response()->json($post, 200);
    }
}
