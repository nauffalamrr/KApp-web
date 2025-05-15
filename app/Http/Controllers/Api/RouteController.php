<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function calculate(Request $request)
    {
        $request->validate([
            'start' => 'required|array',
            'start.latitude' => 'required|numeric',
            'start.longitude' => 'required|numeric',
            'destinations' => 'required|array|min:1',
            'destinations.*.latitude' => 'required|numeric',
            'destinations.*.longitude' => 'required|numeric',
            'vehicle_type' => 'required|in:car,motorcycle',
        ]);

        $start = $request->start;
        $destinations = $request->destinations;

        $ordered = $this->nearestNeighbor($start, $destinations);

        return response()->json([
            'ordered_destinations' => $ordered,
        ]);
    }

    private function distance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    private function nearestNeighbor($start, $destinations)
    {
        $unvisited = $destinations;
        $current = $start;
        $result = [];

        while (count($unvisited) > 0) {
            $nearestIndex = null;
            $nearestDistance = PHP_INT_MAX;

            foreach ($unvisited as $index => $dest) {
                $dist = $this->distance(
                    $current['latitude'], $current['longitude'],
                    $dest['latitude'], $dest['longitude']
                );

                if ($dist < $nearestDistance) {
                    $nearestDistance = $dist;
                    $nearestIndex = $index;
                }
            }

            $nearest = $unvisited[$nearestIndex];
            $result[] = $nearest;

            $current = $nearest;

            array_splice($unvisited, $nearestIndex, 1);
        }

        return $result;
    }
}