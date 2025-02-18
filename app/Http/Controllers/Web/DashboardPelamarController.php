<?php
namespace App\Http\Controllers\Web;
//namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPelamar;
use App\Models\LamaranPekerjaan;
use App\Models\LowonganPekerjaan;
use Illuminate\Support\Facades\Log;

class DashboardPelamarController extends Controller
{
    public function index()
    {
        return view('pelamar_dashboard.index'); // Pastikan view ini ada
    }
    
}