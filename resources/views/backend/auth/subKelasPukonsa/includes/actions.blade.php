<x-utils.edit-button :href="route('admin.auth.subKelasPukonsa.edit', $subKelasPukonsa)" />
<a href="#" onclick="padam('{{$subKelasPukonsa->id}}')" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
    @lang('Padam')
</a>

