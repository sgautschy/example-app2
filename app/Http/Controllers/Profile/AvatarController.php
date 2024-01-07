<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;


class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {

        $path = Storage::disk('public')->put('avatars', $request->file('avatar'));
        if($oldAvatar = $request->user()->avatar){
            Storage::disk('public')->delete($oldAvatar );
        }
        auth()->user()->update(['avatar'=> $path]);

        return redirect(route('profile.edit'))->with(['message' => 'Success - image is saved']);
        
    }
    public function generate(Request $request)
    {
       
       $result = OpenAI::images()->create([
            "model" => "dall-e-3",
            "prompt" => "create single avatar for user in tech world with cool animated style with the name ".auth()->user()->name." without any words in the image",
            "n" => 1,
            "size" => "1024x1024",
            "quality" => "standard",
    
        ]);
        
        
        $contents = file_get_contents($result->data[0]->url);
        $filename = Str::random(25);
        $path = Storage::disk('public')->put("avatars/$filename.png", $contents);
        if($oldAvatar = $request->user()->avatar){
            Storage::disk('public')->delete($oldAvatar );
        }
        auth()->user()->update(['avatar'=> "avatars/$filename.png"]);
        return redirect(route('profile.edit'))->with(['message' => 'Success - image is saved']);
        
    }
}
