<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';

    protected $fillable = [
        'name', 'street', 'code',
        'city', 'phone', 'email'
    ];

    public function collaborators()
    {
        return $this->hasMany('App\Models\Collaborator');
    }
}
