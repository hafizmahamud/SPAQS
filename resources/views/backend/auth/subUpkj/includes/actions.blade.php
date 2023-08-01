<x-utils.edit-button :href="route('admin.auth.subUpkj.edit', $subUpkj)" />
<a href="#" onclick="padam('{{$subUpkj->id}}')" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
    @lang('Padam')
</a>

