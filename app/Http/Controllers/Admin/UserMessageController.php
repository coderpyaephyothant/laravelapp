<?php

namespace App\Http\Controllers\Admin;

use App\Models\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\Translation\Provider\Dsn;

class UserMessageController extends Controller
{
    //userMessage
    public function index(){
        $messageData = SendMessage::select('send_messages.*','users.name','users.email','users.phone','users.address')
                        ->join('users','users.id','send_messages.author_id')
                        ->orderBy('message_id','desc')
                        ->paginate(6);
                        // dd($messageData->toArray());
                        // dd(count($messageData));

    if(count($messageData) == 0){
        $msgNumber = 0;
    }else{
        $msgNumber = 1;
    }
        return view('admin.message.message')->with(['messageData' => $messageData , 'msgNumber'=>$msgNumber]);
    }



    //messageSearch
    public function messageSearch(Request $request){
        $searchKey = $request->messageSearch;
        if ($request->messageSearch == null) {
            return redirect()->route('admin#message');
          }
        $messageData =  SendMessage::join('users','author_id','=','users.id')
                        ->select('send_messages.*','users.name','users.address','users.phone','users.email')
                        ->where(function ($query) use($searchKey) {
                            $query->orWhere('name','Like','%'.$searchKey.'%')
                            ->orWhere('email','Like','%'.$searchKey.'%')
                            ->orWhere('address','Like','%'.$searchKey.'%')
                            ->orWhere('phone','Like','%'.$searchKey.'%')
                            ->orderBy('message_id','desc');

                        })

                        ->paginate(3);

                        // dd($messageData->toArray());


                        if(count($messageData) == 0){
                            $msgNumber = 0;
                        }else{
                            $msgNumber = 1;
                        }

        return view('admin.message.message')->with(['messageData' => $messageData , 'msgNumber'=>$msgNumber]);


       
    }
}
