<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembibitanController extends Controller
{
    public function CreatePembibitan(Request $request)
    {
        $id_pembibitan = $request->input('id_pembibitan');
        $tanggal_pembibitan = $request->input('tanggal_pembibitan');
        $id_kebun = $request->input('id_kebun');
        $id_bibit_m = $request->input('id_bibit_m');
        $jumlah_bibit = $request->input('jumlah_bibit');

        try {
            DB::select('CALL InsertPembibitan(?, ?, ?, ?, ?)', [$id_pembibitan, $tanggal_pembibitan, $id_kebun, $id_bibit_m, $jumlah_bibit]);

            return response()->json([
                'message' => 'Data Pembibitan berhasil ditambahkan'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menambahkan Pembibitan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function readPembibitan()
    {
        try {
            $results = DB::select('CALL ReadPembibitan()');

            return response()->json($results);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat membaca data Pembibitan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function readPembibitanID($id)
    {
        try {
            $result = DB::select('CALL ReadPembibitanByID(?)', [$id]);

            if (!empty($result)) {
                return response()->json($result[0]);
            } else {
                return response()->json([
                    'message' => 'Data Pembibitan tidak ditemukan'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat membaca data Pembibitan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function updatePembibitan(Request $request, $id)
    {
        $newTanggal = $request->input('tanggal_pembibitan');
        $newIdKebun = $request->input('id_kebun');
        $newIdBibit = $request->input('id_bibit');
        $newJumlahBibit = $request->input('jumlah_bibit');
        $newTotal = $request->input('total');

        try {
            DB::select('CALL UpdatePembibitan(?, ?, ?, ?, ?, ?)', [$id, $newTanggal, $newIdKebun, $newIdBibit, $newJumlahBibit, $newTotal]);

            return response()->json([
                'message' => 'Data Pembibitan berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui data Pembibitan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function deletePembibitan($id)
    {
        try {
            DB::select('CALL DeletePembibitan(?)', [$id]);

            return response()->json([
                'message' => 'Data Pembibitan berhasil dihapus berdasarkan ID'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data Pembibitan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deletePembibitanAll()
    {
        try {
            DB::select('CALL DeleteAllPembibitan()');

            return response()->json([
                'message' => 'Semua data Pembibitan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus semua data Pembibitan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
