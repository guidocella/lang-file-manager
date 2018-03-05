<form class="form-inline mb-3">
    <select class="form-control"
            onchange="location.href = {{ (isset($currentGroup) ? "'/admin/lang/' + this.value + '/$currentGroup'" : 'this.value') }}">
        @foreach (config('lang_file_manager.locales') as $locale => $language)
            <option value="{{ $locale }}"{{ $locale === $currentLocale ? ' selected' : '' }}>{{ $language }}</option>
        @endforeach
    </select>
</form>

@isset($currentGroup)
    <p class="row mb-3">
        <em class="col-lg-10">
            Non tradurre le parole precedute da due punti (es. :città).
            Queste parole saranno rimpiazzate automaticamente dal valore opportuno.
        </em>

        <div class="col-lg">
            <button class="btn btn-outline-primary" form="lang-form">Salva</button>
        </div>
    </p>
@endisset

<nav class="nav nav-tabs">
    @foreach ($groups as $group)
        <a href="/admin/lang/{{ "$currentLocale/$group" }}"
           class="nav-link{!! isset($currentGroup) && $group === $currentGroup ? ' active' : '' !!}">
            {{ str_replace('_', ' ', ucfirst($group)) }}
        </a>
    @endforeach
</nav>
