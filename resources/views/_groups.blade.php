@isset($currentGroup)
    <p class="row">
        <em class="col-lg-10">
            Non tradurre le parole precedute da due punti (es. :città).
            Queste parole saranno rimpiazzate automaticamente dal valore opportuno.
        </em>

        <div class="col-lg">
            <button class="btn btn-primary" form="lang-form">Salva</button>
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
