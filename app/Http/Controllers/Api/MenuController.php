<?php

namespace App\Http\Controllers\Api;

use App\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Menu::query();
        if ($request->has('sort')) {
            collect($request->sort)->flatMap(function ($item) use ($query) {
                $value = json_decode($item);
                $query->orderBy($value[0], $value[1]);
            });
        }
        return $query->with('link')->paginate($request->per_page ? intval($request->per_page) : 15);
    }

    public function all()
    {
        return Menu::with('link')->get();
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
        $menu = Menu::create($request->all());
        if ($request->has('link')) {
            $menu->link()->sync($request->input('link'));
        }
        return $menu;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return $menu->load('children', 'link');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->update($request->all());
        if ($request->has('link')) {
            $menu->link()->sync($request->input('link'));
        }
        return $menu->load('children', 'link');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return;
    }
}
