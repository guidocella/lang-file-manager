<nav class="nav nav-tabs">
    @foreach ($groups as $group)
        <a href="/admin/lang/{{ "$currentLocale/$group" }}"
           class="nav-link{!! isset($currentGroup) && $group === $currentGroup ? ' active' : '' !!}">
            {{ str_replace('_', ' ', ucfirst($group)) }}
        </a>
    @endforeach
</nav>
