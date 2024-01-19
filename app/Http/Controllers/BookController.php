<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\Rent;
use Illuminate\Http\Request;
use \Inertia\Inertia;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();

        return Inertia::render('BooksPage',[
            "books" => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CreateBooksPage');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();

        $book = new Book();
 
        $book->name = $validated['name'];
        $book->save();
 
        return redirect()->route('books.create')->with('success',"Livro cadastrado com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
      // Futuras melhorias ;)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return Inertia::render('BooksEditPage',[
            "book" => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, Book $book)
    {
        $validated = $request->validated();

        $book->name = $validated['name'];
        $book->save();

        return redirect()->route('books.edit',[$book->id])->with('success','Livro Editado com sucesso');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {

        // VERIFICAR SE HÁ ALUGUÉIS PENDENTES DESSE LIVRO
        $pending_rents = Rent::query()->where('book_id',$book->id)->whereBetween('dt_rent_end', [now(), now()->addDays(30)])
        ->count();

        if($pending_rents > 0){
            return redirect()->route('books.index')->withErrors([
                "err" => "Livro possui aluguéis pendentes"
            ]);

        }
        
        $book->delete();
        return redirect()->route('books.index');
    }
}
