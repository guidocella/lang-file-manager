<form class="form-inline">
    <select class="form-control"
            onchange="location.href = {{ (isset($currentGroup) ? "'/admin/lang/' + this.value + '/$currentGroup'" : 'this.value') }}">
        @foreach (config('lang_file_manager.locales') as $locale => $language)
            <option value="{{ $locale }}"{{ $locale === $currentLocale ? ' selected' : '' }}>{{ $language }}</option>
        @endforeach
    </select>
</form>

@isset($currentGroup)
    <p>
        <em>
            Non tradurre le parole precedute da due punti (es. :città).
            Queste parole saranno rimpiazzate automaticamente dal valore opportuno.
        </em>

        <button class="btn btn-secondary float-right" form="lang-form">Salva</button>
    </p>
@endisset

<nav class="nav nav-tabs mt-3">
    @foreach ($groups as $group)
        <a href="/admin/lang/{{ "$currentLocale/$group" }}"
           class="nav-link{!! isset($currentGroup) && $group === $currentGroup ? ' active' : '' !!}">
            {{ ucfirst(str_replace('_', ' ', $group)) }}
        </a>
    @endforeach
</nav>
