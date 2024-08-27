<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekening;

class IndexController extends Controller
{
    public function index()
    {
        // Count the number of Rekening records waiting for approval
        $pendingCount = Rekening::where('status', 'Menunggu Approval')->count();

        $recentApplications = Rekening::orderBy('created_at', 'desc')->take(5)->get();

        return view('index', compact('pendingCount', 'recentApplications'));

    }
}
