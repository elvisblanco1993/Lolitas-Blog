<?php

namespace App\Http\Controllers;
use App\Models\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagController extends Controller
{

    public function index () {

        return view('tags.index', [
            'tags' => Tag::all(),
        ]);

    }

    public function create () {
        return view('tags.create');
    }

    public function store() {
        request()->validate([
            'name' => ['unique:tags,name']
        ]);

        $tag = new Tag([
            'slug' => Str::slug(request('name'), '-'),
            'name' => request('name'),
        ]);

        $tag->save();

        return redirect(route('tags'));
    }
}
