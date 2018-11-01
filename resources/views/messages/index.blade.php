@extends('layouts.panel')

@section('panel')
    <h1>Hello, Vue!</h1>
    {{--<example-component></example-component>--}}
    <message :messages="messages"></message>
    <sent-message v-on:messagesent="addMessage" :user="{{ auth()->user() }}"></sent-message>
@endsection