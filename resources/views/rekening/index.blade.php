<!-- resources/views/rekening/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pengajuan Rekening</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('rekening.create') }}" class="btn btn-primary mb-3">Tambah Pengajuan Rekening</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Pekerjaan</th>
                <th>Alamat</th>
                <th>Nominal Setor</th>
                <th>Status</th>
                @if(Auth::user()->role === 'Supervisi')
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($rekenings as $rekening)
                <tr>
                    <td>{{ $rekening->nama_ktp }}</td>
                    <td>{{ $rekening->tempat_lahir }}</td>
                    <td>{{ $rekening->tanggal_lahir }}</td>
                    <td>{{ $rekening->jenis_kelamin }}</td>
                    <td>{{ $rekening->pekerjaan->name }}</td>
                    <td>
                        {{ $rekening->nama_jalan }}, RT 0{{ $rekening->rt }}, RW 0{{ $rekening->rw }}<br>
                        {{ $rekening->village->name }}, {{ $rekening->district->name }}<br>
                        {{ $rekening->city->name }}, {{ $rekening->province->name }}
                    </td>
                    <td>Rp {{ number_format($rekening->nominal_setor, 2, ',', '.') }}</td>
                    <td>{{ $rekening->status }}</td>
                    @if(Auth::user()->role === 'Supervisi')
                        <td>
                            @if($rekening->status === 'Menunggu Approval')
                                <form action="{{ route('rekening.approve', $rekening->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
