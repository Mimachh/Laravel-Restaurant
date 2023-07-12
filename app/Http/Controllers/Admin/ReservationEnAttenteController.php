<?php

namespace App\Http\Controllers\Admin;
use App\Models\Reservation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DateTime;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request as Request2;
class ReservationEnAttenteController extends Controller
{
    // public function index() {
    //     $reservations = Reservation::where('status', '2')->paginate(10);

    //     return view('admin.reservation.attente.index', compact('reservations'));
    // }

    public function show(string $id) {

        $this->authorize('view', Reservation::class);

        $reservation = Reservation::find($id);

        return view('admin.reservation.attente.show', compact('reservation'));
    }

    public function edit() {

    }

    public function update() {

    }


    public function index()
    {
        $this->authorize('view', Reservation::class);

        $reservations = Reservation::where('status', '2')->orderBy('date')->get();

        $groupedReservations = $reservations->groupBy('date')->sort(function ($reservationsA, $reservationsB) {
            $dateA = DateTime::createFromFormat('d-m-Y', $reservationsA->first()->date);
            $dateB = DateTime::createFromFormat('d-m-Y', $reservationsB->first()->date);
    
            return $dateA <=> $dateB;
        });
    
        // Trier les réservations par service pour chaque date
        foreach ($groupedReservations as $date => $reservations) {
            $groupedReservations[$date] = $reservations->groupBy('service');
        }

        $currentPage = Request2::get('page') ?: 1;
        $perPage = 10;
    
        $paginatedGroupedReservations = new LengthAwarePaginator(
            $groupedReservations->forPage($currentPage, $perPage),
            $groupedReservations->count(),
            $perPage,
            $currentPage,
            ['path' => Request2::url()]
        );
        
    
        return view('admin.reservation.attente.index', compact('paginatedGroupedReservations'));
    }


    public function byDate($date, $service) {

        $this->authorize('view', Reservation::class);

        $reservations = Reservation::where('status', '2')->where('date', $date)->where('service', $service)->get();

        return view('admin.reservation.attente.byDate', [
            'reservations' => $reservations,
            'date' => $date,
            'service' => $service,
        ]);
    }
}
