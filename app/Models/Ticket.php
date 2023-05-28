<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);//user() method uses the belongsTo() method to create a relationship between the Ticket and User models.
    }
}
//a Ticket model can be associated with a User model by the user_id column on the User model.
