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
        if (auth()->user()->type == "client") {
            $collection = collect([
                ['total' => count(Ticket::where('id_client', auth()->user()->id)->get())],
                ['t_slope' => count(Ticket::where([['state', 1], ['id_client', auth()->user()->id]])->get())],
                ['t_canceled' => count(Ticket::where([['state', 2], ['id_client', auth()->user()->id]])->get())],
                ['t_progress' => count(Ticket::where([['state', 3], ['id_client', auth()->user()->id]])->get())],
                ['t_solved' => count(Ticket::where([['state', 4], ['id_client', auth()->user()->id]])->get())]
            ]);
        } else if(auth()->user()->type == "support") {
            $collection = collect([
                ['total' => count(Ticket::where('id_support', auth()->user()->id)->get())],
                ['t_slope' => count(Ticket::where([['state', 1], ['id_support', auth()->user()->id]])->get())],
                ['t_canceled' => count(Ticket::where([['state', 2], ['id_support', auth()->user()->id]])->get())],
                ['t_progress' => count(Ticket::where([['state', 3], ['id_support', auth()->user()->id]])->get())],
                ['t_solved' => count(Ticket::where([['state', 4], ['id_support', auth()->user()->id]])->get())]
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
        $data_indicators = self::indicators();
        // if (count(self::indicators()) == 0) {
        //     $data_indicators = 0;
        // } else {
        //     
        // }
        return view('dashboard', compact(['collection','data_indicators']));
        // return dd($data_indicators);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->type == "client") {
            $tickets = Ticket::where('id_client', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
            return view('ticket.index', compact('tickets'));
        } else if(auth()->user()->type == "support") {
            $tickets = Ticket::orderBy('created_at', 'desc')->paginate(5);
            $tickets_support = Ticket::where('id_support', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
            return view('ticket.index', compact(['tickets','tickets_support']));
            
        }else{
            $tickets = Ticket::orderBy('created_at', 'desc')->paginate(5);
            return view('ticket.index', compact('tickets'));
        }
    
        
    }

    public function indicators()
    {

        $tickets = Ticket::where('state', 4)->get();

        if (count($tickets)==0) {
            return 0;

        }else{

            $total_tickets = count($tickets);
            $total_time = 0;
            $quantity_tickets_ans = 0;
            $quantity_tickets_nr = 0;

            foreach ($tickets as $ticket) {

                //indicator 1
                $created_at = new \Carbon\Carbon($ticket->created_at);
                $start_time_support = new \Carbon\Carbon($ticket->start_time_support);
                $total_time_ans =  $created_at->diffInMinutes($start_time_support);
                if ($total_time_ans <= 30) {
                    $quantity_tickets_ans++;
                }

                //indicator 2
                $start_time_support = new \Carbon\Carbon($ticket->start_time_support);
                $end_time_support = new \Carbon\Carbon($ticket->end_time_support);
                $total_time += $start_time_support->diffInMinutes($end_time_support);

                //indicator 3
                if ($ticket->reaperture == 0) {
                    $quantity_tickets_nr++;
                }
            }
            return [
                'indicator1' => [
                    'quantity_tickets_ans' => $quantity_tickets_ans,
                    'quantity_tickets' => $total_tickets,
                    'result' => number_format($quantity_tickets_ans / $total_tickets * 100, 2)
                ],
                'indicator2' => [
                    'total_time' => number_format($total_time, 2),
                    'quantity_tickets' => $total_tickets,
                    'result' => number_format($total_time / $total_tickets * 100, 2),
                ],
                'indicator3' => [
                    'quantity_tickets_nr' => $quantity_tickets_nr,
                    'quantity_tickets' => $total_tickets,
                    'result' => number_format($quantity_tickets_nr / $total_tickets * 100, 2)
                ]
            ];
        
    
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $id_purchase = Ticket::where('id_purchase', $id)->get();
        if (!empty($id_purchase[0])) {
            return redirect()->route('client.tickets.show', $id_purchase[0]->id);
        } else {
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
        $first_ticket=is_null(Ticket::select('id')->latest()->first()) ? 'T0001': 'T000'.Ticket::select('id')->latest()->first()->id+1;
        $ticket = Ticket::create([
            'code' =>  $first_ticket,
            'id_client' => $request['id_client'],
            'id_purchase' => $request['id_purchase'],
            'client_problem' => $request['client_problem'],
            'state' => $request['state'],
            'reaperture' => 0
        ]);

        return redirect()->route('client.tickets')
            ->with('success', 'Se creó exitosamente');
    }

    public function reaperture($id){

        $ticket=Ticket::find($id);
        $ticket->id_support = null;
        $ticket->state = 1;
        $ticket->actions_taken = null;
        $ticket->results = null;
        $ticket->start_time_support = null;
        $ticket->end_time_support = null;
        $ticket->created_at= \Carbon\Carbon::now()->toDateTimeString();
        $ticket->reaperture= 1;

        $ticket->update();

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
        $product_name = Purchase::find($ticket->id_purchase)->product->name;
        //$product_name=Product::find($ticket->id_product)->name;

        return view('ticket.show', compact(['ticket', 'product_name']));
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
        $ticket = Ticket::find($request->input('id_ticket'));
        $ticket->state = $request->input('select');
        $ticket->actions_taken = $request->input('actions');
        $ticket->results = $request->input('results');
        $ticket->id_support = $request->input('id_support');
        if ($ticket->start_time_support == "") {
            $ticket->start_time_support = $current_date_time;
        }

        if ($request->input('select') == 4) {
            $ticket->end_time_support = $current_date_time;
        }



        $ticket->update();
        // return redirect()->back()->with('status','Student Updated Successfully');

        // $ticket->update($request->all());

        return redirect()->route('support.tickets.show', $request->input('id_ticket'))
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
