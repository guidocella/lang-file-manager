<?php

namespace GuidoCella;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class LangFileManagerController extends Controller
{
    /**
     * List the text groups.
     */
    public function index(string $currentLocale): View
    {
        return view('lang-file-manager::index', ['currentLocale' => $currentLocale, 'groups' => $this->getGroups()]);
    }

    /**
     * Edit a text group.
     */
    public function edit(string $currentLocale, string $currentGroup): View
    {
        $groups = $this->getGroups();

        validator(['group' => $currentGroup], ['group' => Rule::in($groups)])->validate();

        return view('lang-file-manager::edit', compact('currentLocale', 'currentGroup', 'groups'));
    }

    /**
     * Update a text group.
     */
    public function update(Request $request, string $locale, string $group): RedirectResponse
    {
        File::putArray(
            App::langPath() . "/$locale/$group",
            array_map(function ($input) {
                return $input === null ? '' : $input;
                // If we save blank lines as null instead of '' the default locale's line will be shown.
            }, $request->except('_token', '_method'))
        );

        opcache_invalidate(App::langPath() . "/$locale/$group.php");

        return back();
    }

    /**
     * Get the text groups.
     */
    protected function getGroups(): array
    {
        return collect(scandir(App::langPath() . '/' . App::getLocale()))
            ->diff(['.', '..', 'validation.php'])
            ->map(function ($filename) {
                return str_replace('.php', '', $filename);
            })
            ->all();
    }
}
