<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BibitController extends Controller
{

    public function createBibit(Request $request)
    {
        $id_bibit = $request->input('id_bibit');
        $nama_bibit = $request->input('nama_bibit');
        $harga_satuan = $request->input('harga_satuan');
        $stok_bibit = $request->input('stok_bibit');

        try {
            DB::select('CALL InsertBibit(?, ?, ?, ?)', [$id_bibit, $nama_bibit, $harga_satuan, $stok_bibit]);

            return response()->json([
                'message' => 'Bibit berhasil ditambahkan'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menambahkan bibit'
            ], 500);
        }
    }
    public function getBibit()
    {
        try {
            $results = DB::select('CALL readbibit()');

            return response()->json($results, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat membaca data bibit'
            ], 500);
        }
    }

    public function getBibitId($id)
    {
        try {
            $result = DB::select('CALL GetBibitByID(?)', [$id]);

            if (empty($result)) {
                return response()->json([
                    'message' => 'Data bibit tidak ditemukan'
                ], 404);
            }

            return response()->json($result[0], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data bibit'
            ], 500);
        }
    }
    public function updateBibit(Request $request, $id)
    {
        $nama = $request->input('nama_bibit');
        $harga = $request->input('harga_satuan');
        $stok = $request->input('stok_bibit');

        try {
            DB::select('CALL UpdateBibit(?, ?, ?, ?)', [$id, $nama, $harga, $stok]);

            return response()->json([
                'message' => 'Data bibit berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui bibit',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function deleteBibit($id)
    {
        try {
            DB::select('CALL DeleteBibit(?)', [$id]);

            return response()->json([
                'message' => 'Data bibit berhasil dihapus berdasarkan ID'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus bibit',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function deleteBibitData()
    {
        try {
            DB::select('CALL DeleteAllData()');

            return response()->json([
                'message' => 'Semua data bibit berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus semua data bibit',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
