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
    public function dashboard()
    {
        if (auth()->user()->type=="client") {
            $collection = collect([
                ['total' => count(Ticket::where('id_client', auth()->user()->id)->get())],
                ['t_slope' => count(Ticket::where([['state', 1], ['id_client', auth()->user()->id]])->get())],
                ['t_canceled' => count(Ticket::where([['state', 2], ['id_client', auth()->user()->id]])->get())],
                ['t_progress' => count(Ticket::where([['state', 3], ['id_client', auth()->user()->id]])->get())],
                ['t_solved' => count(Ticket::where([['state', 4], ['id_client', auth()->user()->id]])->get())]  
            ]);
        }else{
            $collection = collect([
                ['total' => count(Ticket::all())],
                ['t_slope' => count(Ticket::where('state', 1)->get())],
                ['t_canceled' => count(Ticket::where('state', 2)->get())],
                ['t_progress' => count(Ticket::where('state', 3)->get())],
                ['t_solved' => count(Ticket::where('state', 4)->get())]
            ]);

        }
        $data='admin';
        return view('dashboard', compact('collection'));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->type=="client"){
            $tickets = Ticket::where('id_client',auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
        }else{
            $tickets = Ticket::orderBy('created_at', 'desc')->paginate(5);
        }
        


        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $id_purchase= Ticket::where('id_purchase',$id)->get();
        if (!empty($id_purchase[0])) {
            return redirect()->route('client.tickets.show',$id_purchase[0]->id);
        }else{
            $ticket = new Ticket();
            return view('ticket.create', compact('ticket'));
        }
        
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
        $id=Ticket::select("id")->latest()->first();
        $ticket = Ticket::create([
            'code' => 'T000'.Ticket::select("id")->latest()->first()->id+1,
            'id_client'=>$request['id_client'],
            'id_purchase'=>$request['id_purchase'],
            'client_problem'=>$request['client_problem'],
            'state'=>$request['state']
        ]);

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
        if ($support->start_time_support==""){
            $support->start_time_support = $current_date_time;

        }
       
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
