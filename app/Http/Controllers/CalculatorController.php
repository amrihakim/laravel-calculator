<?php

namespace App\Http\Controllers;

use App\Models\Calculator;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CalculatorController extends Controller
{

    public function index()
    {
        // mengambil semua data di dalam tabel calculators
        $riwayat = Calculator::orderBy('id', 'DESC')->get();

        // mengambil data kolom hasil terakhir yang ada di tabel calculators
        $result = Calculator::orderBy('id', 'DESC')->select('result')->first();

        // jika $result berisi null
        if (is_null($result))
        {
            $hasil  = $result;
        }
        else {
            $hasil = $result->result;
        }

        return view('index', [
            'riwayat' => $riwayat,
            'hasil' => $hasil
        ]);
    }

    public function store(Request $request)
    {
        // validasi input yang ada di view index
        $request->validate([
            'num1'     => 'required',
            'num2'     => 'required',
            'ops'   => 'required'
        ]);

        try {
            // deklarasi variabel $request = data yang diinputkan
            $bil1 = $request->num1;
            $bil2 = $request->num2;
            $ops = $request->ops;

            // percabangan berdasarkan operasi yang diinputkan
            switch ($ops) {
                // tambah
                case '+':
                $hasil = $bil1+$bil2;
                break;

                // kurang
                case '-':
                $hasil = $bil1-$bil2;
                break;

                // kali
                case '*':
                $hasil = $bil1*$bil2;
                break;

                // bagi
                case '/':
                // jika ada bilangan dibagi 0
                if($bil2 == 0)
                {
                    $hasil = 'x';
                }
                else {
                    $hasil = $bil1/$bil2;
                }
                break;

                // modulo
                case '%':
                $hasil = $bil1%$bil2;
                break;

                // pangkat
                case '^':
                $hasil = pow($bil1,$bil2);
                break;
            }

            // memasukkan data ke dalam database
            Calculator::create([
                'num1' => $bil1,
                'num2' => $bil2,
                'ops' => $ops,
                'result' => $hasil,
            ]);
        } catch (\Throwable $th) {
            // jika terdapat error
            return back();
        }

        // dikembalikan ke index saat kode sudah dijalankan
        return redirect(route('calculator.index'));

    }
}
