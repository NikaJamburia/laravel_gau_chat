@extends('layouts.app')

@section('content')
<ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link <?php if(!isset($_GET['action'])){echo "active";} ?>" data-toggle="tab" href="#friendsList">Frieds List</a></li>
    <li class="nav-item">
        <a class="nav-link <?php if(isset($_GET['action']) && $_GET['action'] == 'req'){echo "active";} ?>" data-toggle="tab" href="#requests">Friend Requests
            @if(count($friend_requests) > 0)
                <span class="badge badge-danger">{{count($friend_requests)}}</span>
            @endif
        </a>
    </li>
    <li class="nav-item"> <a class="nav-link <?php if(isset($_GET['action']) && $_GET['action'] == 'add'){echo "active";} ?>" data-toggle="tab" href="#add">Add Friend</a></li>
</ul>

<div class="tab-content mt-3">

    <div id="friendsList" class="tab-pane fade-in <?php if(!isset($_GET['action'])){echo "active";} ?>">
        <h3>Your Friends ({{count($friends)}})</h3>
        <hr>
        <div class="d-flex justify-content-between flex-wrap">
            @foreach ($friends as $friend)
                <div class="p-3 border rounded w-25 mr-2 mb-2">
                    @if($friend->user_1_id != Auth::user()->id)
                    {{$friend->user1->name}}
                    @else
                    {{$friend->user2->name}}
                    @endif
                    
                    <br>
                    <small>Friends Since: {{date('d-m-y', strtotime($friend->created_at))}} </small>
                </div>
            @endforeach
        </div>
    </div>

    <div id="requests" class="tab-pane fade-in <?php if(isset($_GET['action']) && $_GET['action'] == 'req'){echo "active";} ?>">
        <h3>Friend Requests</h3>
        <hr>
        @if(count($friend_requests) > 0)
            @foreach ($friend_requests as $request)

            <div class="card mt-2">
                <div class="card-header">
                    <p>{{$request->created_at}}</p>
                </div>
                <div class="card-body">
                    <p>
                        <b>{{$request->user1->name}}</b>
                        Has sent you a friend request
                    </p>
    
                    {!!Form::open(['method' => 'post', 'action' => 'FriendsController@acceptRequest', 'id' => 'approveForm', 'class' => 'form d-inline-block'])!!}
                        {{Form::hidden('chat_id', $request->id)}}
                        {{Form::submit('Accept', ['name' => 'approveRequest', 'class' => 'btn btn btn-success d-inline-block'])}}
                    {!!Form::close()!!}
    
                    {!!Form::open(['method' => 'post', 'action' => 'FriendsController@declineRequest', 'id' => 'disapproveForm', 'class' => 'form d-inline-block'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::hidden('chat_id', $request->id)}}
                        {{Form::submit('Decine', ['name' => 'disapproveRequest', 'class' => 'btn btn btn-danger d-inline-block'])}}
                    {!!Form::close()!!}
                </div>
            </div>

            @endforeach
        @else
            <p>No friend requests</p>
        @endif
    </div>

    <div id="add" class="tab-pane fade-in <?php if(isset($_GET['action']) && $_GET['action'] == 'add'){echo "active";} ?>">
        <h3>Search for a friend</h3>
        <hr>

        {!!Form::open(['method' => 'post', 'action' => ['FriendsController@searchByName', ''], 'id' => 'searchForm', 'class' => 'form'])!!}
            <div class="form-group row">
                <div class="col-md-10 col-sm-8">
                    {{Form::text('searchedFriend', '', ['id' => 'searchField', 'class' => 'form-control', 'placeholder' => 'Name'])}}
                </div>

                <div class="col-md-2 col-sm-4 mt-2 mt-sm-0">
                    {{Form::submit('Search', ['name' => 'search', 'id' => 'searchbtn', 'class' => 'btn btn-primary form-control'])}}                    
                </div>
            </div>
        {!!Form::close()!!}

        <div id="searchResults"></div>
    </div>



</div>

</div>

<script src="{{asset('js/search.js')}}"></script>

@endsection