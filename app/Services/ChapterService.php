<?php

namespace App\Services;
use App\Models\Chapter;
use App\Services\IService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ChapterService implements IService{

    public function store($data) : Chapter
    {
        return Chapter::create($data);
    } 

    public function getById(int $collectionId): Chapter
    {
        return  Chapter::where('id', $collectionId)->first();
    }


    public function getAll() :Collection
    {
        return Chapter::all();
    }

}