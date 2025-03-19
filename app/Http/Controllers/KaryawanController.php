<?php

namespace App\Http\Controllers;

use App\Models\jabatan;
use App\Models\karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        try {
            $karyawan = karyawan::paginate(10);
            $user = User::all();
            $jabatan = jabatan::all();
            return view('page.karyawan.index')->with([
                'karyawan' => $karyawan,
                'user' => $user,
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
            $datauser = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => 'karyawan',
            ]);

            karyawan::create([
                'user_id' => $datauser->id,
                'jabatan_id' => $request->input('jabatan_id'),
                'no_hp' => $request->input('no_hp'),
                'status' => $request->input('status'),
                'tanggal_masuk' => $request->input('tanggal_masuk'),
            ]);

            return redirect()
                ->route('karyawan.index')->with('message_insert', 'Data karyawan Sudah ditambahkan ');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    public function edit(Request $request, string $id) {}

    public function update(Request $request, $id)
    {
        try {
            $karyawan = karyawan::findOrFail($id);
            $karyawan->update([
                'paket_id' => $request->input('paket_id'),
                'no_hp' => $request->input('no_hp'),
                'jabatan_id' => $request->input('jabatan_id'),
                'status' => $request->input('status'),
                'tanggal_masuk' => $request->input('tanggal_masuk'),
            ]);

            $user = User::where('id', $karyawan->user_id)->first();

            if ($request->input('password') == "") {
                $datapassword = $user->password;
            } else {
                $datapassword = $request->input('password');
            };

            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $datapassword,
                'role' => 'karyawan',
            ]);

            return redirect()
                ->route('karyawan.index')->with('message_insert', 'Data karyawan Berhasil diPerbarui ');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    public function destroy(string $id)
    {
        try {
            $data = karyawan::findOrFail($id);
            $datauser = User::findOrFail($data->user_id);
            $datauser->delete();
            $data->delete();
            return back()->with('message_delete', 'Data karyawan Berhasil DiHapus ');
        }catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }
}
