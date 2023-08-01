<x-utils.edit-button :href="route('admin.auth.pengkhususan.edit', $pengkhususan)" />
<a href="#" onclick="padam('{{$pengkhususan->id}}')" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
    @lang('Padam')
</a>

