<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat\Conversation;
use App\Models\Chat\Message;
use App\Models\User;
use Livewire\Component;

class Chatbox extends Component
{
    public $selectedConversation;
    public $receiver;
    public $receiverInstance;
    public $messages_count;
    public $messages;
    public $paginateVar = 10;
    public $height;

    protected $listeners = ['loadConversation', 'pushMessage'];

    public function pushMessage($messageId)
    {
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);
        $this->dispatchBrowserEvent('rowChatToBottom');
    }

    public function loadConversation(Conversation $conversation, User $receiver)
    {
        // dd($conversation, $receiver);
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;

        $this->messages_count = Message::where('conversation_id', $this->selectedConversation->id)->count();
        $this->messages = Message::where('conversation_id',  $this->selectedConversation->id)
            ->skip($this->messages_count -  $this->paginateVar)
            ->take($this->paginateVar)->get();

        // $this->dispatchBrowserEvent('chatSelected');

        // Message::where('conversation_id', $this->selectedConversation->id)
        //     ->where('receiver_id', auth()->user()->id)->update(['read' => 1]);

        // $this->emitSelf('broadcastMessageRead');
    }
    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
