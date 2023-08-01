<style>
    img {
        transition: all .5s linear;
    }
    .c-sidebar-minimized img{
        width: 35px;
    }
</style>
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <img src="/spaqs/assets/img/Logo_JPS.png" alt="" width="75" >
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="__('Dashboard')" />
        </li>

        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password')
            )
        )
            <li class="c-sidebar-nav-title">@lang('System')</li>

            <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-user"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Access')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.user.list') ||
                            $logged_in_user->can('admin.access.user.deactivate') ||
                            $logged_in_user->can('admin.access.user.reactivate') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.change-password')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <a href="{{route('admin.auth.user.index')}}" class="c-sidebar-nav-link">
                                <span class="links_name">@lang('User Management')
                                @if(in_array('TIDAK AKTIF', $status))
                                    <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:10px"></i>
                                @endif
                                </span>
                            </a>
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.role.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if ($logged_in_user->hasAllAccess())
            {{-- TETAPAN SISTEM --}}
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-cog"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Tetapan Sistem')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.alamat.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Alamat Tender')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.announcement.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Senarai Pengumuman')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.negeri.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Senarai Pejabat JPS')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.bidang.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Senarai Kod Bidang')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.kelas.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Senarai Kategori Pengkhususan')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.bayaran.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Senarai Bayaran Kepada')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.upkj.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Senarai Kelas UPKJ')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.pukonsa.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Senarai Kelas Pukonsa')" />
                    </li>
                </ul>
            </li>
        {{-- TETAPAN SISTEM --}}
        {{-- TETAPAN IKLAN --}}
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Tetapan Iklan')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.iklan.jenis_iklan')"
                            class="c-sidebar-nav-link"
                            :text="__('Senarai Jenis Iklan')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.iklan.kategori_iklan')"
                            class="c-sidebar-nav-link"
                            :text="__('Senarai Kategori Perolehan')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.iklan.jenis_tender')"
                            class="c-sidebar-nav-link"
                            :text="__('Senarai Jenis Perolehan')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.iklan.matrik_iklan')"
                            class="c-sidebar-nav-link"
                            :text="__('Matrik Iklan')" />
                    </li>
                </ul>
            </li>
            {{-- END OF TETAPAN IKLAN --}}

            {{-- Pengurusan Template --}}
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-newspaper"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Tetapan Template')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.kepalasurat.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Kepala Memo dan Surat')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.infopengarah.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Maklumat Pengarah')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.lantikanpenilai.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Memo Lantikan Penilai')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.akuanpelantikan.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Surat Akuan Pelantikan')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.selesaitugas.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Surat Akuan Selesai Tugas')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.hantardokumen.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Surat Hantar Dokumen ')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.sahlaku.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Surat Lanjut Sah Laku ')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.suratkeputusan.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Surat Edar Keputusan ')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.memokeputusan.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Memo Edar Keputusan ')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.sst.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Muat Naik SST')" />
                    </li>
                </ul>
            </li>
        {{-- Pengurusan Template --}}
        @endif

        @if ($logged_in_user->hasAllAccess())
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Logs')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::dashboard')"
                            class="c-sidebar-nav-link"
                            :text="__('Dashboard')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::logs.list')"
                            class="c-sidebar-nav-link"
                            :text="__('Logs')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="('/log')"
                            class="c-sidebar-nav-link"
                            :text="__('Log Pengguna')" />
                    </li>
                </ul>
            </li>
        @endif
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
