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
        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(author $author)
    {
        //
    }
}
