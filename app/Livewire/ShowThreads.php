<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Thread;

class ShowThreads extends Component
{
    public $search = '';
    public $category = '';

    public function filterByCategory($category){
        $this->category = $category;
    }

    public function render()
    {
        $categories = Category::get();
        $threads = Thread::query();
        $threads->where('title', 'like', "%$this->search%");
        if($this->category)
        {
            $threads->where('category_id', $this->category);
        }
        $threads->with('user','category');
        $threads->withCount('replies');
        $threads->latest();
        return view('livewire.show-threads', ['categories' => $categories,'threads' => $threads->get()]);
    }
}