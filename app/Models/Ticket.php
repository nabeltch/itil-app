<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 *
 * @property $id
 * @property $code
 * @property $id_client
 * @property $id_support
 * @property $id_purchase
 * @property $client_problem
 * @property $state
 * @property $created_at
 * @property $updated_at
 *
 * @property Purchase $purchase
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ticket extends Model
{
    
    static $rules = [
		'client_problem' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code','id_client','id_support','id_purchase','client_problem','state','reaperture'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function purchase()
    {
        return $this->hasOne('App\Models\Purchase', 'id', 'id_purchase');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_client');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function support()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_support');
    }
    
    

}
