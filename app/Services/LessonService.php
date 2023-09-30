<?php

namespace App\Services;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Collection;
use App\Services\IService;

class LessonService implements IService
{
    public function store($data): Lesson
    {
        return Lesson::create($data);
    } 

    public function getAll() :Collection
    {
        return Lesson::all();
    }

    public function getById(int $lessonId) : Lesson
    {
        return Lesson::findOrFail($lessonId);
    }
    
    public function update($data, int $lessonId) : Lesson{
        
        return Lesson::where('id', $lessonId)->update($data);
    }

    public function delete($lessonId) :Lesson
    {

        return Lesson::where('id', $lessonId)->delete();
    } 
}