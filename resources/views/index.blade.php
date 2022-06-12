<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculator</title>

    {{-- cdn bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    {{-- start row --}}
    <div class="row m-0">
        {{-- start col-md-4 --}}
        <div class="col-md-4 d-flex justify-content-center align-items-center">
            <div class="card mt-4">
                <h3 class="text-center my-2">Calculator</h3>
                <div class="card-body">
                    <form action="{{ route('calculator.store')}}" method="POST" id="calculator" onsubmit="divideByZero()">
                        @csrf
                        {{-- input bilangan pertama --}}
                        <input class="form-control my-2" id="num1" name="num1" type="number" required value="{{ isset($hasil->num1) ? $hasil->num1 : ''}}">

                        {{-- input bilangan kedua --}}
                        <input class="form-control my-2" id="num2" name="num2" type="number" value="{{ isset($hasil->num2) ? $hasil->num2 : ''}}">

                        {{-- select operator --}}
                        <select class="form-select my-2" name="ops" id="option">
                            <option class="ops" value="+" {{ isset($hasil->ops) ? ($hasil->ops == '+' ? 'id=ops selected' : '') : '' }}>+</option>
                            <option class="ops" value="-" {{ isset($hasil->ops) ? ($hasil->ops == '-' ? 'id=ops selected' : '') : '' }}>-</option>
                            <option class="ops" value="*" {{ isset($hasil->ops) ? ($hasil->ops == '*' ? 'id=ops selected' : '') : '' }}>x</option>
                            <option class="ops" value="/" {{ isset($hasil->ops) ? ($hasil->ops == '/' ? 'id=ops selected' : '') : '' }}>-:-</option>
                            <option class="ops" value="%" {{ isset($hasil->ops) ? ($hasil->ops == '%' ? 'id=ops selected' : '') : '' }}>%</option>
                            <option class="ops" value="^" {{ isset($hasil->ops) ? ($hasil->ops == '^' ? 'id=ops selected' : '') : '' }}>^</option>
                        </select>

                        {{-- jika ada hasil terakhir maka tampilkan --}}
                        @if (isset($hasil))
                        <input class="form-control my-2" id="hasil" name="result" disabled type="text" value="{{ isset($hasil->result) ? $hasil->result : '' }}">
                        @endif

                        {{-- start div button --}}
                        <div class="float-end mt-2">
                            @if (isset($hasil))
                            {{-- button untuk meneruskan hasil ke dalam input --}}
                            <button class="btn btn-dark" onclick="
                            document.getElementById('num1').value = @php echo $hasil->result @endphp;
                            document.getElementById('hasil').value = null;
                            document.getElementById('num2').value = null;
                            document.getElementById('ops').selected = false;
                            return false;
                            ">Continue</button>
                            @endif

                            {{-- button untuk reset form --}}
                            <button class="btn btn-light" onclick="
                            document.getElementById('calculator').reset();
                            document.getElementById('num1').value = null;
                            document.getElementById('num2').value = null;
                            document.getElementById('ops').selected = false;
                            document.getElementById('hasil').value =null;
                            return false;"
                            type="reset">Reset</button>

                            {{-- button submit --}}
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        {{-- end col-md-4  --}}
        </div>
        {{-- start col-md-8 --}}
        <div class="col-md-8">
            <h3 class="text-center">Riwayat</h3>
            <table class="table mx-auto w-75 ">
                <tr>
                    <th>Bilangan Pertama</th>
                    <th>Operasi</th>
                    <th>Bilangan Kedua</th>
                    <th>Hasil</th>
                </tr>
                {{-- menampilkan seluruh riwayat/data yang ada di database --}}
                @foreach ($riwayat as $r )
                <tr>
                    <td>{{ $r->num1 }}</td>
                    <td>{{ $r->ops }}</td>
                    <td>{{ $r->num2 }}</td>
                    <td>{{ $r->result }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        {{-- end col-md-8 --}}
    </div>
    {{-- end row --}}
    {{-- cdn bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    {{-- fungsi javascript yang muncul saat ada bilangan dibagi 0 --}}
    <script>
        function divideByZero(){
            if(document.getElementById('num2').value == 0 && document.getElementById('option').value == '/' ) {
                alert('Cannot divide by zero!');
            }
        }
    </script>
</body>
</html>
