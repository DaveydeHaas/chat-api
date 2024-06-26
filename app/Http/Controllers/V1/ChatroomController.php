<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatroomResource;
use App\Models\ChatMessage;
use App\Models\Chatroom;
use App\Models\ChatroomUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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
        $user = $request->user();
    
        // Load all chatrooms with their users
        $chatrooms = Chatroom::where('enabled', 1)->with('users')->get();
    
        // Check if the user is already a member in every chatroom
        if ($user) {
            foreach ($chatrooms as $chatroom) {
                $isMember = $chatroom->users->contains('id', $user->id);
    
                if ($isMember) {
                    // Filter users to include only the authenticated user
                    $chatroom->users = $chatroom->users->filter(function ($u) use ($user) {
                        return $u->id === $user->id;
                    });
                } else {
                    // If user is not a member, clear the users collection
                    $chatroom->users = collect([]);
                }
            }
        }
    
        // Return the chatrooms using ChatroomResource
        return ChatroomResource::collection($chatrooms);
    }

    /**
     * Joins the given chatroom
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChatroomById(Request $request, $id)
    {
        $chatroom = Chatroom::with(['users','messages.user'])->find($id);

        if (!$chatroom) {
            return response()->json(['message' => 'Chatroom not found.'], 404);
        }

        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $isMember = $user->chatrooms()->where('chatrooms.id', $id)->exists();

        if (!$isMember) {
            return response()->json(['message' => 'User is not linked with this chatroom.'], 403);
        }

        return new ChatroomResource($chatroom);
    }

    /**
     * Joins the given chatroom
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function joinChatroomById(Request $request, $id)
    {
        $user = json_decode($request->user);
        // Check if the user is already a member of the chatroom
        $existingMembership = ChatroomUser::where('user_id', $user->id)
                                          ->where('chatroom_id', $id)
                                          ->exists();

        if ($existingMembership) {
            return response()->json([
                'message' => 'User is already a member of the chatroom.'
            ], 422);
        }

        // Needs rework if chatroom is private
        ChatroomUser::create([
            'user_id' => $user->id,
            'chatroom_id' => $id,
            'is_admin' => 0,
            'accepted' => 1,
            'joined_at' => now(),
            'left_at' => null,
            'banned' => 0
        ]);

        return response()->json([
            'message' => 'User joined the chatroom successfully.'
        ], 200);
    }

    /**
     * Saves a message
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveMessage(Request $request)
    {
        $message = $request->message;

        ChatMessage::create([
            'chatroom_id' => $message['chatroomId'],
            'user_id' => $message['userId'],
            'message' => $message['text'],
        ]);

        return response()->json([
            'message' => 'Message saved succesfully.'
        ], 200);
    }    

    /**
     * Creates a new chatroom
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createChatroom(Request $request)
    {
        $user = $request->user();
        $data = $request->data;

        $chatroom = Chatroom::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'is_private' => $data['is_private'],
            'enabled' => $data['enabled'],
            'key' => Str::random(32),
        ]);

        ChatroomUser::create([
            'user_id' => $user->id,
            'chatroom_id' => $chatroom->id,
            'is_admin' => 1,
            'accepted' => 1,
            'joined_at' => now(),
            'left_at' => null,
            'banned' => 0
        ]);

        return new ChatroomResource($chatroom);
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


