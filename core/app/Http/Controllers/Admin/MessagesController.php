<?php

namespace App\Http\Controllers\Admin;

use App\Message;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    public $messageModel;

    public function __construct(Message $message)
    {
        $this->messageModel = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = $this->messageModel->all();
        $empty_message = 'No messages to show!';

        $page_title = 'Messages Management';
        return view('admin.messages.index', compact('messages', 'page_title', 'empty_message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create Message";
        return view('admin.messages.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->except('image', '_token', 'status');
        $data['status'] = $request->status == 'on' ? 1 : 0;
        $data['picture_1'] = uniqid() . time() . '.' . $request->file('image')->clientExtension();
        $request->file('image')->move(config('constants.product_image_path'), $data['picture_1']);
        $this->messageModel->create($data);
        session()->flash('notify', [['success', 'Message created!']]);
        return redirect()->route('admin.messages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        $page_title = "Message";
        return view('admin.messages.show', compact('page_title', 'message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = $this->messageModel->findOrFail($id);
        $page_title = "Edit Message";
        return view('admin.messages.edit', compact('page_title', 'message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateRequest($request, true);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $message = $this->messageModel->findOrFail($id);
        $data = $request->except('_method', '_token', 'image', 'status');
        $data['status'] = $request->status == 'on' ? 1 : 0;
        if ($request->hasFile('image')) {
            $data['picture_1'] = uniqid() . time() . '.' . $request->file('image')->clientExtension();
            $request->file('image')->move(config('constants.product_image_path'), $data['picture_1']);
            if (file_exists(config('constants.product_image_path') . '/' . $message->images)) {
                unlink(config('constants.product_image_path') . '/' . $message->images);
            }
        }
        $message->update($data);
        session()->flash('notify', [['success', 'Message updated!']]);
        return redirect()->to(route('admin.messages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = $this->messageModel->findOrFail($id);
        if (file_exists(get_image(config('constants.product_image_path') . '/' . $message->images))) {
            unlink(config('constants.product_image_path') . '/' . $message->images);
        }
        $message->delete();
        return redirect()->route('admin.messages.index');
    }

    private function validateRequest($request, $image_optional = false)
    {

        $rule = $image_optional == true ? 'sometimes|' : '';
        return Validator::make(
            $request->all(),
            [
                'title' => 'required|string|min:3',
                'target' =>  'required',
                'status'   =>  'sometimes',
                'body_1'   =>  'required|string|max:3000',
                'image' => $rule . 'image|mimes:jpeg,png,jpg|max:2048'
            ]
        );
    }
}
