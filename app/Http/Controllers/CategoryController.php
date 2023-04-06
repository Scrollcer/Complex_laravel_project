<?php

namespace App\Http\Controllers;

use App\Game;
use App\Models\Categories;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\AbstractList;

class CategoryController extends Controller

{

    function editPage()
    {
        $category = Categories::find(request()->id);
        return view('pages.category_edit', ['tableData' => $category]);

    }

    function edit()
    {
        $category = Categories::find(request()->id);
        $category->name = request()->name;
        $category->description = request()->description;
        $category->save();
        return redirect('/');
    }

    function index()
    {
        $games = Game::query()->get();
        return view('pages.categories', ['games' => $games]);
    }

    function addPage()
    {
        return view('pages.category_add');
    }

    public function add(Request $request)
    {
        $category = new Categories();
        $category->name = request()->name;
        $category->description = request()->description;
        $category->save();
        return redirect('/');
    }


    function delete()
    {
        Categories::destroy(request()->id);
        return redirect('/');
    }
}
