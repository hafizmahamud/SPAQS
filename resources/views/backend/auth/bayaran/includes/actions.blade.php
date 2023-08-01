<a href="{{ route('admin.auth.bayaran.edit', $bayarKepada) }}" class="btn btn-primary btn-sm">
    <i class="fas fa-pencil-alt"></i>
    @lang('Kemaskini')
</a>
<a href="#" onclick="padam('{{$bayarKepada->id}}')" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
    @lang('Padam')
</a>

