<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImagesController extends Controller
{
    public function index(string $dir, string $method, string $size, string $file): BinaryFileResponse
    {
        abort_if(
            !in_array($size, config('images.sizes', [])),
            403,
            'Размер изображени не допустим'
        );

        $storage = Storage::disk('images');

        $realPath = $dir . '/' . $file;
        $newPath = $dir . '/' . $method . '/' . $size;
        $resultPath = $newPath . '/' . $file;

        if (!$storage->exists($newPath)) {
            $storage->makeDirectory($newPath);
        }

        if (!$storage->exists($resultPath)) {
            $image = Image::make($storage->path($realPath));

            [$w, $h] = explode('x', $size);

            $image->{$method}($w, $h);

            $image->save($storage->path($resultPath));
        }

        return response()->file($storage->path($resultPath));
    }
}
