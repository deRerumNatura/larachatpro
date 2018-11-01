@extends('layouts.panel')

@section('panel')
    <message :messages="messages"></message>
    <sent-message v-on:messagesent="addMessage" :user="{{ auth()->user() }}"></sent-message>
@endsection