<?php

namespace App\Http\Controllers\Api;

use App\CarouselBlock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarouselBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CarouselBlock::query();
        if ($request->has('sort')) {
            collect($request->sort)->flatMap(function ($item) use ($query) {
                $value = json_decode($item);
                $query->orderBy($value[0], $value[1]);
            });
        }
        return $query->with('images')->paginate($request->per_page ? intval($request->per_page) : 15);
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
        $carouselBlock = CarouselBlock::create($request->all());
        if ($request->has('images')) {
            $carouselBlock->images()->sync($request->input('images'));
        }
        if ($request->has('pages')) {
            $carouselBlock->pages()->sync($request->input('pages'));
        }
        return $carouselBlock->load('images');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarouselBlock  $carouselBlock
     * @return \Illuminate\Http\Response
     */
    public function show(CarouselBlock $carouselBlock)
    {
        return $carouselBlock->load('images');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarouselBlock  $carouselBlock
     * @return \Illuminate\Http\Response
     */
    public function edit(CarouselBlock $carouselBlock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarouselBlock  $carouselBlock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarouselBlock $carouselBlock)
    {
        $carouselBlock->update($request->all());
        if ($request->has('images')) {
            $carouselBlock->images()->sync($request->input('images'));
        }
        if ($request->has('pages')) {
            $carouselBlock->pages()->sync($request->input('pages'));
        }
        return $carouselBlock->load('images');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarouselBlock  $carouselBlock
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarouselBlock $carouselBlock)
    {
        $carouselBlock->delete();
        return;
    }
}
