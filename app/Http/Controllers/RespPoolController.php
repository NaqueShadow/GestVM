<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RespPoolController extends Controller
{

    public function index()
    {
        return view('respPool/respPool');
    }

    public function requetes()
    {

        return view('respPool/requetes');
    }

    public function historique()
    {

        return view('respPool/historique');
    }

    //===================================

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
