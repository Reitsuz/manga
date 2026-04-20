<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen p-6">
    <header class="max-w-6xl mx-auto mb-10">
        <h1 class="text-3xl font-bold border-l-4 border-blue-500 pl-4">ライブラリ-MANGA-</h1>
    </header>

    <main class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($series as $slug => $data)
        <a href="{{ route('viewer', $slug) }}" class="group bg-gray-800 rounded-xl overflow-hidden shadow-lg transition-transform hover:-translate-y-2">
            <div class="aspect-[3/4] bg-gray-700 overflow-hidden">
                <img src="{{ asset('manga/' . $slug . '/' . $data['cover']) }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
            </div>
            <div class="p-4">
                <h2 class="font-bold text-lg leading-tight mb-1">{{ $data['title'] }}</h2>
                <p class="text-sm text-gray-400">{{ $data['total_pages'] }} pages</p>
            </div>
        </a>
        @endforeach
    </main>
</body>
</html>