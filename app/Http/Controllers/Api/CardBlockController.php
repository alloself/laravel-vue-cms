<?php

namespace App\Http\Controllers\Api;

use App\CardBlock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CardBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CardBlock::query();
        if ($request->has('sort')) {
            collect($request->sort)->flatMap(function ($item) use ($query) {
                $value = json_decode($item);
                $query->orderBy($value[0], $value[1]);
            });
        }
        return $query->with('images', 'link', 'pages')->paginate($request->per_page ? intval($request->per_page) : 15);
    }

    public function all()
    {
        return CardBlock::with('images', 'link', 'pages')->get();
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
        $cardBlock = CardBlock::create($request->all());
        if ($request->has('images')) {
            $cardBlock->images()->sync($request->input('images'));
        }
        if ($request->has('link')) {
            $cardBlock->link()->sync($request->input('link'));
        }
        if ($request->has('pages')) {
            $cardBlock->pages()->sync($request->input('pages'));
        }
        return $cardBlock->load('pages', 'images', 'link');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CardBlock  $cardBlock
     * @return \Illuminate\Http\Response
     */
    public function show(CardBlock $cardBlock)
    {
        return $cardBlock->load('pages', 'images', 'link');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CardBlock  $cardBlock
     * @return \Illuminate\Http\Response
     */
    public function edit(CardBlock $cardBlock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CardBlock  $cardBlock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CardBlock $cardBlock)
    {
        $cardBlock->update($request->all());
        if ($request->has('pages')) {
            $cardBlock->pages()->sync($request->input('pages'));
        }
        if ($request->has('images')) {
            $cardBlock->images()->sync($request->input('images'));
        }
        if ($request->has('link')) {
            $cardBlock->link()->sync($request->input('link'));
        }
        return $cardBlock->load('pages', 'images', 'link');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CardBlock  $cardBlock
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardBlock $cardBlock)
    {
        $cardBlock->delete();
        return;
    }
}
