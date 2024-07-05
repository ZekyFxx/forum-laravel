<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reply;

class ShowReply extends Component
{
    public Reply $reply;
    public $body = '';
    public $is_creating = false;
    public $is_editing = false;

    public function updatedIsCreating()
    {
        $this->is_editing = false;
        $this->body = '';
    }

    public function updatedIsEditing()
    {
        $this->authorize('update', $this->reply);
        $this->is_creating = false;
        $this->body = $this->reply->body;
    }

    public function updateReply()
    {
        $this->authorize('update', $this->reply);
        //Validar datos
        $this->validate(['body' => 'required']);

        //Actualización de datos
        $this->reply->update([
            'body' => $this->body
        ]);

        //Refresh
        $this->is_editing = false;
        $this->body = '';
    }

    public function postChild()
    {
        if(!is_null($this->reply->reply_id)) return;
        //Validar datos
        $this->validate(['body' => 'required']);

        //Creación de datos
        auth()->user()->replies()->create([
            'reply_id' => $this->reply->id,
            'thread_id' => $this->reply->thread->id,
            'body' => $this->body
        ]);

        //Refresh
        $this->is_creating = false;
        $this->body = '';
    }

    public function render()
    {
        return view('livewire.show-reply');
    }
}
