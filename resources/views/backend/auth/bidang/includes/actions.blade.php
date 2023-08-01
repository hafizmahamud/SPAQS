<a href="{{ route('admin.auth.bidang.edit', $bidang) }}" class="btn btn-info btn-sm">
    <i class="fas fa-search"></i>
    @lang('Sub Bidang')
</a>
<a href="{{ route('admin.auth.bidang.show', $bidang) }}" class="btn btn-primary btn-sm">
    <i class="fas fa-pencil-alt"></i>
    @lang('Kemaskini Kod Bidang')
</a>
<a href="#" onclick="padam('{{$bidang->id}}','{{$bidang->subBidang}}')" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
    @lang('Padam')
</a>

