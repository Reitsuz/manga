<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>
<title>閲覧パスワード</title>
</head>

<body class="bg-black text-white flex items-center justify-center h-screen">

<form method="POST" class="bg-gray-900 p-8 rounded-xl w-80">
@csrf

<h1 class="text-xl mb-4 font-bold text-center">閲覧パスワード</h1>

@if(session('error'))
<div class="text-red-400 mb-3 text-sm">
{{ session('error') }}
</div>
@endif

<input type="password"
name="password"
placeholder="password"
class="w-full p-3 bg-gray-800 rounded mb-4">

<button class="w-full bg-blue-600 p-3 rounded">
入室
</button>

</form>

</body>
</html>