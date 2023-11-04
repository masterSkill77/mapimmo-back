<?php

namespace App\Services;

use App\Http\Requests\Theme\CreateThemRequest;
use App\Models\Theme;

class ThemeService
{
    public function store(CreateThemRequest $createThemRequest)
    {
        $theme =  new Theme($createThemRequest->toArray());
        $theme->save();
        return $theme;
    }

    public function getAllTheme()
    {
        return Theme::all();
    }

    public function getById(int $theme): ?Theme
    {
        return Theme::find($theme);
    }

    public function update(array $data, int $themeId): Theme
    {
        $theme = Theme::find($themeId);

        if (!$theme) {
            return null; 
        }
        $theme->fill($data);
        $theme->save();
    
        return $theme;
    }

    public function delete($theme): string
    {
        return Theme::where('id', $theme)->delete();
    }
}