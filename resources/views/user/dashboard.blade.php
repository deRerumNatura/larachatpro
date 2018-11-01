@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body d-flex justify-content-center flex-column align-items-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in as user!
                        <div class="card w-50 d-flex flex-column justify-content-center align-items-center">
                            <div class="card-body">
                                @if($user->baned === 1)
                                    <h3>You are baned!</h3>
                                @elseif($user->disabled === 1)
                                    <h3>You are disabled!</h3>
                                @else
                                    {{ link_to_action('MessagesController@index', $title = 'TO CHAT ROOM') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection