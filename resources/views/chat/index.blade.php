@extends('lorion/template')

@section('content')
    <div>
        <div class="row container-fluid">

            <div class="col-md-5 offset-md-2 col-xs-5 offset-xs-2 chat-bottom-bar">
               {!! Form::open(['action' => 'ChatController@add_user_message']) !!}
                  <div class="form-group" >
                    <textarea class="form-control input-sm chat-input" name="message" placeholder="" rows="2" /></textarea>
                    @if ($errors->has('message'))
                        <div class="alert alert-danger">
                            {{ $errors->first('message') }}
                        </div>
                    @endif
                    <span class="input-group-btn">
                      <button class="btn btn-sm btn-success" id="send">
                        Envoyer
                      </button>
                    </span>
                  </div>

                {!! Form::close() !!}

            </div>

            <div class="msg-container col-md-12 col-xs-12">
                @foreach ($messages as $message)

                @if ($message->user->is_admin == 0)
                    <div class="col-md-5 offset-md-2 col-xs-5 offset-xs-2">
                        <div class="chat-msg box-blue">
                            <img class="profile" ng-src="" />
                            <p> {{ $message->message }} </p>
                            <div class="chat-msg-author text-right ">
                                <span> <strong>{{ $message->user->name }} </strong> </span><br>
                                <span class="date"> {{ $message->created_at }} </span>
                            </div>
                        </div>
                    </div>

                    @else
                        <div class="col-md-5 offset-md-2 col-xs-5 offset-xs-2">
                            <div class="chat-msg box-gray">
                                <img class="profile" ng-src="" />
                                <p>{{ $message->message }}</p>
                                <div class="chat-msg-author">
                                    <strong> Admin </strong>&nbsp; <br>
                                    <span class="date"> {{ $message->created_at }} </span>
                                </div>
                            </div>
                        </div>
                @endif

                @endforeach

              <!--<div class="col-md-12 col-xs-12">
                  <div class="chat-msg box-gray">
                      <img class="profile" ng-src="" />
                      <p>Content</p>
                      <div class="chat-msg-author">
                          <strong>Rudman</strong>&nbsp;
                          <span class="date">Fecha</span>
                      </div>
                  </div>
              </div>-->
            </div>

        </div>
    </div>
@endsection
