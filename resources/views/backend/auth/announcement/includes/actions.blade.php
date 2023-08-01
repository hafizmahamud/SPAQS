<a href="{{ route('admin.auth.announcement.edit', $announcement) }}" class="btn btn-primary btn-sm">
    <i class="fas fa-pencil-alt"></i>
    @lang('Kemaskini')
</a>
<a href="#" onclick="padam('{{$announcement->id}}')" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
    @lang('Padam')
</a>