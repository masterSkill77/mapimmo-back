<?php

namespace App\Services;

use App\Models\Chapter;
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
        return Chapter::with('lessons')->get();
    }

    public function getById(int $lessonId) : Lesson
    {
        return Lesson::findOrFail($lessonId);
    }
    
    public function update($data, int $lessonId): Lesson{
        
        $lesson = Lesson::findOrFail($lessonId);
        $lesson->update($data);
        return $lesson;
    }

    public function delete($lessonId) :Lesson
    {

        return Lesson::where('id', $lessonId)->delete();
    } 
}