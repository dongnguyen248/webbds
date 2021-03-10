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
        $type = Type::latest()->with('category')->paginate(20);
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
    
    public function show($id)
    {
        //
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
        $request['slug'] = Str::slug($request['name'], '-');
        $photoName = $request['name'].'.'.$request->file('image')->extension();
        $request->file('image')->move(public_path('images/types'),$photoName);
        Type::findOrFail($id)->update($request->all());
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
