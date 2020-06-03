
@extends('layouts.app')

@section('content')

    <input type="hidden" id="user_id" value="{{Auth::user()->id}}">

    <div style="padding:0" class="border rounded row chatContainer">
        <div class="col-4  py-2 w-100 friends-container">
            <h4>Contacts:</h4>
            <hr>

            @if(count($chats) > 0)

                @foreach($chats as $chat)

                    <div id="{{$chat->id}}" onclick="showChat(event)" class="w-100 border-top border-bottom p-2 mb-1 font-weight-bold contacts-box">
                        <h5>
                            @if($chat->user_1_id != Auth::user()->id)
                                {{$chat->user1->name}}
                            @else
                                {{$chat->user2->name}}
                            @endif
                        </h5>
                        <div id="flex{{$chat->id}}" class="d-flex justify-content-between ">

                            <small class="last-msg">
                                @if($chat->last_message->status == 'Unseen' && $chat->last_message->sender_id != Auth::user()->id)
                                    <strong>
                                    <?="<script>"?>
                                            <?="document.getElementById('".$chat->id."').setAttribute('unseen', 'yes')"?>
                                    <?="</script>"?>
                                @endif
                                {{$chat->last_message->body}}
                                @if($chat->last_message->status == 'Unseen' && $chat->last_message->sender_id != Auth::user()->id)
                                    </strong>
                                @endif
                            </small>
                            <small class="">
                                {{$chat->updated_at->diffForHumans()}}
                            </small>

                        </div>
                    </div>

                @endforeach

            @else

                <p>No Contacts</p>

            @endif

        </div>

        <div class="col-8 py-2 w-100 msg-container">
            <div id="msg-box" class="msg-box w-100 pr-2">
                <div class="msg-placeholder d-flex w-auto align-items-center justify-content-center flex-column">
                    <i class="fas fa-comment"></i>
                    <p> <i class="fas fa-arrow-left"></i> Select a chat</p>
                </div>
            </div>

            <div class="mt-2">
                {!!Form::open(['method' => 'post', 'action' => 'ChatController@store', 'id' => 'sendForm', 'class' => 'form row'])!!}
                    <div class="col-8 col-md-10">
                        {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Your message', 'rows' => '3', 'style' => 'resize:none !important;', 'id' => 'body', 'disabled'=>'true'])}}
                    </div>

                    {{Form::hidden('chat_id', '', ['id' => 'chat_id'])}}
                    {{Form::hidden('reciever_id', '', ['id' => 'reciever_id'])}}

                    <div class="col-4 col-md-2">
                        {{Form::submit('Send', ['name' => 'sendMsg', 'class' => 'btn btn btn-primary', 'id' => 'sendMsg', 'disabled'=>'true'])}}
                    </div>                    
                {!!Form::close()!!}
            </div>
        </div>
    </div>

<script src="{{asset('js/main.js')}}"></script>

@endsection