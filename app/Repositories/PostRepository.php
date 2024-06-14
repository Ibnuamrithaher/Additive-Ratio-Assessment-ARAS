<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    public function get($table_search = "")
    {
        // dd($table_search);
        $post = Post::query()->select('id', 'title', 'description', 'content')->where('title', 'LIKE', '%' . $table_search . '%')->latest()->paginate(10);

        // dd($post);
        return $post;
    }

    public function store($data)
    {
        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content']
        ]);

        return $post->fresh();
    }

    public function update($data)
    {
        $post = Post::find($data['id']);
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->content = $data['content'];
        $post->save();
        return $post->fresh();
    }

    public function find_by_id($id)
    {
        $post = Post::findOrFail($id);
        return $post;
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return "Data Berhasil Di Hapus";
    }
}
