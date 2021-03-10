<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articel;
use Illuminate\Support\Str;

class ArticelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $perPage = $request->get('perPage', 8);
        $sortCol = $request->get('sortCol', 'updated_at');
        $sortType = $request->get('sortType', 'desc');
        $type = $request->get('type', 'all');
        $key = $request->get('keySearch', '');
        $articles = Articel::where(function ($query) use ($type) {
            $query->whereRaw("'all' = '" . $type . "'")
                ->orWhere('type_id', $type);
        })
            ->where(function ($query) use ($key) {
                $query->where('title', 'like', '%' . $key . '%')
                    ->orWhere('content', 'like', '%' . $key . '%');
            })
            ->orderBy($sortCol, $sortType)
            ->with('type', 'author')
            ->paginate($perPage);
        $allArticles = Articel::all();
        return response()->json(['articles'=>$articles,'allarticle'=>$allArticles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRecentPost($num)
    {
        $recentArticles = Articel::orderBy('created_at','desc')->with('category')->take($num)->get();
        return response()->json($recentArticles); 
    }
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
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        $user_id = auth('api')->user()->id;
        $fileName = '';
        if($request->file('image')){
            $fileName = $request->file('image')->store('','public');
            $request->file('image')->move(public_path('images/article/'),$fileName);
        }
        Articel::create([
            'title'=> $request['title'],
            'content'=> $request['content'] ,
            'user_id'=> $user_id,
            'type_id'=> $request['type_id'],
            'photo'=> $fileName,
            'slug' =>Str::slug($request['title'], '-').'-'.now()->timestamp
        ]);
        return response()->json('Created success Article ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $article= Articel::where($id)->get()->load('type');
        return response()->json($article);
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
        $this->validate($request,[
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        $article = Articel::findOrFail($id);
        $fileName = $article->photo;
        if($request->file('image') && $fileName!= $request->photo){
            $fileName = $request->file('image')->store('','public');
            $request->file('image')->move(public_path('images/article/'),$fileName);
        }
        if($fileName != $article->photo){
            @unlink(public_path('images/article/').$article->photo);
        }

        if($article->title != $request['title']) // if change title, update slug
            $article->slug = Str::slug($request['title'], '-') .'-'. now()->timestamp;

        $article['title']=$request['title'];
        $article['content']= $request['content'] ;
        $article['type_id']= $request['type_id'];
        $article['photo']= $fileName;
        
        $article->save();
        return ['message' => 'Updated success Article'];
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
        $article= Articel::findOrFail($id);
        $photo = public_path('images/article/').$article->photo;
        @unlink($photo);
        $article->delete();
        return ['message' => 'Article deleted'];
    }
}
