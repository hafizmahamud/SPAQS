@if ($logged_in_user->hasAllAccess())
    <x-utils.edit-button :href="route('admin.auth.iklan.edit', $jenisIklan)" />
@endif

