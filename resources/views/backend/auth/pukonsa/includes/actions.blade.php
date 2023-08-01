<a href="{{ route('admin.auth.pukonsa.edit', $kelasPukonsa) }}" class="btn btn-info btn-sm">
    <i class="fas fa-search"></i>
    @lang('Sub Kelas Pukonsa')
</a>
<a href="{{ route('admin.auth.pukonsa.show', $kelasPukonsa) }}" class="btn btn-primary btn-sm">
    <i class="fas fa-pencil-alt"></i>
    @lang('Kemaskini Kelas Pukonsa')
</a>
<a href="#" onclick="padam('{{$kelasPukonsa->id}}','{{$kelasPukonsa->subPukonsa}}')" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
    @lang('Padam')
</a>

