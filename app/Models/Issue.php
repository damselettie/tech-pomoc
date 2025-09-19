<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Issue extends Model
{
    protected $fillable = [
        'title',
        'description',
        'room_number',
        'computer_number',
        'reporter_name',
        'status',
        'recipients',
    ];
  

    public function recipients(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'issue_user', 'issue_id', 'user_id');
    }
}
