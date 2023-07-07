<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;
class Reservation extends Model
{
    use HasFactory;

    public function transformDateToCompare()
    {
        $date = $this->date;
        $dateTime = DateTime::createFromFormat('d-m-Y', $date);
    
        return $dateTime->format('d-m-Y');
    }
}
