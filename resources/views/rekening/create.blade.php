@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pengajuan Rekening</h1>
    <form action="{{ route('rekening.store') }}" method="POST">
        @csrf
        <!-- Other form fields -->
        <div class="form-group">
            <label for="province_id">Provinsi</label>
            <select name="province_id" id="province_id" class="form-control" required>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="city_id">Kota/Kabupaten</label>
            <select name="city_id" id="city_id" class="form-control" required></select>
        </div>
        <div class="form-group">
            <label for="district_id">Kecamatan</label>
            <select name="district_id" id="district_id" class="form-control" required></select>
        </div>
        <div class="form-group">
            <label for="village_id">Kelurahan</label>
            <select name="village_id" id="village_id" class="form-control" required></select>
        </div>
        <!-- Other form fields -->
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#province_id').on('change', function() {
        var provinceId = $(this).val();
        $.get(`/cities/${provinceId}`, function(data) {
            $('#city_id').empty();
            $.each(data, function(index, city) {
                $('#city_id').append(`<option value="${city.id}">${city.name}</option>`);
            });
        });
    });

    $('#city_id').on('change', function() {
        var cityId = $(this).val();
        $.get(`/districts/${cityId}`, function(data) {
            $('#district_id').empty();
            $.each(data, function(index, district) {
                $('#district_id').append(`<option value="${district.id}">${district.name}</option>`);
            });
        });
    });

    $('#district_id').on('change', function() {
        var districtId = $(this).val();
        $.get(`/villages/${districtId}`, function(data) {
            $('#village_id').empty();
            $.each(data, function(index, village) {
                $('#village_id').append(`<option value="${village.id}">${village.name}</option>`);
            });
        });
    });
});
</script>
@endsection
