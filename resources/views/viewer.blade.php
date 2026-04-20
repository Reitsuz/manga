<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .manga-vh { max-height: 90vh; }
        @media (max-width: 640px) { .manga-vh { max-height: none; width: 100%; } }
    </style>
</head>
<body class="bg-black text-white h-screen flex flex-col overflow-hidden">

@php
use Illuminate\Support\Str;
@endphp

    <div class="w-full bg-gray-900/80 p-3 flex items-center justify-between z-10">
        <a href="/" class="text-sm text-gray-400 hover:text-white">← Library</a>
        <div class="text-sm font-bold">{{ $title }} ({{ $current }}/{{ $total }})</div>
        <div class="w-24 bg-gray-700 h-1 rounded-full overflow-hidden">
            <div class="bg-blue-500 h-full" style="width: {{ ($current / $total) * 100 }}%"></div>
        </div>
    </div>

    <main class="flex-1 overflow-y-auto overflow-x-hidden flex flex-col items-center py-4">
        <a href="{{ $current < $total ? route('viewer', ['slug' => $slug, 'page' => $current + 1]) : '#' }}" 
           class="inline-block relative">

            {{-- PDFの場合 --}}
            @if(Str::endsWith(strtolower($image), '.pdf'))
                <iframe 
                    src="{{ asset('manga/' . $slug . '/' . $image) }}" 
                    class="w-full h-[90vh] bg-white">
                </iframe>

            {{-- 画像の場合 --}}
            @else
                <img src="{{ asset('manga/' . $slug . '/' . $image) }}" 
                     class="manga-vh object-contain shadow-2xl">
            @endif
            
            @if($current == $total)
            <div class="mt-8 mb-20 text-center">
                <a href="/" class="bg-blue-600 px-8 py-3 rounded-full font-bold hover:bg-blue-50 transition">
                    読了！一覧に戻る
                </a>
            </div>
            @endif
        </a>
    </main>

    <nav class="fixed bottom-0 w-full bg-gray-900/90 backdrop-blur-sm p-4 grid grid-cols-3 items-center border-t border-gray-800">
        <div class="text-left">
            @if($current > 1)
            <a href="{{ route('viewer', ['slug' => $slug, 'page' => $current - 1]) }}" 
               class="bg-gray-800 p-3 rounded-lg hover:bg-gray-700 inline-block">◀ Prev</a>
            @endif
        </div>
        
        <div class="text-center text-xs text-gray-500 italic">
            Tap image for next page
        </div>

        <div class="text-right">
            @if($current < $total)
            <a href="{{ route('viewer', ['slug' => $slug, 'page' => $current + 1]) }}" 
               class="bg-blue-600 p-3 rounded-lg hover:bg-blue-500 inline-block">Next ▶</a>
            @endif
        </div>
    </nav>

</body>
</html>