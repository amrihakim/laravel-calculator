<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <div class="row m-0">
        <div class="col-md-4 d-flex justify-content-center align-items-center">
            <div class="card mt-4">
                <h3 class="text-center my-2">Calculator</h3>
                    <div class="card-body">
                        <form action="{{ route('calculator.store')}}" method="POST" id="calculator" onsubmit="divideByZero()">
                            @csrf
                            <input class="form-control my-2" id="num1" name="num1" type="number" required value="{{ old('num1') }}">
                            <input class="form-control my-2" id="num2" name="num2" type="number" value="{{ old('num2') }}">
                            {{-- <input name="result" type="number" value="0" required> --}}
                            <select class="form-select my-2" name="ops" id="ops">
                                <option value="+" {{ old('ops') == '+' ? 'selected' : '' }}>+</option>
                                <option value="-" {{ old('ops') == '-' ? 'selected' : '' }}>-</option>
                                <option value="*" {{ old('ops') == '*' ? 'selected' : '' }}>x</option>
                                <option value="/" {{ old('ops') == '/' ? 'selected' : '' }}>-:-</option>
                                <option value="%" {{ old('ops') == '%' ? 'selected' : '' }}>%</option>
                                <option value="^" {{ old('ops') == '^' ? 'selected' : '' }}>^</option>
                            </select>
                            {{-- <button id="ops" name="ops" value="+" type="submit">+</button>
                            <button id="ops" name="ops" value="-" type="submit">-</button>
                            <button id="ops" name="ops" value="*" type="submit">*</button>
                            <button id="ops" name="ops" value="/" type="submit">/</button>
                            <button id="ops" name="ops" value="%" type="submit">%</button>
                            <button id="ops" name="ops" value="^" type="submit">^</button> --}}
                            @if (isset($hasil))
                            <input class="form-control my-2" id="hasil" name="num2" disabled type="text" value="{{ $hasil }}">
                            @endif
                            <div class="float-end mt-2">
                                <button class="btn btn-dark" onclick="document.getElementById('calculator').reset();document.getElementById('num1').value = <?php echo $hasil?>; document.getElementById('hasil').value =null; document.getElementById('num2').value = null; return false;    ">Continue</button>
                                <button class="btn btn-light" onclick="document.getElementById('calculator').reset(); document.getElementById('num1').value = null; document.getElementById('num2').value = null; document.getElementById('hasil').value =null;  return false;" type="reset">Reset</button>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
        <div class="col-md-6">
            <h3 class="text-center">Riwayat</h3>
            <table class="table mx-auto w-75 ">
                <tr>
                    <th>Bilangan Pertama</th>
                    <th>Operasi</th>
                    <th>Bilangan Kedua</th>
                    <th>Hasil</th>
                </tr>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
        function divideByZero(){
            if(document.getElementById('num2').value == 0 && document.getElementById('ops').value == '/' ) {
                alert('Cannot divide by zero!');
            }
        }
    </script>
</body>
</html>
