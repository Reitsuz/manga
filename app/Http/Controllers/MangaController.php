<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function index()
    {
        $base = public_path('manga');
        $dirs = array_filter(glob($base.'/*'), 'is_dir');

        $series = [];

        foreach ($dirs as $dir) {

            $slug = basename($dir);

            $images = glob($dir.'/*.{jpg,jpeg,png,webp,JPG,PNG}', GLOB_BRACE);
            $pdfs   = glob($dir.'/*.pdf');

            natsort($images);
            natsort($pdfs);

            $files = array_merge($images,$pdfs);
            $files = array_values($files);

            $series[$slug] = [
                'title' => $slug,
                'total_pages' => count($files),
                'cover' => count($files) ? basename($files[0]) : null
            ];
        }

        return view('library', compact('series'));
    }

    public function show($slug, Request $request)
    {
        $dir = public_path("manga/$slug");
        if (!is_dir($dir)) abort(404);

        $images = glob($dir.'/*.{jpg,jpeg,png,webp,JPG,PNG}', GLOB_BRACE);
        $pdfs   = glob($dir.'/*.pdf');

        natsort($images);
        natsort($pdfs);

        $files = array_merge($images,$pdfs);
        $files = array_values($files);

        $page = (int)$request->query('page', 1);
        $page = max(1, min($page, count($files)));

        $image = basename($files[$page-1]);

        return view('viewer', [
            'slug' => $slug,
            'title' => $slug,
            'current' => $page,
            'total' => count($files),
            'image' => $image
        ]);
    }
}