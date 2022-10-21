<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function update_at()
    {
        $update_at = Carbon::now("Asia/Jakarta")->format('Y-m-d H:i:s');
        return $update_at;
    }
    public function today()
    {
        $today = Carbon::now("Asia/Jakarta")->format('Y-m-d');
        return $today;
    }
}

// status acc
// 
// 11 = diajukan
// 21 = acc atasan
// 31 = acc iT 
// 81 = acc admin IT 
// 71 = Menunggu acc VP
// 
// 41 = Request Pengerjaan / Dalam Antrian IT
// 42 = Progress IT / Dalam Pengerjaan IT 
// 
// 29 = Ditolak Atasan
// 39 = Ditolak IT
// 89 = Ditolak Admin IT
// 
// 91 = Dalam Penggunaan User 
// 92 = Selesai - Sudah Dikembalikan
// 93 = Request Pengembalian
// 94 = Prosess Pengembalian

// pengadaan

// 71 = Pengajuan Unit
// 72 = acc atasan
// 73 = acc IT
// 74 = acc admin IT
// 75 = Request Pengerjaan / Dalam Antrian IT
// 76 = Selesai

// 77 = Ditolak Atasan
// 78 = Ditolak IT
// 79 = Ditolak Admin IT



// User Testing - Sarana Teknologi :
//     A. Admin Aplikasi
//         user : 01012022
//     B. Admin IT 
//         user : 01052022
//     C. IT 
//         1. user : 01042022
//         2. user : 01092022
//     D. Atasan
//         - Divisi Marketing
//             user : 01032022
//         - Divisi Sales
//             user : 01072022
//     E. User
//         - User marketing
//             1. user : 01022022
//             2. user : 01062022
//         - User Sales
//             1. user : 01082022
            
// Password Login / Password Default : simetrisar123