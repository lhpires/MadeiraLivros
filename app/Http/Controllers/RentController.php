<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRentRequest;
use App\Models\Book;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;
use \Inertia\Inertia;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Dá para melhorar a querie para consulta
        $rents = Rent::query()->with(['user','book'])->get();

        // echo "<pre>";
        // var_dump(json_encode($rents,JSON_PRETTY_PRINT));
        // echo "<pre>";

        return Inertia::render('RentsPage',[
            "rents" => $rents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $books = Book::query()->get();
        $users = User::query()->get();

        return Inertia::render('CreateRentsPage',[
            "books" => $books,
            "users" => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRentRequest $request)
    {
        $validated = $request->validated();

        $rent = new Rent();
 
       
        $rent->user_id = $validated['user'];
        $rent->book_id = $validated['book'];
        $rent->dt_rent_start = $validated['dt_ini'];
        $rent->dt_rent_end = $validated['dt_end'];
        $rent->save();
 
        return redirect()->route('rents.create')->with('success',"Aluguel cadastrado com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show(Rent $rent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rent $rent)
    {
        $rentRelations = Rent::query()->with(['book','user'])->findOrFail($rent->id);
        $books = Book::query()->get();
        $users = User::query()->get();


        return Inertia::render('RentEditPage',[
            "rent" => $rentRelations,
            "books" => $books,
            "users" => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRentRequest $request, Rent $rent)
    {
        $validated = $request->validated();


        $rent->user_id = $validated['user'];
        $rent->book_id = $validated['book'];
        $rent->dt_rent_start = $validated['dt_ini'];
        $rent->dt_rent_end = $validated['dt_end'];
        $rent->save(); 

        return redirect()->route('rents.edit',[$rent->id])->with('success','Alugúel Editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rent $rent)
    {
        $rent->delete();
        return redirect()->route('rents.index');
    }
}
