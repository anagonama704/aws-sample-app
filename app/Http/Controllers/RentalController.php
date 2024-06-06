<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\RentalRequest;

use Session;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize(Rental::class);
        $rentals = \Auth::user()->isAdmin() ? Rental::query() : Rental::where('user_id', '=', \Auth::user()->id);
        $rentals = $rentals->orderBy('id', 'desc')->paginate(15);
        return view('rentals.index', ['rentals' => $rentals]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RentalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->authorize(Rental::class);
        // Rental::create($request->all());
        $carts = Cart::select('user_id', 'book_id')->where('user_id', \Auth::user()->id)->get();

        $rentals = $carts->toArray();
        foreach ($rentals as $key => $rental) {
            $rentals[$key] += array('created_at' => date('Y/m/d'));
            $rentals[$key] += array('updated_at' => date('Y/m/d'));
        }
        if (Rental::insert($rentals)) {
            Cart::where('user_id', \Auth::user()->id)->delete();
        };
        return redirect(route('rentals.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function show(Rental $rental)
    {
        $this->authorize($rental);
        return view('rentals.show', ['rental' => $rental]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function edit(Rental $rental)
    {
        //
        $this->authorize($rental);
        return view('rentals.edit', ['rental' => $rental]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RentalRequest  $request
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rental $rental)
    {
        //
        $this->authorize($rental);
        $rental->update($request->all());
        return redirect(route('rentals.show', $rental));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rental $rental)
    {
        //
        $this->authorize($rental);
        $rental->delete();
        return redirect(route('rentals.index'));
    }

    public function return(Rental $rental)
    {
        $rental->return_date = date_format(now(), 'Y-m-d');
        $rental->save();

        return redirect(route('rentals.index'));
    }
}
