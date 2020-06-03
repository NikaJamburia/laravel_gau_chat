@extends('layouts.app')

@section('content')
 <h1>Your Notifications</h1>
 <hr>
@if (count($nots) > 0)
    @foreach ($nots as $not)
    <div class="card mt-3">
        <div class="card-body">
        <div class="clearfix">
            <div class="float-left">
                {!!$not->body!!}
                <a class="ml-3" href="{{$not->link}}">view</a>
            </div>
            <div class="float-right">
                <a onclick="sendHideReq(event)" id="{{$not->id}}" href="">Hide notification</a>
            </div>
        </div>
            <br>
            <small>{{$not->created_at->diffForHumans()}}</small>
        </div>
        {!!Form::open(['method' => 'post', 'action' => 'NotificationsController@hide', 'id' => "hideForm".$not->id, 'class' => 'form'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::hidden('not_id', $not->id)}}
        {!!Form::close()!!}
    </div>
    @endforeach
@else
    <p>No Notifications</p>
@endif
 


<script src="{{asset('js/nots.js')}}"></script>
@endsection