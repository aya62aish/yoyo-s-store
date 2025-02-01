<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\member;
use App\Models\category;
use App\Models\ad;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now(); // Current date
        $labels = [];
        $data = [
            'users' => [],
            'members' => [],
            'categories' => [],
            'ads' => [],
            'differences' => [
                'users' => [],
                'members' => [],
                'categories' => [],
                'ads' => [],
            ],
        ];

        // Loop through the last six months
        for ($i = 5; $i >= 0; $i--) {
            $startOfMonth = $now->copy()->subMonths($i)->startOfMonth();
            $endOfMonth = $now->copy()->subMonths($i)->endOfMonth();

            $labels[] = $startOfMonth->format('M'); // Month name for the graph

            // Fetch counts for each month
            $userCount = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            $memberCount = Member::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            $categoryCount = Category::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            $adCount = Ad::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

            // Add counts to data arrays
            $data['users'][] = $userCount;
            $data['userscount'][] =  User::count();
            $data['members'][] = $memberCount;
            $data['memberscount'][] = Member::count();
            $data['categories'][] = $categoryCount;
            $data['categoriescount'][] = Category::count();
            $data['ads'][] = $adCount;
            $data['adscount'][] = Ad::count();

            // Calculate differences (skip the first month as there's no previous month to compare)
            if ($i < 5) {
                $data['differences']['users'][] = $userCount - $data['users'][4 - $i];
                $data['differences']['members'][] = $memberCount - $data['members'][4 - $i];
                $data['differences']['categories'][] = $categoryCount - $data['categories'][4 - $i];
                $data['differences']['ads'][] = $adCount - $data['ads'][4 - $i];
            } else {
                $data['differences']['users'][] = 0; // No difference for the first month
                $data['differences']['members'][] = 0;
                $data['differences']['categories'][] = 0;
                $data['differences']['ads'][] = 0;
            }
        }

        return view('admin.index', compact('labels', 'data'));
    }
}

