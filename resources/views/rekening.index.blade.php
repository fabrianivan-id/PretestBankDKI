<table id="rekeningTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Pekerjaan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<script>
$(document).ready(function() {
    $('#rekeningTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("rekening.index") }}',
        columns: [
            { data: 'nama_ktp' },
            { data: 'tempat_lahir' },
            { data: 'tanggal_lahir' },
            { data: 'jenis_kelamin' },
            { data: 'pekerjaan.nama' },
            { data: 'status' },
            { data: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
