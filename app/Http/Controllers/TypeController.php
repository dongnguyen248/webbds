<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Str;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = Type::latest()->with('category')->paginate(6);
        // dd($type);
        $allTypes = Type::with('category')->get();
        return response()->json(['type'=>$type,'alltype'=>$allTypes]);
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
    public function store(Request $request)
    {
        // 'name'=> $request['name'],
         $photoName = $request['name'].'.'.$request->file('image')->extension();
         $request->file('image')->move(public_path('images/types'),$photoName);
        //  dd($photoName);
        Type::create([
            'name'=> $request['name'],
            'photo'=> $photoName,
            'category_id'=> $request['category_id'],
            'slug' =>Str::slug($request['name'], '-')
        ]);
        return response()->json('Created success ProductType ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($slug)
    {
        $typelfilter = Type::where('slug','=',$slug)->with('article')->get();
        // dd($typelfilter);
        return response()->json(['typefil'=>$typelfilter]);
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
        $type =  Type::findOrFail($id);
      if($request->file('image') != null){
        $type->name= $request['name'];
        $photoName = $request['name'].'.'.$request->file('image')->extension();
        $type->photo= $photoName;
        $type->category_id =$request['category_id'];
        $type->slug = $request['slug'] = Str::slug($request['name'], '-');
        @unlink(public_path('images/types').$type->photo);
        $type->save();

      }else{
        $type->name= $request['name'];
        $type->category_id =$request['category_id'];
        $type->slug = $request['slug'] = Str::slug($request['name'], '-');
        $type->save();


      };
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
        Type::findOrFail($id)->delete();
        return ['message' => 'Category deleted'];
    }
}
