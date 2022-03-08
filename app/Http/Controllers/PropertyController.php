<?php

namespace App\Http\Controllers;

use App\Models\Property;



class PropertyController extends Controller
{
    public function Index()
    {
        return view('Property', [
            'title' => 'hello moto',
            'content' => "je suis un test",
        ]);
    }

    public function All()
    {
        $properties = response()
            ->json(Property::all());
        return $properties;
    }

    public function Get($id)
    {
        return $id;
    }
}
