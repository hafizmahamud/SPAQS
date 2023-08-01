<a href="{{ route('admin.auth.kelas.edit', $kelas) }}" class="btn btn-info btn-sm">
    <i class="fas fa-search"></i>
    @lang('Pengkhususan')
</a>
<a href="{{ route('admin.auth.kelas.show', $kelas) }}" class="btn btn-primary btn-sm">
    <i class="fas fa-pencil-alt"></i>
    @lang('Kemaskini Kategori')
</a>
<a href="#" onclick="padam('{{$kelas->id}}','{{$kelas->pengkhususan}}')" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
    @lang('Padam')
</a>

