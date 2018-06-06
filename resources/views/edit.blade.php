@extends('layouts.admin', ['title' => ucfirst(str_replace('_', ' ', $currentGroup))])

@section('content')
    @include('lang-file-manager::_locales_and_groups')

    <form id="lang-form" method="post">
        {{ csrf_field() }}

        <table class="table table-striped" style="table-layout: fixed">
            @unless (App::isLocale($currentLocale))
                <thead>
                <tr>
                    <th>{{ config('lang_file_manager.locales')[App::getLocale()] }}</th>
                    <th>{{ config('lang_file_manager.locales')[$currentLocale] }}</th>
                </tr>
                </thead>
            @endunless

            @foreach (trans($currentGroup) as $key => $line)
                <tr title="{{ $key }}">
                    @unless (App::isLocale($currentLocale))
                        <td>{!! str_contains($line, '<p') ? $line : nl2br($line) !!}</td>
                    @endunless

                    <td>
                        {{ config("lang_file_manager.placeholders.$currentGroup.$key") }}

                        {{-- We'll add the data-editor attribute to the textareas of translations
                             that contain the <p> tag so it can be used to turn them into WYSIWYG editors. --}}
                        <textarea name="{{ $key }}"
                                  class="form-control"{{ str_contains($line, '<p') ? ' data-editor' : '' }}
                        >@lang("$currentGroup.$key", [], $currentLocale)</textarea>
                    </td>
                </tr>
            @endforeach
        </table>

        <button class="btn btn-primary d-block mx-auto">Salva</button>
    </form>
@endsection
