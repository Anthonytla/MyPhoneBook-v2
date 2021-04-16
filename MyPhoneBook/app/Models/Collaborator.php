<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;
    protected $table = 'collaborators';
    protected $fillable = [
        'civility', 'lastname', 'firstname',
        'col_street', 'col_code', 'col_city',
        'col_phone', 'col_email', 'company_id'
    ];
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
