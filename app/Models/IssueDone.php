<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueDone extends Issue
{
    // Określamy, że ten model będzie korzystał z tej samej tabeli 'issues'
    protected $table = 'issues';

    // Możemy dodać dowolne dodatkowe właściwości, jeśli są wymagane
    protected $fillable = ['title', 'description', 'status', 'created_at', 'updated_at'];

    // Możemy również dodać niestandardowy scope, jeżeli potrzebujemy bardziej zaawansowanego filtrowania.
    public static function scopeDone($query)
    {
        return $query->where('status', 'done');
    }
}
