<nav class="nav nav-tabs">
    @foreach ($groups as $group)
        <a href="/admin/lang/{{ "$currentLocale/$group" }}"
           class="nav-link{!! isset($currentGroup) && $group === $currentGroup ? ' active' : '' !!}">
            {{ strtr(ucfirst($group), '_', ' ') }}
        </a>
    @endforeach
</nav>
