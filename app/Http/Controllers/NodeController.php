<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;
class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {   // Se obtiene la información de la base de datos en array
        $dbNodesCollection=Node::with('children')->get();

        $rootCollection = $this->getChildenCollections($dbNodesCollection, 0)->first();

        $rootCollection->children = $this->searchChilden($rootCollection->children, $dbNodesCollection);
        return view ('welcome', compact('rootCollection'));
    }

    public function searchChilden($rootCollection, $collectionToSearch){
        foreach ($rootCollection as $childCollection) {
            $childCollection->children->merge($collectionToSearch->where('parent', $childCollection->id));
            if($childCollection->children->count()>0)
                foreach ($childCollection->children as $value) {
                    $value->children=$this->searchChilden($value->children, $collectionToSearch);
                }
            }
        return $rootCollection;
    }

    public function getChildenCollections($collectionToSearch, $parentID){
        return $collectionToSearch->where('parent', $parentID);
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
        $this->validate($request, [
            'name' => 'required|max:45',
            'id' => 'required',
        ]);
        $newNode= new Node;
        $newNode->name = $request->name;
        $newNode->parent = $request->id;
        $newNode->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rootCollection=Node::where('id', $id)->with('children')->first();
        // $rootCollection->chi = $this->getChildenCollections($dbNodesCollection, $id);

        $rootCollection->children = $this->searchChilden($rootCollection->children, $rootCollection);
        return view ('welcome', compact('rootCollection'));
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
    }
}
