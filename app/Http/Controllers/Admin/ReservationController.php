<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\Reservation;
use DateTime;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

class ReservationController extends Controller
{
    public function index()
    {
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
        
    
        return view('admin.reservation.index', compact('paginatedGroupedReservations'));
    }

    public function a_venir($date, $service) {
        $reservations = Reservation::where('date', $date)->where('service', $service)->get();

        return view('admin.reservation.a_venir', [
            'reservations' => $reservations,
            'date' => $date,
            'service' => $service
        ]);
    }

    public function date_service_status($date, $service, $status) {
        $reservations = Reservation::where('date', $date)->where('service', $service)->where('status', $status)->get();

        return view('admin.reservation.a_venir', [
            'reservations' => $reservations,
            'date' => $date,
            'service' => $service,
            'status' => $status
        ]);
    }
}
