<?php

namespace App\Http\Controllers\Api;

use App\WysiwygBlock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WysiwygBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = WysiwygBlock::query();
        if ($request->has('sort')) {
            collect($request->sort)->flatMap(function ($item) use ($query) {
                $value = json_decode($item);
                $query->orderBy($value[0], $value[1]);
            });
        }
        return $query->with('pages')->paginate($request->per_page ? intval($request->per_page) : 15);
    }

    public function all()
    {
        return WysiwygBlock::with('pages')->get();
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
        $textBlock = WysiwygBlock::create($request->all());
        if ($request->has('pages')) {
            $textBlock->pages()->sync($request->input('pages'));
        }
        return $textBlock->load('pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WysiwygBlock  $wysiwygBlock
     * @return \Illuminate\Http\Response
     */
    public function show(WysiwygBlock $wysiwygBlock)
    {
        return $wysiwygBlock->load('pages');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WysiwygBlock  $wysiwygBlock
     * @return \Illuminate\Http\Response
     */
    public function edit(WysiwygBlock $wysiwygBlock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WysiwygBlock  $wysiwygBlock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WysiwygBlock $wysiwygBlock)
    {
        $wysiwygBlock->update($request->all());
        if ($request->has('pages')) {
            $wysiwygBlock->pages()->sync($request->input('pages'));
        }
        return $wysiwygBlock->load('pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WysiwygBlock  $wysiwygBlock
     * @return \Illuminate\Http\Response
     */
    public function destroy(WysiwygBlock $wysiwygBlock)
    {
        $wysiwygBlock->delete();
        return;
    }
}
