@if ($logged_in_user->hasAllAccess())
    <x-utils.edit-button :href="route('admin.auth.iklan.edit_kategori_perolehan', $kategoriPerolehan)" />
    @if($kategoriPerolehan->nama != 'PERKHIDMATAN PERUNDING')
    <a href="#" onclick="ya('{{$kategoriPerolehan->id}}')" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i>
        @lang('Padam')
    </a>
    @endif
@endif

