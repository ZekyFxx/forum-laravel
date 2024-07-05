<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Thread;

class ShowThread extends Component
{
    public Thread $thread;

    public $body = '';

    public function postReply()
    {
        //Validar datos
        $this->validate(['body' => 'required']);

        //Creación de datos
        auth()->user()->replies()->create([
            'thread_id' => $this->thread->id,
            'body' => $this->body
        ]);

        //Refresh
        $this->body = '';
    }

    public function render()
    {
        return view('livewire.show-thread',[
            'replies' => $this->thread->
            replies()
            ->whereNull('reply_id')
            ->with('user','replies.user','replies.replies')
            ->get()]);
    }
}
