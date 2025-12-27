<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class DataPenggunaController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8000/api/dataPengguna';
    public function index()
    {
               try {
            $response = Http::get($this->apiUrl);

            if ($response->successful()) {
                $data = $response->json();

                $userCount = $data['total_user'] ?? 0;
                $karyawanCount = $data['total_karyawan'] ?? 0;
                $magangCount = $data['total_magang'] ?? 0;
                
                $totalUser = collect($data)->map(function($item) {
                    return (object) $item;
                });
            } else {
                $totalUser = $karyawanCount = $magangCount = 0;
            }
        } catch (\Exception $e) {
            Log::error('Error fetching categories: ' . $e->getMessage());
            $totalUsers = $karyawanCount = $magangCount = 0;
        }

        return view('admin.data_pengguna.index', compact(
              'userCount',
            'karyawanCount',
            'magangCount'
        ));
    }
}