<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;//post model or post class
use App\Category;
use Illuminate\Support\Facades\Auth;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    public function index()
    {
        //
        $posts=Post::orderby('title','desc')->get();//retrieve data
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        //dd($categories);
        return view('post.create',compact('categories'));

        
           }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request);
        $request->validate(['title'=>'required|min:5',
                        'contact'=>'required|min:10',
                        'photo'=>'required|mimes:jpeg,png',
                        'category'=>'required'
                    ]);

        //file upload

        if($request->hasfile('photo'))
        {
            $photo=$request->file('photo');
            //$name=$photo->getClientOriginalName();
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/image/',$name);
            $photo='/storage/image/'.$name;
        }
        else
        {
            $photo='';
        }
        //data insert'photo' => 'mimes:jpeg,bmp,png'
            $post=new Post();//create obj
            $post->title=request('title');
            $post->body=request('contact');
            $post->image=$photo;
          
            $post->category_id= request('category');
            $post->user_id=Auth::id();

            //$post->status=true;
            $post->save();

            //Redirect
            return redirect()->route('firstPage');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post=Post::find($id);
        //$post=Post::where('status',1)->first();
        return view('post.detail',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post=Post::find($id);//carry old data
        $categories=Category::all();//for form loop
        return view('post.edit',compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
       // dd($request);
         $request->validate(['title'=>'required|min:5',
                        'contact'=>'required|min:10',
                        'photo'=>'sometimes|required|mimes:jpeg,png',
                        'category'=>'required'
                    ]);

        //file upload

        if($request->hasfile('photo'))
        {
            $photo=$request->file('photo');
            //$name=$photo->getClientOriginalName();
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/image/',$name);
            $photo='/storage/image/'.$name;
        }
        else
        {
            $photo=request('oldphoto');
        }
        //data update
            $post=Post::find($id);//update 
            $post->title=request('title');
            $post->body=request('contact');
            $post->image=$photo;
          
            $post->category_id= request('category');
            $post->user_id=1;
            //$post->status=true;
            $post->save();

            //Redirect
            return redirect()->route('firstPage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=Post::find($id);
        $post->delete();
        //redirect
        return redirect()->route('firstPage');
    }
}
