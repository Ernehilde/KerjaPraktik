<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index() : View
    {
        $items = Items::oldest()->paginate(10);
        return view("items.items", compact('items'));
    }

    public function create(): View
    {
        return view('items.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name'=> 'required|string',
            'type'=>'required|string',
            'price'=>'required|numeric',
        ]);

        Items::create([
            'name'=> $request->name,
            'type'=> $request->type,
            'price'=> $request->price
        ]);
        return redirect()->route('dashboard')->with(['success'=> 'Data Berhasil Dimasukkan']);
    }

}
