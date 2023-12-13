<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat\Conversation;
use App\Models\Chat\Message;
use App\Models\User;
use Livewire\Component;

class SendMessage extends Component
{
    public $selectedConversation;
    public $receiverInstance;
    public $body;
    public $createdMessage;

    protected $listeners = ['updateSendMessage'];

    function updateSendMessage(Conversation $conversation, User $receiver)
    {

        // dd($conversation, $receiver);
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;
    }

    public function sendMessage()
    {
        if ($this->body == null) {
            return null;
        }

        $this->createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverInstance->id,
            'body' => $this->body,
        ]);

        $this->selectedConversation->last_time_message = $this->createdMessage->created_at;
        $this->selectedConversation->save();
        $this->emitTo('chat.chatbox', 'pushMessage', $this->createdMessage->id);


        // //reshresh coversation list
        $this->emitTo('chat.chat-list', 'refresh');
        $this->reset('body');

        // $this->emitSelf('dispatchMessageSent');
        // dd($this->body);
    }


    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
