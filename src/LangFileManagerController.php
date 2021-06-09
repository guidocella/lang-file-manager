<?php

namespace GuidoCella;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class LangFileManagerController extends Controller
{
    /**
     * List the text groups.
     */
    public function index(): View
    {
        return view('lang-file-manager::index', ['currentLocale' => app()->getLocale(), 'groups' => $this->getGroups()]);
    }

    /**
     * Edit a text group.
     */
    public function edit(string $currentLocale, string $currentGroup): View
    {
        $groups = $this->getGroups();

        abort_if(!in_array($currentGroup, $groups), 404);

        return view('lang-file-manager::edit', compact('currentLocale', 'currentGroup', 'groups'));
    }

    /**
     * Update a text group.
     */
    public function update(Request $request, string $locale, string $group): RedirectResponse
    {
        File::putArray(
            app('path.lang')."/$locale/$group",
            array_map(fn ($input) => $input === null ? '' : $input, $request->except('_token'))
            // If we save blank lines as null instead of '' the default locale's line will be shown.
        );

        opcache_invalidate(app('path.lang')."/$locale/$group.php");

        return back()->with('success', 'Testi aggiornati.');
    }

    /**
     * Get the text groups.
     */
    protected function getGroups(): array
    {
        return collect(File::files(app('path.lang').'/'.app()->getLocale()))
            ->reject->isLink()
            ->map->getBasename('.php')
            ->diff(['auth', 'pagination', 'passwords', 'validation'])
            ->all()
        ;
    }
}
