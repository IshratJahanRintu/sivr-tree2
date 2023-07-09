<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    function index()
    {
        $nodes = Node::with('children')->whereNull('parent_id')->get();

        return view('layout.app', compact('nodes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     */
    public function store(Request $request)
    {

        Node::query()->create([
            'title' => $request->title,
            'parent_id' => $request->parent_id,

        ]);
        return redirect(route('nodes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(Request $request)
    {

    }


    public function update(Request $request, Node $node)
    {

        $updated = $node->update([
            'title' => $request->edit_title??$node->title,

        ]);
        if ($updated) {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Node $node)
    {
        $node->forceDelete();
    }
}







