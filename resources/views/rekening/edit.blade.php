<!-- resources/views/rekening/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pengajuan Rekening</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rekening.update', $rekening->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_ktp">Nama Sesuai KTP:</label>
            <input type="text" name="nama_ktp" class="form-control" value="{{ old('nama_ktp', $rekening->nama_ktp) }}" required>
        </div>

        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir:</label>
            <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $rekening->tempat_lahir) }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $rekening->tanggal_lahir) }}" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Laki-laki" {{ old('jenis_kelamin', $rekening->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Wanita" {{ old('jenis_kelamin', $rekening->jenis_kelamin) == 'Wanita' ? 'selected' : '' }}>Wanita</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pekerjaan_id">Pekerjaan:</label>
            <select name="pekerjaan_id" class="form-control" required>
                @foreach($pekerjaans as $pekerjaan)
                    <option value="{{ $pekerjaan->id }}" {{ old('pekerjaan_id', $rekening->pekerjaan_id) == $pekerjaan->id ? 'selected' : '' }}>{{ $pekerjaan->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="province_id">Provinsi:</label>
            <select name="province_id" class="form-control" id="province" required>
                <option value="">Pilih Provinsi</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}" {{ old('province_id', $rekening->province_id) == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="city_id">Kabupaten/Kota:</label>
            <select name="city_id" class="form-control" id="city" required>
                <!-- Options will be populated by JavaScript -->
            </select>
        </div>

        <div class="form-group">
            <label for="district_id">Kecamatan:</label>
            <select name="district_id" class="form-control" id="district" required>
                <!-- Options will be populated by JavaScript -->
            </select>
        </div>

        <div class="form-group">
            <label for="village_id">Kelurahan:</label>
            <select name="village_id" class="form-control" id="village" required>
                <!-- Options will be populated by JavaScript -->
            </select>
        </div>

        <div class="form-group">
            <label for="nama_jalan">Nama Jalan:</label>
            <input type="text" name="nama_jalan" class="form-control" value="{{ old('nama_jalan', $rekening->nama_jalan) }}" required>
        </div>

        <div class="form-group">
            <label for="rt">RT:</label>
            <input type="text" name="rt" class="form-control" value="{{ old('rt', $rekening->rt) }}" required>
        </div>

        <div class="form-group">
            <label for="rw">RW:</label>
            <input type="text" name="rw" class="form-control" value="{{ old('rw', $rekening->rw) }}" required>
        </div>

        <div class="form-group">
            <label for="nominal_setor">Nominal Setor:</label>
            <input type="number" name="nominal_setor" class="form-control" value="{{ old('nominal_setor', $rekening->nominal_setor) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#province').on('change', function() {
            var provinceId = $(this).val();
            if (provinceId) {
                $.ajax({
                    url: '/getCities/' + provinceId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#city').empty().append('<option value="">Pilih Kota/Kabupaten</option>');
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#city').empty();
                $('#district').empty();
                $('#village').empty();
            }
        });

        $('#city').on('change', function() {
            var cityId = $(this).val();
            if (cityId) {
                $.ajax({
                    url: '/getDistricts/' + cityId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#district').empty().append('<option value="">Pilih Kecamatan</option>');
                        $.each(data, function(key, value) {
                            $('#district').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#district').empty();
                $('#village').empty();
            }
        });

        $('#district').on('change', function() {
            var districtId = $(this).val();
            if (districtId) {
                $.ajax({
                    url: '/getVillages/' + districtId,
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
                $('#village').empty();
            }
        });
    });
</script>

@endsection
