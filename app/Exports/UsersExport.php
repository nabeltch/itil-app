<?php

namespace App\Exports;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Purchase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;


class UsersExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'ITEM',
            'CODIGO',
            'FECHA DE CREACIÓN',
            'CLIENTE',
            'PRODUCTO ADQUIRIDO',
            'DESCRIPCIÓN DEL PROBLEMA',
            'INGENIERO DE SOPORTE TI',
            'ACCIONES REALIZADAS',
            'RESULTADOS',
            'FECHA INICIAL DE SOPORTE',
            'FECHA FINAL DE SOPORTE',
            'ESTADO'
        ];
    }



    public function array(): array
    {
        $tickets=Ticket::all();

        $tickets_export=[];

        $state_data=['Publicado','Cancelado','En proceso','Solucionado'];
        foreach ($tickets as $key => $value) {
            $ticket=[
            'Item'=>$key+1,
            'code'=>$value->code,
            'created_at'=>$value->created_at,
            'id_client'=>$value->client->name,
            'id_purchase'=>Purchase::find($value->id_purchase)->product->name,
            'client_problem'=>$value->client_problem,
            'id_support'=>!$value->id_support=='' ? $value->support->name : '',
            'actions_taken'=>$value->actions_taken,
            'results'=>$value->results,
            'start_time_support'=>$value->start_time_support,
            'end_time_support'=>$value->end_time_support,
            'state'=>$state_data[$value->state-1]
            ];
            array_push($tickets_export,$ticket);
        }
        
        return [$tickets_export]; 
    }

   
}
