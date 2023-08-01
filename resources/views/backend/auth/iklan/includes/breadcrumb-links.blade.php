<a href="{{route('admin.auth.user.deactivated')}}" class="c-sidebar-nav-link">
    <span class="links_name" style="color:rgba(0, 0, 21, 0.5)">@lang('Deactivated Users')
    @if(in_array('TIDAK AKTIF', $status))
        <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:10px"></i>
    @endif
    </span>
</a>

@if ($logged_in_user->hasAllAccess())
    <x-utils.link class="c-subheader-nav-link" :href="route('admin.auth.user.deleted')" :text="__('Deleted Users')" />
@endif
