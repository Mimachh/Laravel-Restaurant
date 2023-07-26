<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

use App\Models\Couvertsrestants;
use App\Models\Jour;
use Carbon\Carbon;

use Illuminate\Notifications\Notifiable;
class Reservation extends Model
{
    use HasFactory;
    use Notifiable;

    public function transformDateToCompare()
    {
        $date = $this->date;
        $dateTime = DateTime::createFromFormat('d-m-Y', $date);
    
        return $dateTime->format('d-m-Y');
    }

    public function userName() {
        return $this->nom . " " . $this->prenom;
    }

    public function getStatus() {
        $status = "";
       if($this->status == 1) {
        $status = "Validé";
       } else if($this->status == 2) {
        $status = "En attente";
       } else if($this->status == 3) {
        $status = "Annulé";
       }

       return $status;
    }


}
