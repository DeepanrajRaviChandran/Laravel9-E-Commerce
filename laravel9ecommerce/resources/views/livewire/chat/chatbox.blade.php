<div>
    <style>
        .input-group-text {
            height: 47px !important;
        }
    </style>

    @if ($selectedConversation)
        <div class="chat-header clearfix border-bottom">
            <div class="row">
                <div class="col-lg-6 flex-horizontal-center">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                        <img src="https://ui-avatars.com/api/?name={{ $receiverInstance->name }}" alt="avatar">
                    </a>
                    <div class="chat-about">
                        <h4 class="m-b-0">{{ $receiverInstance->name }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-history">
            <ul class="m-b-0">
                @foreach ($messages as $message)
                    @if (auth()->id() == $message->sender_id)
                        <li class="clearfix">
                            <div class="message-data text-end">
                                <span class="message-data-time"> {{ $message->created_at->format('m: i a') }}</span>
                            </div>
                            <div wire:key='{{ $message->id }}' class="message other-message">
                                {{ $message->body }}
                            </div>
                        </li>
                    @else
                        <li class="clearfix">
                            <div class="message-data">
                                <span class="message-data-time"> {{ $message->created_at->format('m: i a') }}</span>
                            </div>
                            <div wire:key='{{ $message->id }}' class="message my-message">
                                {{ $message->body }}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @else
        <div class="fs-4 text-center text-primary mt-5">
            No Conversation Selected
        </div>
    @endif
</div>
