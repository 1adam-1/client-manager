<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class airlodAvis extends Model
{
    use HasFactory;

    protected $primaryKey = 'generated_id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Find a client by generated_id.
     *
     * @param string $generatedId
     * @return \App\Models\Client|null
     */
    public static function findByGeneratedId($generatedId)
{
    return static::where('generated_id', $generatedId)->first();
}


    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($model) {
            // Generate generated_id if not set
            if ($model->generated_id === null) {
                $lastClientId = static::select('generated_id')
                                     ->orderByRaw('CAST(SUBSTRING_INDEX(generated_id, "ND", -1) AS UNSIGNED) DESC')
                                     ->first();
    
                $nextNumber = $lastClientId !== null ? intval(substr($lastClientId->generated_id, 2)) + 1 : 0;
                $model->generated_id = 'ND' . $nextNumber; 
            }
    
            // Generate facture if not set
            if ($model->facture === null) {
                $lastFacture = static::max('facture'); 
                $nextNumber = $lastFacture !== null ? intval(str_replace('W23/', '', $lastFacture)) + 1 : 0;
                $model->facture = 'W23/' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT); 
            }
        });
    }
    
}
