<?php

namespace App\Http\Controllers;

use App\Models\jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        try {
            $jabatan = jabatan::paginate(10);
            return view('page.jabatan.index')->with([
                'jabatan' => $jabatan
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
                'nama_jabatan' => $request->input('nama_jabatan'),
                'deskripsi' => $request->input('deskripsi'),
            ];

            jabatan::create($data);

            return redirect()
                ->route('jabatan.index')->with('message_insert', 'Data jabatan Sudah ditambahkan ');
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
                'nama_jabatan' => $request->input('nama_jabatan'),
                'deskripsi' => $request->input('deskripsi'),
            ];

            $datas = jabatan::findOrFail($id);
            $datas->update($data);
            return redirect()
                ->route('jabatan.index')->with('message_insert', 'Data jabatan Berhasil diPerbarui ');
        } catch (\Exception $e) {
            return redirect()
                ->route('error.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
    }

    public function destroy(string $id)
    {
        try {
            $data = jabatan::findOrFail($id);
            $data->delete();
            return back()->with('message_delete', 'Data Jabatan Berhasil DiHapus ');
        }catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }
}
