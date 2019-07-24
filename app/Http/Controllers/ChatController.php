<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
use App\Domaine;
use App\Sousdomaine;
use App\Discussion;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChatRequest;

class ChatController extends Controller
{
    /* Dans cette fonction $users est défini comme admin
        et $user_id est défini comme utilisateur connecté
    */
    public function index()
    {

        $users = User::where('is_admin',1)->get() ;//$admins
        $user_id = Auth::id(); //$user connecté
        $msg_not_reads = new Discussion();
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        //dd($users);
        foreach ($users as $user ) {
            $chats = $this->select_chat($user->id,$user_id);
           // dd($chats);
            foreach ($chats as $chat ) {

                if ($user->id == $user_id){
                    $liste = User::where('is_admin',0)->get();
                    $not_read = new Discussion();
                    $chat = new ChatController();

                    //dd($liste);
                    return view('chat/liste',compact('liste','not_read','user_id','chat','msg_not_reads','doms','sous_doms'));
                } else {
                    $this->add_chat();
                    $chat_id = $chat->id;
                    $messages = Discussion::where('chat_id', $chat_id)->get();
                    $this->update_messages_non_lus($chat_id,$user->id);
                    $this->update_tous_les_messages_non_lus($user->id);
                    return view('chat/index',compact('users','messages','chat_id','msg_not_reads','doms','sous_doms'));
                }
            }
        }
    }

    public function add_user_message(ChatRequest $request)
    {
        //$this->add_chat();
        $user_id = Auth::id();

        $admins = User::where('is_admin',1)->get() ;
        foreach ($admins as $admin ) {
            if ($user_id != $admin->id) {
                $chats = $this->select_chat($admin->id,$user_id);
                foreach ($chats as $chat ) {
                    Discussion::create([
                        'chat_id' => $chat->id,
                        'user_id' => $user_id,
                        'message' => $request->get('message')
                    ]);
                }
            }

        }
        return  redirect('chat/');
    }

    public function add_admin_message(ChatRequest $request,$user_id)
    {
        $chat_id = $this->select_admin_chat($user_id)->first()->id;
        Discussion::create([
            'chat_id' => $chat_id,
            'user_id' => Auth::id(),
            'message' => $request->get('message')
        ]);
        return redirect("chat/view/$user_id");
    }

    public function view_message($user_id)
    {
        $users = User::where('is_admin',1)->get() ;
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $utilisateur = new User();
        $admin_id = Auth::id();
        $chat_id = $this->select_admin_chat($user_id)->first()->id;
        $messages = Discussion::where('chat_id',$chat_id)->get();
        $msg_not_reads = new Discussion();
        //->where('user_id',$list->id)->where('is_read',0)->where('chat_id',$chat->select_admin_chat($list->id)->first()->id)
        $this->update_messages_non_lus($chat_id,$user_id);
        return view('chat/admin_msg',compact('users','messages','chat_id','user_id','msg_not_reads','doms','sous_doms'));
    }

    protected function add_chat()
    {
        $admins = User::where('is_admin',1)->get() ;
        $user_id = Auth::id();
        foreach ($admins as $admin) {
            Chat::firstOrCreate( ['topic' => 'chat '.$admin->id.$user_id]);
        }
    }
    protected function select_chat($admin_id,$user_id)
    {
        $chat = Chat::where('topic','chat '.$admin_id.$user_id)->get();
       // dd($chat);
        return $chat;
    }

    public function select_admin_chat($user_id)
    {
        return Chat::where('topic', 'chat '.Auth::id().$user_id)->get();
    }

    public function update_messages_non_lus($chat_id,$user_id)
    {
        //dd($chat_id);
        Discussion::where('chat_id',$chat_id)->where('user_id',$user_id)->update(['is_read' => 1]);
    }

    public function update_tous_les_messages_non_lus($user_id)
    {
        Discussion::where('user_id',$user_id)->update(['is_read' => 1]);
    }

}
