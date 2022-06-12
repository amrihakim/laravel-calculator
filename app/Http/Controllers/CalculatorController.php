<?php

namespace App\Http\Controllers;

use App\Models\Calculator;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riwayat = Calculator::orderBy('id', 'DESC')->get();
        $result = Calculator::orderBy('id', 'DESC')->select('result')->first();
        // dd($result);
        if (is_null($result))
        {
            $hasil  = $result;
        }
        else {
            $hasil = $result->result;
        }
        // dd($hasil);
        return view('index', [
            'riwayat' => $riwayat,
            'hasil' => $hasil
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'num1'     => 'required',
            'num2'     => 'required',
            'ops'   => 'required'
        ]);

        try {
            // dd($request->all());

            $bil1 = $request->num1;
            $bil2 = $request->num2;
            $ops = $request->ops;
            switch ($ops) {
                case '+':
                $hasil = $bil1+$bil2;
                break;
                case '-':
                $hasil = $bil1-$bil2;
                break;
                case '*':
                $hasil = $bil1*$bil2;
                break;
                case '/':
                if($bil2 == 0)
                {
                    $hasil = 'x';
                }
                else {
                    $hasil = $bil1/$bil2;
                }
                break;
                case '%':
                $hasil = $bil1%$bil2;
                break;
                case '^':
                $hasil = pow($bil1,$bil2);
                break;
            }

            Calculator::create([
                'num1' => $bil1,
                'num2' => $bil2,
                'ops' => $ops,
                'result' => $hasil,
            ]);
        } catch (\Throwable $th) {
            // dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('calculator.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
