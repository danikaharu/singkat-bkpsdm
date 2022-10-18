<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $latestPromotions = Promotion::with('employee')->latest()->limit(5)->get();
        return view('admin.dashboard.index', compact('latestPromotions'));
    }
}
