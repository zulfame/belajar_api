<?php

namespace App\Http\Controllers\api\v1;

use App\Models\M_cif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CifController extends Controller
{
    public function index()
    {
        $pageSize = 10; // Ganti dengan ukuran halaman yang Anda inginkan
        $cif = M_cif::paginate($pageSize);

        return response([
            'success' => true,
            'message' => 'List CIF',
            'data' => $cif
        ], 200);
    }
}
