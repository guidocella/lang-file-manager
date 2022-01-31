@extends('layouts.admin', ['title' => ucfirst(str_replace('_', ' ', $currentGroup))])

@section('content')
    @if (count(config('lang_file_manager.locales')) > 1)
        <form class="form-inline mb-3">
            <select class="form-control" onchange="location.href = '/admin/lang/' + this.value + '/{{ $currentGroup }}'">
                @foreach (config('lang_file_manager.locales') as $locale => $language)
                    <option value="{{ $locale }}"{{ $locale === $currentLocale ? ' selected' : '' }}>{{ $language }}</option>
                @endforeach
            </select>
        </form>
    @endif

    <div class="form-group row align-items-center">
        <em class="col-md-10">
            Non tradurre le parole precedute da due punti (es. :città).
            Queste parole saranno rimpiazzate automaticamente dal valore opportuno.
        </em>

        <div class="col-md text-md-right">
            <button class="btn btn-primary" form="lang-form">Salva</button>
        </div>
    </div>

    @include('lang-file-manager::_groups')

    <form id="lang-form" method="post">
        <table class="table table-striped" style="table-layout: fixed">
            @unless (App::isLocale($currentLocale))
                <thead>
                <tr>
                    <th>Italiano</th>
                    <th>{{ config('lang_file_manager.locales')[$currentLocale] }}</th>
                </tr>
                </thead>
            @endunless

            @foreach (trans($currentGroup) as $key => $line)
                <tr title="{{ $key }}">
                    @unless (App::isLocale($currentLocale))
                        <td>{!! str_starts_with($line, '<') ? $line : nl2br($line) !!}</td>
                    @endunless

                    <td>
                        {{ config("lang_file_manager.placeholders.$currentGroup.$key") }}

                        {{-- data-editor is used to add a WYSIWYG editor --}}
                        <textarea name="{{ $key }}" class="form-control"@if(str_starts_with($line, '<') && !str_starts_with($line, '<strong')) data-editor @endif>@lang("$currentGroup.$key", [], $currentLocale)</textarea>
                    </td>
                </tr>
            @endforeach
        </table>

        <button class="btn btn-primary d-block mx-auto">Salva</button>
    </form>
@endsection
