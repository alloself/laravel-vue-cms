<?php

namespace App\Http\Controllers\Api;

use App\TextBlock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TextBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TextBlock::query();
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
        return TextBlock::with('pages')->get();
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
        $textBlock = TextBlock::create($request->all());
        if ($request->has('pages')) {
            $textBlock->pages()->sync($request->input('pages'));
        }
        if ($request->has('images')) {
            $textBlock->images()->sync($request->input('images'));
        }
        return $textBlock->load('pages', 'images');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TextBlock  $textBlock
     * @return \Illuminate\Http\Response
     */
    public function show(TextBlock $textBlock)
    {
        return $textBlock->load('pages', 'images');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TextBlock  $textBlock
     * @return \Illuminate\Http\Response
     */
    public function edit(TextBlock $textBlock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TextBlock  $textBlock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TextBlock $textBlock)
    {
        $textBlock->update($request->all());
        if ($request->has('pages')) {
            $textBlock->pages()->sync($request->input('pages'));
        }
        if ($request->has('images')) {
            $textBlock->images()->sync($request->input('images'));
        }
        return $textBlock->load('pages', 'images');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TextBlock  $textBlock
     * @return \Illuminate\Http\Response
     */
    public function destroy(TextBlock $textBlock)
    {
        $textBlock->delete();
        return;
    }
}
