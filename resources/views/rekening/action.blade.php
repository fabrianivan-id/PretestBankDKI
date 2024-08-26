@if(Auth::user()->role == 'Supervisi')
    <form action="{{ route('rekening.approve', $row->id) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-success">Approve</button>
    </form>
@endif
