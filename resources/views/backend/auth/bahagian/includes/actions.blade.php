@if ($logged_in_user->isAdmin())
    <x-utils.edit-button :href="route('admin.auth.bahagian.edit', $model)" />

    <a href="#" onclick="padam('{{$model->id}}')" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i>
        @lang('Padam')
    </a>
@endif
