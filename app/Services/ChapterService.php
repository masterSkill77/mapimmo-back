<?php

namespace App\Services;
use App\Models\Chapter;
use App\Services\IService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ChapterService{

    public function store($data) : Chapter
    {
        return Chapter::create($data);
    }

    public function getById(int $chapterId): Chapter
    {
        return  Chapter::with('lessons')->where('id', $chapterId)->first();
    }


    public function getAll() :Collection
    {
        return Chapter::with('lessons')->get();
    }

    public function update($data, int $chapterId) : int{

        return Chapter::where('id', $chapterId)->update($data);
    }

    public function delete($chapterId): string
    {
        return Chapter::where('id', $chapterId)->delete();
    }

    public function chapterGetById(int $chapterId): ?Chapter
    {
        return Chapter::find($chapterId);
    }
    
}
