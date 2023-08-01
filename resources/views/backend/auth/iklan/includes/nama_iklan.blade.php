@php
$value = \Modules\Sisdant\Models\JenisIklan::select('nama')->where(['id' => $row])->get();
@endphp

@foreach ($value as $v)
    <span class="label label-primary">{{ $v->nama }} <br></span>
@endforeach