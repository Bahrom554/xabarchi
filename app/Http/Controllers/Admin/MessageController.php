<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        $messages = Message::orderBy('created_at', 'DESC')->paginate(30);
        return view('admin.message.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name'   => 'nullable',
            'email'  => 'nullable|email',
            'url' => 'nullable',
            'subject' => 'nullable',
            'body' => 'required'
        ];
        $message = [
            'body.required' => " Your message can't be empty"
        ];
        $this->validate($request, $rules, $message);
        $input = $request->all();
        Message::create($input);
        return redirect()->route('upost.index');
    }

    public function show(Message $message)
    {

        return view('admin.message.show', compact('message'));
    }



    public function destroy(Message $message)
    {
        $message->delete();
        return  redirect(route('message.index'))->with('message', 'deleted');
    }
}
