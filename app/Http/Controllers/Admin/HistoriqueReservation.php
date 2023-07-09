<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\Reservation;
use DateTime;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

class HistoriqueReservation extends Controller
{
       // HISTORIQUE
       public function historique()
       {
            $this->authorize('view', Reservation::class);

            $reservations = Reservation::orderBy('date')->get();
    
            $groupedReservations = $reservations->groupBy('date')->sort(function ($reservationsA, $reservationsB) {
                $dateA = DateTime::createFromFormat('d-m-Y', $reservationsA->first()->date);
                $dateB = DateTime::createFromFormat('d-m-Y', $reservationsB->first()->date);
        
                return $dateA <=> $dateB;
            });
       
           // Trier les réservations par service pour chaque date
           foreach ($groupedReservations as $date => $reservations) {
               $groupedReservations[$date] = $reservations->groupBy('service');
           }
   
           $currentPage = Request::get('page') ?: 1;
           $perPage = 10;
       
           $paginatedGroupedReservations = new LengthAwarePaginator(
               $groupedReservations->forPage($currentPage, $perPage),
               $groupedReservations->count(),
               $perPage,
               $currentPage,
               ['path' => Request::url()]
           );
           
       
           return view('admin.reservation.historique.index', compact('paginatedGroupedReservations'));
       }
   
       public function showByDateHistorique($date, $service) {

            $this->authorize('view', Reservation::class);

           $reservations = Reservation::where('date', $date)->where('service', $service)->get();
           $status = 1;
           return view('admin.reservation.historique.showByDate', [
               'reservations' => $reservations,
               'date' => $date,
               'service' => $service,
               'status' => $status
           ]);
       }
   
       public function showHistorique(string $id) {

            $this->authorize('view', Reservation::class);

            $reservation = Reservation::find($id);
    
            return view('admin.reservation.historique.show', compact('reservation'));
       }
}
