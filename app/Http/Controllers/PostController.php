<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use App\Services\PostService;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postRepository;
    protected $postService;
    public function __construct(PostRepository $postRepository, PostService $postService)
    {
        $this->postRepository =  $postRepository;
        $this->postService =  $postService;
    }

    public function index()
    {
        $post = $this->postRepository->get();
        return view('welcome', compact('post'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'description',
            'content'
        ]);

        try {
            $this->postService->store($data);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('index')->withSuccess('Berhasil menghapus data !');
    }

    public function edit($id)
    {
        $post = $this->postRepository->find_by_id($id);
        return view('edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $data = array_merge($request->only([
            'title',
            'description',
            'content'
        ]), array(
            "id" => $id
        ));

        try {
            $this->postService->update($data);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('index')->withSuccess('Berhasil menghapus data !');
    }

    public function destroy($id)
    {
        $post = $this->postRepository->delete($id);
        return redirect()->back()->withSuccess('Berhasil menghapus data !');
    }
}
