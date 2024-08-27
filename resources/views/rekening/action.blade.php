@if($row->status == 'Menunggu Approval')
<form action="{{ route('rekening.action', $row->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('POST')
    <button type="submit" name="action_type" value="approve" class="btn btn-success btn-sm">Approve</button>
    <button type="submit" name="action_type" value="reject" class="btn btn-danger btn-sm">Reject</button>
</form>
@endif
