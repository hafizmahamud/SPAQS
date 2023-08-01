<x-utils.edit-button :href="route('admin.auth.subBidang.edit', $subBidang)" />
<a href="#" onclick="padam('{{$subBidang->id}}')" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
    @lang('Padam')
</a>

