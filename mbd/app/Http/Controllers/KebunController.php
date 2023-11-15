<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KebunController extends Controller
{
    public function createKebun(Request $request)
    {
        $newIdKebun = $request->input('id_kebun');
        $newNamaKebun = $request->input('nama_kebun');
        $newLokasi = $request->input('lokasi');

        try {
            DB::select('CALL InsertKebun(?, ?, ?)', [$newIdKebun, $newNamaKebun, $newLokasi]);

            return response()->json([
                'message' => 'Data Kebun berhasil ditambahkan'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menambahkan kebun',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getKebun()
    {
        try {
            $query = DB::select('CALL ReadKebun()');
            return response()->json($query);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat membaca data kebun',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getKebunID($id)
    {
        try {
            $query = DB::select('CALL GetKebunByID(?)', [$id]);

            if (empty($query)) {
                return response()->json(['message' => 'Data kebun tidak ditemukan'], 404);
            }

            return response()->json($query[0]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data kebun',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateKebun(Request $request, $id)
    {
        $newNama = $request->input('nama');
        $newLokasi = $request->input('lokasi');

        try {
            DB::select('CALL UpdateKebun(?, ?, ?)', [$id, $newNama, $newLokasi]);

            return response()->json([
                'message' => 'Data Kebun berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui kebun',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function deleteKebun($id)
    {
        try {
            DB::select('CALL DeleteKebun(?)', [$id]);

            return response()->json([
                'message' => 'Data Kebun berhasil dihapus berdasarkan ID'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus kebun',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function deleteAllKebun()
    {
        try {
            DB::select('CALL DeleteAllKebun()');

            return response()->json([
                'message' => 'Semua data Kebun berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus semua data kebun',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
