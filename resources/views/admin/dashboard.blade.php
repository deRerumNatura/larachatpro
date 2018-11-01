@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body d-flex flex-column">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in as admin!
                        <div class="admin-panel-container d-flex align-items-center flex-column">
                            {{ link_to_action('MessagesController@index', $title = 'TO CHAT ROOM') }}

                            <ul class="list-group w-100">
                                @foreach($users as $user)
                                <a class="list-group-item w-100">
                                    <div class="bmd-list-group-col d-flex flex-row justify-content-around w-100 align-items-center">
                                        <p class="list-group-item-heading m-0 pr-5 w-25">{{ $user->name }}</p>
                                        <div class="actions-with-users pl-5 d-flex">
                                            @if($user->disabled === 0)
                                                {{ link_to_action('Admin\AdminController@store', $title = 'disable',
                                                                                           $parameters = ['id' => $user->id, 'disabled' => 1, 'baned' => 0],
                                                                                           $attributes = ['class' => 'btn btn-raised btn-secondary mr-5'])
                                                }}
                                            @else
                                                {{ link_to_action('Admin\AdminController@store', $title = 'enable',
                                                                                           $parameters = ['id' => $user->id, 'disabled' => 0, 'baned' => 0],
                                                                                             $attributes = ['class' => 'btn btn-raised btn-success mr-5'])
                                                }}
                                            @endif
                                            @if($user->baned === 0)
                                                {{ link_to_action('Admin\AdminController@store', $title = 'ban',
                                                                                           $parameters = ['id' => $user->id, 'baned' => 1, 'disabled' => 0],
                                                                                           $attributes = ['class' => 'btn btn-raised btn-danger mr-5'])
                                                }}
                                            @else
                                                {{ link_to_action('Admin\AdminController@store', $title = 'dilute',
                                                                                           $parameters = ['id' => $user->id, 'baned' => 0, 'disabled' => 0],
                                                                                           $attributes = ['class' => 'btn btn-raised btn-info mr-5'])
                                                }}
                                            @endif
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection