<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DashboardController 
{
    
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::whereNotNull('email_verified_at')->count();
        $newUsersToday = User::whereDate('created_at', today())->count();
        $startOfYear = now()->startOfYear();
        $endOfYear = now()->endOfYear();
    
        $userGrowthData = [
            'months' => [],
            'totalUsers' => [],
            'verifiedUsers' => []
        ];
    
        $verificationTrendData = [
            'months' => [],
            'rates' => []
        ];
    
        // Calculate monthly user growth and verification rates
        for ($month = 1; $month <= 12; $month++) {
            $monthStart = now()->month($month)->startOfMonth();
            $monthEnd = now()->month($month)->endOfMonth();
    
            $totalUsers = User::whereDate('created_at', '<=', $monthEnd)->count();
            $verifiedUsers = User::whereDate('created_at', '<=', $monthEnd)
                ->whereNotNull('email_verified_at')
                ->count();
    
            $userGrowthData['months'][] = $monthStart->format('M');
            $userGrowthData['totalUsers'][] = $totalUsers;
            $userGrowthData['verifiedUsers'][] = $verifiedUsers;
    
            $verificationRate = $totalUsers > 0 
                ? round(($verifiedUsers / $totalUsers) * 100, 2) 
                : 0;
    
            $verificationTrendData['months'][] = $monthStart->format('M');
            $verificationTrendData['rates'][] = $verificationRate;
        }
    
        return view('admin.dashboard', compact('totalUsers', 'activeUsers', 'newUsersToday', 
        'userGrowthData',
        'verificationTrendData'));
    }




}
