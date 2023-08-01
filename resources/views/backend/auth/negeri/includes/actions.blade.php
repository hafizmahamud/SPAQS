@if ($logged_in_user->isAdmin())
    <a href="{{ route('admin.auth.negeri.bahagian', $model) }}" class="btn btn-info btn-sm">
        <i class="fas fa-search"></i>
        @lang('Bahagian')
    </a>
    <a href="{{ route('admin.auth.negeri.edit', $model) }}" class="btn btn-primary btn-sm">
        <i class="fas fa-pencil-alt"></i>
        @lang('Kemaskini Pejabat')
    </a>

    <a href="#" onclick="padam('{{$model->id}}','{{$model->bahagian}}')" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i>
        @lang('Padam')
    </a>
@endif
