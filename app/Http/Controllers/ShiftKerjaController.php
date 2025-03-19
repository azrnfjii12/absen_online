<?php

namespace App\Http\Controllers;

use App\Models\shift_kerja;
use Illuminate\Http\Request;

class ShiftKerjaController extends Controller
{
    public function index()
    {
        try {
            $shift_kerja = shift_kerja::paginate(10);
            return view('page.shift_kerja.index')->with([
                'shift_kerja' => $shift_kerja
            ]);
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    public function create() {}

    public function store(Request $request)
    {
        try {
            $data = [
                'nama_shift' => $request->input('nama_shift'),
                'jam_masuk' => $request->input('jam_masuk'),
                'jam_keluar' => $request->input('jam_keluar')
            ];

            shift_kerja::create($data);

            return redirect()
                ->route('shift_kerja.index')->with('message_insert', 'Data Shift kerja Sudah ditambahkan ');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    public function edit(Request $request, string $id) {}

    public function update(Request $request, $id)
    {
        try {
            $data = [
                'nama_shift' => $request->input('nama_shift'),
                'jam_masuk' => $request->input('jam_masuk'),
                'jam_keluar' => $request->input('jam_keluar')
            ];

            $datas = shift_kerja::findOrFail($id);
            $datas->update($data);
            return redirect()
                ->route('shift_kerja.index')->with('message_insert', 'Data shift_kerja Berhasil diPerbarui ');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }
    
    public function destroy(string $id)
    {
        try {
            $data = shift_kerja::findOrFail($id);
            $data->delete();
            return back()->with('message_delete', 'Data Shift Kerja Berhasil DiHapus ');
        } catch (\Exception $e) {
            return back()->with('error_mesaage', 'Terjadi kesalahan saat melakukan delete data: ' . $e->getMessage());
        }
    }
}
