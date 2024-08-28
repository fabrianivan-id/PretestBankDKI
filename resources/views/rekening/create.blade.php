@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Pengajuan Rekening Baru</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('rekening.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama_ktp">Nama Sesuai KTP:</label>
            <input type="text" name="nama_ktp" class="form-control" value="{{ old('nama_ktp') }}" required>
        </div>

        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir:</label>
            <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select name="jenis_kelamin" class="form-control" required>
            <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Wanita" {{ old('jenis_kelamin') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pekerjaan_id">Pekerjaan:</label>
            <select name="pekerjaan_id" class="form-control" required>
            <option value="">Pilih Pekerjaan</option>
                @foreach($pekerjaans as $pekerjaan)
                <option value="{{ $pekerjaan->id }}" {{ old('pekerjaan_id') == $pekerjaan->id ? 'selected' : '' }}>{{ $pekerjaan->name }}</option>
                @endforeach
            </select>
        </div>
        <fieldset class="form-group">
            <legend>Alamat Sesuai KTP</legend>
            <div class="form-group">
                <label for="nama_jalan">Nama Jalan:</label>
                <input type="text" name="nama_jalan" class="form-control" value="{{ old('nama_jalan') }}" required>
            </div>

            <div class="form-group">
                <label for="rt">RT:</label>
                <input type="text" name="rt" class="form-control" value="{{ old('rt') }}" required>
            </div>

            <div class="form-group">
                <label for="rw">RW:</label>
                <input type="text" name="rw" class="form-control" value="{{ old('rw') }}" required>
            </div>

            <div class="form-group">
                <label for="province_id">Provinsi:</label>
                <select name="province_id" class="form-control" id="province" required>
                    <option value="">Pilih Provinsi</option>
                    @foreach($provinces as $province)
                    <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="city_id">Kabupaten/Kota:</label>
                <select name="city_id" class="form-control" id="city" required>
                    <option value="">Pilih Kota/Kabupaten</option>
                </select>
            </div>

            <div class="form-group">
                <label for="district_id">Kecamatan:</label>
                <select name="district_id" class="form-control" id="district" required>
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="village_id">Kelurahan:</label>
                <select name="village_id" class="form-control" id="village" required>
                    <option value="">Pilih Kelurahan</option>
                </select>
            </div>
        </fieldset>
        <div class="form-group">
            <label for="nominal_setor">Nominal Setor:</label>
            <input type="number" name="nominal_setor" class="form-control" value="{{ old('nominal_setor') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#province').on('change', function() {
            var provinceId = $('#province').val();
            if (provinceId) {
                $.ajax({
                    url: '{{ url("getCities") }}/' + provinceId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#city').empty().append('<option value="">Pilih Kota/Kabupaten</option>');
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="' + key + '">' + value + '</option>');
                        });
                        $('#district').empty().append('<option value="">Pilih Kecamatan</option>');
                        $('#village').empty().append('<option value="">Pilih Kelurahan</option>');
                    }
                });
            } else {
                $('#city').empty().append('<option value="">Pilih Kota/Kabupaten</option>');
                $('#district').empty().append('<option value="">Pilih Kecamatan</option>');
                $('#village').empty().append('<option value="">Pilih Kelurahan</option>');
            }
        });

        $('#city').on('change', function() {
            var cityId = $('#city').val();
            if (cityId) {
                $.ajax({
                    url: '{{ url("getDistricts") }}/' + cityId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#district').empty().append('<option value="">Pilih Kecamatan</option>');
                        $.each(data, function(key, value) {
                            $('#district').append('<option value="' + key + '">' + value + '</option>');
                        });
                        $('#village').empty().append('<option value="">Pilih Kelurahan</option>');
                    }
                });
            } else {
                $('#district').empty().append('<option value="">Pilih Kecamatan</option>');
                $('#village').empty().append('<option value="">Pilih Kelurahan</option>');
            }
        });

        $('#district').on('change', function() {
            var districtId = $('#district').val();
            if (districtId) {
                $.ajax({
                    url: '{{ url("getVillages") }}/' + districtId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#village').empty().append('<option value="">Pilih Kelurahan</option>');
                        $.each(data, function(key, value) {
                            $('#village').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#village').empty().append('<option value="">Pilih Kelurahan</option>');
            }
        });
    });
</script>
@endsection