@extends('lorion/template')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($liste as $list)
            <tr>
                <td scope="row"> {{$list->name}} </td>
                <td> {{ $list->email }} </td>

                <td> <a href=" {{ url("chat/view/$list->id") }} " class="btn btn-info">Discussion <button class="btn">
                     <span class="badge badge-danger">{{ $not_read->where('user_id',$list->id)->where('is_read',0)->where('chat_id',$chat->select_admin_chat($list->id)->first()->id)->count() }}</span>
                </button></a>

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

@endsection
