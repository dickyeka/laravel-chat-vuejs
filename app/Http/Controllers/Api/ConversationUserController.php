<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Transformers\ConversationTransformer;

class ConversationUserController extends Controller
{
    public function store(Conversation $conversation,Request $request)
    {
        $this->authorize('affect', $conversation);

        $conversation->users()->syncWithoutDetaching($request->recipients);
        $conversation->load(['users']);

        return fractal()
            ->item($conversation)
            ->parseIncludes(['user', 'users'])
            ->transformWith(new ConversationTransformer)
            ->toArray();


    }
}
