<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
   
    public function index()
    {
        $authors = Author::all(); 
        return view('author.index', compact('authors'));
    }

    public function create()
    {
        return view('author.create');
    }

    public function store(Request $request)
    {
        $request->validate([ 
            'name' => 'required', 
        ]); 

        Author::create($request->all()); 
        return redirect()->route('authors.index');
    }

    public function show(author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(author $author)
    {
        return view('author.edit', compact('author')); 
    }

    public function update(Request $request, author $author)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $author->update($request->all()); 
        return redirect()->route('authors.index');                  
    }

    public function destroy(author $author)
    {
        $author->delete();
        return redirect()->route('authors.index');
    }
}
