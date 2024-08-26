@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pengajuan Rekening</h1>
    <a href="{{ route('rekening.create') }}" class="btn btn-primary">Tambah Pengajuan</a>
    <table id="rekeningTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Pekerjaan</th>
                <th>Status</th>
                @if(Auth::user()->role == 'Supervisi')
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
    </table>
</div>
@endsection
