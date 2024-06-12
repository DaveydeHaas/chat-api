<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatroomResource;
use App\Models\Chatroom;
use Illuminate\Http\Request;

class ChatroomController extends Controller
{
   /**
     * Retrieves all enabled chatrooms
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $chatrooms = Chatroom::where('enabled', 1)->get();
        return ChatroomResource::collection($chatrooms);
    }

    /**
     * Creates a new chatroom
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createChatroom(Request $request)
    {
        // TODO
    }

    /**
     * Retrieves chatrooms that the user has joined
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function joinedChatrooms(Request $request)
    {
        // TODO
    }
}


