    <div id="plist" class="people-list ">
        <div class="border-bottom">
            <ul class="list-unstyled chat-list">
                <li class="clearfix">
                    <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ auth()->user()->name }}"
                        alt="avatar">
                    <div class="about pt-2">
                        <div class="name">{{ auth()->user()->name }}</div>
                    </div>
                </li>
            </ul>
        </div>
        <ul class="list-unstyled chat-list mt-2 mb-0">
            @if (count($conversations) > 0)
                @foreach ($conversations as $conversation)
                    <li class="clearfix" wire:key='{{ $conversation->id }}'
                        wire:click="$emit('chatUserSelected', {{ $conversation }},{{ $this->getChatUserInstance($conversation, $name = 'id') }})">
                        <img src="https://ui-avatars.com/api/?name={{ $this->getChatUserInstance($conversation, $name = 'name') }}"
                            alt="avatar">
                        <div class="about">
                            <div class="name">{{ $this->getChatUserInstance($conversation, $name = 'name') }}</div>
                            <div class="status"> <i class="fa fa-circle offline"></i>
                                {{ $conversation->messages->last()?->created_at->shortAbsoluteDiffForHumans() }} </div>
                        </div>
                    </li>
                @endforeach
            @else
                You have no conversation
            @endif
        </ul>
    </div>
