@if (count($breadcrumbs))

    <ol class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-lg">
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item"><a class="text-muted" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active"><a class="text-muted" href="">{{ $breadcrumb->title }}</a></li>
            @endif

        @endforeach
    </ol>

@endif
