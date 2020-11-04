<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class LikePost extends Component
{
    public $post_id;
    public $love;

    public function giveLove (Post $post) {

        $post->update([
            'love' => $post->love + 1,
        ]);
        $post->save();

        $this->love = $post->love;
        return $this->love;
    }

    public function render()
    {
        return view('livewire.like-post', [
            'post_id' => $this->post_id,
            'love' => Post::findOrFail($this->post_id)->love,
        ]);
    }
}
