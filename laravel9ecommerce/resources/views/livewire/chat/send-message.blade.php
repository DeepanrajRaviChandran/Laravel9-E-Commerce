<div>
    @if ($selectedConversation)
        <form wire:submit.prevent='sendMessage' action="">
            <div class="chat-message clearfix">
                <div class="input-group mb-0">
                    <div class="input-group-prepend">
                        <button type="submit" style="all: initial">
                            <span class="input-group-text"><i class="fa fa-send"></i></span>
                        </button>
                    </div>
                    <input wire:model='body' type="text" class="form-control" placeholder="Enter text here...">
                </div>
            </div>
        </form>
    @endif
</div>
