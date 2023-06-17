<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Product;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;


/**
 * Class TicketController
 * @package App\Http\Controllers
 */
class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::paginate();


        return view('ticket.index', compact('tickets'))
            ->with('i', (request()->input('page', 1) - 1) * $tickets->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticket = new Ticket();
        return view('ticket.create', compact('ticket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ticket::$rules);

        $ticket = Ticket::create($request->all());

        return redirect()->route('client.tickets')
            ->with('success', 'Se creó exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
          $product_name=Purchase::find($ticket->id_purchase)->product->name;
        //$product_name=Product::find($ticket->id_product)->name;

        return view('ticket.show', compact(['ticket','product_name']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);

        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        request()->validate(Ticket::$rules);

        $ticket->update($request->all());

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket updated successfully');
    }

    public function add_support(Request $request, Ticket $ticket)

    {
        // request()->validate(Ticket::$rules);
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
        $support = Ticket::find($request->input('id_ticket'));
        $support->state = $request->input('select');
        $support->actions_taken = $request->input('actions');
        $support->results = $request->input('results');
        $support->id_support = $request->input('id_support');
        $support->start_time_support = $current_date_time;
        if ($request->input('select')==4){
            $support->end_time_support = $current_date_time;
        }
        
       

        $support->update();
        // return redirect()->back()->with('status','Student Updated Successfully');

        // $ticket->update($request->all());

        return redirect()->route('support.tickets.show',$request->input('id_ticket'))
            ->with('success', 'Se cambió de estado exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id)->delete();

        return redirect()->route('client.tickets')
            ->with('success', 'Se eliminó exitosamente');
    }
}
