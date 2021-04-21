<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\List_;

class KendaraanController extends Controller
{
    public function list()
    {
        $hasil = DB::select('select * from table_kendaraan');
        return view('kendaraan', ['data' => $hasil]);
    }
    public function simpan(Request $req)
    {
        DB::insert(
            'insert into table_kendaraan (plat,merk, tipe) values (?, ?, ?)',
            [$req->plat, $req->merk, $req->tipe]
        );
        $hasil = DB::select('select * from table_kendaraan');
        return view('kendaraan', ['data' => $hasil]);
    }
    public function hapus($req)
    {
        Log::info('proses hapus dengan id=' . $req);
        DB::delete('delete from table_kendaraan where id = ?', [$req]);

        $hasil = DB::select('select * from table_kendaraan');
        return view('kendaraan', ['data' => $hasil]);
    }
    public function ubah($req)
    {
        $hasil = DB::select('select * from table_kendaraan where id = ?', [$req]);
        return view('form-ubah', ['data' => $hasil]);
    }
    public function rubah(Request $req)
    {
        Log::info('Hallo');
        Log::info($req);
        DB::update(
            'update table_kendaraan set ' .
                'plat=?, ' .
                'merk=?, ' .
                'tipe=? where id=? ',
            [
                $req->plat,
                $req->merk,
                $req->tipe,
                $req->id
            ]
        );
        $hasil = DB::select('select * from table_kendaraan');
        return view('kendaraan', ['data' => $hasil]);
    }
}
