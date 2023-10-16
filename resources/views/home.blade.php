<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .centered{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    <title>Cek Ongkir</title>
</head>
<body>
    <div class="container centered">
        <div class="card">
            <form action="{{ url('/') }}" method="get">
                @csrf
                <div class="card-body shadow">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <h6>Nama</h6>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <h6>Kirim Dari</h6>
                                <select name="province_from" class="form-select">
                                    <option value="" holder>Pilih Provinsi</option>
                                    @foreach ($provinsi as $propinsi)
                                    <option value="{{ $propinsi->id }}">{{ $propinsi->province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="origin" class="form-select">
                                    <option value="" holder>Pilih Kota</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <h6>Kirim Ke</h6>
                                <select name="province_to" class="form-select">
                                    <option value="" holder>Pilih Provinsi</option>
                                    @foreach ($provinsi as $propinsi)
                                    <option value="{{ $propinsi->id }}">{{ $propinsi->province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <select name="destination" class="form-select">
                                    <option value="" holder>Pilih Kota</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <h6>Berat Paket (gram)</h6>
                                <input name="weight" type="text" class="form-control">
                                <small style="color: red">Gunakan satuan gram (contoh: 1000 gram = 1 kilogram)</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-1">
                                <h6>Kurir</h6>
                                <select name="courier" id="" class="form-select">
                                    <option value="" holder>Pilih Kurir</option>
                                    <option value="jne" >JNE</option>
                                    <option value="tiki" >Tiki</option>
                                    <option value="pos" >Pos Indonesia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-2 d-grid">
                            <button class="btn btn-primary" type="submit">Lihat Ongkir</button>
                        </div>
                    </div>
                    
                </form>
                @if($cekongkir)
                <div class="row">
                    <div class="col text-center">
                        <table class="table table-striped table-bordered table-hovered" width="100%">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Estimasi</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cekongkir as $result)
                                <tr>
                                    <td>{{ $result['service'] }}</td>
                                    <td>{{ $result['description'] }}</td>
                                    <td>{{ $result['cost'][0]['value'] }}</td>
                                    <td>{{ $result['cost'][0]['etd'] }}</td>
                                    <td>{{ $result['cost'][0]['note'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                
                @endif
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('select[name="province_from"]').on('change', function() {
                var cityId = $(this).val();
                if (cityId) {
                    $.ajax({
                        url: 'getCity/ajax/' + cityId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="origin"]').empty();
                            $.each(data, function (key, value){
                                $('select[name="origin"]').append(
                                '<option value="' + key + '">' + value + '</options>'
                                    );
                                });
                            }
                        });
                    } else {
                        $('select[name="origin"]').empty();
                    }
                });
                $('select[name="province_to"]').on('change', function() {
                    var cityId = $(this).val();
                    if (cityId) {
                        $.ajax({
                            url: 'getCity/ajax/' + cityId,
                            type: "GET",
                            dataType: "json",
                            success: function (data) {
                                $('select[name="destination"]').empty();
                                $.each(data, function (key, value){
                                    $('select[name="destination"]').append(
                                    '<option value="' + key + '">' + value + '</options>'
                                        );
                                    });
                                }
                            });
                        } else {
                            $('select[name="destination"]').empty();
                        }
                    });
                });
            </script>
        </body>
        </html>