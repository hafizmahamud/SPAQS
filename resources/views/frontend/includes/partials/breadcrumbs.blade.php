@if (Breadcrumbs::has() && !Route::is('frontend.index'))
    <nav id="breadcrumbs" aria-label="breadcrumb" style="background-color: #f5f9ff; --bs-breadcrumb-divider: '>' !important; margin-top: 20px;">
        <ol class="breadcrumb mb-0" style="background-color: #f5f9ff; border-bottom: none;">
            @foreach (Breadcrumbs::current() as $crumb)
                @if ($crumb->url() && !$loop->last)
                    <li class="breadcrumb-item" style="font-size: 16px !important; font-weight:300 !important">
                        <x-utils.link :href="$crumb->url()" :text="$crumb->title()" />
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page" style="color:#1F944A; font-size: 16px !important; ">
                        {{ $crumb->title() }}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
