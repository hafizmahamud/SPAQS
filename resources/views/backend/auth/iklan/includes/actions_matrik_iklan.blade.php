@if ($logged_in_user->hasAllAccess())
    <x-utils.edit-button :href="route('admin.auth.iklan.edit_matrik_iklan', $matrik)" />
    <a href="#" onclick="ya('{{$matrik->id}}')" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i>
        @lang('Padam')
    </a>
@endif

