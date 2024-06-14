<?php

namespace App\Services;

use App\Repositories\PostRepository;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository =  $postRepository;
    }

    public function store($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->postRepository->store($data);
        return $result;
    }

    public function update($data)
    {
        $validator = Validator::make($data, [
            'id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->postRepository->store($data);
        return $result;
    }
}
