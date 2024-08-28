@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-primary mb-4 text-center">
                <h4>Buat Pengajuan Rekening Baru</h4>
            </div>

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

                <div class="form-group mb-3">
                    <label for="nama_ktp">Nama Sesuai KTP:</label>
                    <input type="text" name="nama_ktp" class="form-control" value="{{ old('nama_ktp') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="tempat_lahir">Tempat Lahir:</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Wanita" {{ old('jenis_kelamin') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="pekerjaan_id">Pekerjaan:</label>
                    <select name="pekerjaan_id" class="form-control" required>
                        <option value="">Pilih Pekerjaan</option>
                        @foreach($pekerjaans as $pekerjaan)
                        <option value="{{ $pekerjaan->id }}" {{ old('pekerjaan_id') == $pekerjaan->id ? 'selected' : '' }}>
                            {{ $pekerjaan->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <fieldset class="form-group mb-4">
                    <legend>Alamat Sesuai KTP</legend>

                    <div class="form-group mb-3">
                        <label for="nama_jalan">Nama Jalan:</label>
                        <input type="text" name="nama_jalan" class="form-control" value="{{ old('nama_jalan') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="rt">RT:</label>
                        <input type="text" name="rt" class="form-control" value="{{ old('rt') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="rw">RW:</label>
                        <input type="text" name="rw" class="form-control" value="{{ old('rw') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="province_id">Provinsi:</label>
                        <select name="province_id" class="form-control" id="province-dropdown" required>
                            <option value="">Pilih Provinsi</option>
                            @foreach($provinces as $province)
                            <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="city_id">Kabupaten/Kota:</label>
                        <select name="city_id" class="form-control" id="city-dropdown" required>
                            <option value="">Pilih Kota/Kabupaten</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="district_id">Kecamatan:</label>
                        <select name="district_id" class="form-control" id="district-dropdown" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="village_id">Kelurahan:</label>
                        <select name="village_id" class="form-control" id="village-dropdown" required>
                            <option value="">Pilih Kelurahan</option>
                        </select>
                    </div>
                </fieldset>

                <div class="form-group mb-3">
                    <label for="nominal_setor">Nominal Setor:</label>
                    <input type="number" name="nominal_setor" class="form-control" value="{{ old('nominal_setor') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#province-dropdown').on('change', function() {
            var provinceId = this.value;
            $("#city-dropdown").html('<option value="">Loading...</option>');
            $.ajax({
                url: `/cities/${provinceId}`,
                type: "GET",
                dataType: 'json',
                success: function(cities) {
                    $('#city-dropdown').html('<option value="">Pilih Kota/Kabupaten</option>');
                    $.each(cities, function(id, name) {
                        $("#city-dropdown").append('<option value="' + id + '">' + name + '</option>');
                    });
                    $('#district-dropdown').html('<option value="">Pilih Kecamatan</option>');
                    $('#village-dropdown').html('<option value="">Pilih Kelurahan</option>');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching cities:', error);
                }
            });
        });

        $('#city-dropdown').on('change', function() {
            var cityId = this.value;
            $("#district-dropdown").html('<option value="">Loading...</option>');
            $.ajax({
                url: `/districts/${cityId}`,
                type: "GET",
                dataType: 'json',
                success: function(districts) {
                    $('#district-dropdown').html('<option value="">Pilih Kecamatan</option>');
                    $.each(districts, function(id, name) {
                        $("#district-dropdown").append('<option value="' + id + '">' + name + '</option>');
                    });
                    $('#village-dropdown').html('<option value="">Pilih Kelurahan</option>');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching districts:', error);
                }
            });
        });

        $('#district-dropdown').on('change', function() {
            var districtId = this.value;
            $("#village-dropdown").html('<option value="">Loading...</option>');
            $.ajax({
                url: `/villages/${districtId}`,
                type: "GET",
                dataType: 'json',
                success: function(villages) {
                    $('#village-dropdown').html('<option value="">Pilih Kelurahan</option>');
                    $.each(villages, function(id, name) {
                        $("#village-dropdown").append('<option value="' + id + '">' + name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching villages:', error);
                }
            });
        });
    });
</script>
@endsection