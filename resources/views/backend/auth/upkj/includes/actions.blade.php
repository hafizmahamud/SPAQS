<a href="{{ route('admin.auth.upkj.subupkj', $upkj) }}" class="btn btn-info btn-sm">
    <i class="fas fa-search"></i>
    @lang('Sub UPKJ')
</a>
<a href="{{ route('admin.auth.upkj.show', $upkj) }}" class="btn btn-primary btn-sm">
    <i class="fas fa-pencil-alt"></i>
    @lang('Kemaskini UPKJ')
</a>
<a href="#" onclick="padam('{{$upkj->id}}','{{$upkj->subKelasUpkj}}')" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
    @lang('Padam')
</a>

