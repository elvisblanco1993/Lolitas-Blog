<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display all posts
     */
    public function index () {
        return view('posts.index', [
            'posts' => Post::all()->sortByDesc('id'),
        ]);
    }

    /**
     * Store new post
     */
    public function save () {

        request()->validate([
            'title' => 'required|min:5',
            'body' => 'required|min:20',
            'featured_image' => 'required|mimes:png,jpg,jpeg',
        ]);

        $slug = Str::slug(request('title'), '-');

        $post = new Post([
            'slug' => $slug,
            'title' => request('title'),
            'body' => request('body'),
            'featured_image' => request('featured_image'),
            'featured_image_caption' => request('featured_image_caption'),
            'author_id' => auth()->user()->id,
            'comments' => (int) request()->comments,
        ]);

        // Store featured image
        request('featured_image')->store('images', 'public');
        $post->featured_image = request('featured_image')->hashName();

        $post->save();

        if ( ! is_null(request('tag')) && count( request('tag') ) > 0 ) {
            foreach ( request('tag') as $tag ) {
                $post->tags()->attach( DB::table('tags')->where('slug', $tag)->first()->id );
            }
        }

        return redirect('/post/'.$post->id.'/edit');
    }

    /**
     * Edit post
     */
    public function edit (Post $post) {
        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update post
     */
    public function update (Post $post) {

        request()->validate([
            'title' => 'required|min:5',
            'body' => 'required|min:20',
        ]);


        if ( count( DB::table('posts')
        ->where('slug', Str::slug( request('title'), '-' ))
        ->where('id', '!=', $post->id)
        ->get() ) == 1 ) {

            // Return with error code - slug already exists.
            return redirect('/post/'.$post->id.'/edit')->with('error', 'Another post has the same title as this one.');
        }

        $post->featured_image = request('featured_image');

        if ($post->featured_image) {
            if ($post->featured_image === $post->getOriginal('featured_image')) {

                $original_featured_image = $post->getOriginal('featured_image');
                Storage::disk('public')->delete('images/' . $original_featured_image);

            }

            request('featured_image')->store('images', 'public');
            $post->featured_image = request('featured_image')->hashName();
        } else {

            $post->featured_image = $post->getOriginal('featured_image');

        }

        $post->update([
            'slug' => Str::slug(request('title'), '-'),
            'title' => request('title'),
            'body' => request('body'),
            'featured_image' => $post->featured_image,
            'featured_image_caption' => request('featured_image_caption'),
            'author_id' => auth()->user()->id,
            'comments' => (int) request()->comments,
        ]);

        if ( ! is_null(request('tag')) && count( request('tag') ) > 0 ) {
            foreach ( request('tag') as $tag ) {
                $post->tags()->sync( DB::table('tags')->where('slug', $tag)->first()->id, false );
            }
        }

        return redirect('/post/'.$post->id.'/edit')->with('success', 'Changes saved.');
    }

    /**
     * Publish / Unpublish post
     */
    public function visibility (Post $post) {

        $status = $post->published == 0 ? 1 : 0;

        $publish_date = is_null( $post->publish_date ) ? Carbon::now()->toDateTimeString() : $post->publish_date;

        $post->update([
            'published' => $status,
            'publish_date' => $publish_date,
        ]);

        return redirect(route('posts'));
    }

    /**
     * List of posts
     */
    public function frontpage () {

        return view( 'front-page', [

            'posts' => Post::where('published', 1)->orderBy('publish_date', 'desc')->simplePaginate(6)

        ]);
    }

    /**
     * Display Single Post
     */
    public function single ($slug) {

        $post = Post::where('slug', $slug)->firstOrFail();
        $related_posts = Post::where('published', 1)->where('slug', '<>', $slug)->orderBy('publish_date', 'desc')->take(3)->get();

        $remote_ip = request()->getClientIp();

        // Add visit to database.
        $post->visitor_counter($post->id, $remote_ip);

        // Returns 404 if post not published
        if ((int)$post->published != 1) {
            abort(404, "This post does not exist or is currently not available");
        }

        return view('posts.single', [
            'post' => $post,
            'views' => $post->count,
            'related' => $related_posts,
        ]);
    }

    /**
     * Filter By Tag
     */
    public function filter_by_tag ($tag) {

        return view( 'posts.display-filtered-list', [
            'posts' => Tag::where('slug', $tag)->firstOrFail()->posts()->where('published', 1)->get(),
        ]);

    }

    /**
     * Like Post
     */
    public function like () {
        dd(
            'Like'
        );
    }
}
