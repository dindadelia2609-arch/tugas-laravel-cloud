<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas CRUD Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Daftar Catatan / Tugas</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Tambah -->
        <form action="{{ route('todos.store') }}" method="POST" class="mb-6">
            @csrf
            <div class="mb-2">
                <input type="text" name="title" placeholder="Judul Catatan..." required class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="mb-2">
                <textarea name="description" placeholder="Keterangan (opsional)..." class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah</button>
        </form>

        <!-- List Catatan -->
        <ul class="divide-y divide-gray-200">
            @forelse($todos as $todo)
                <li class="py-3 flex justify-between items-center">
                    <div>
                        <p class="font-semibold {{ $todo->is_completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                            {{ $todo->title }}
                        </p>
                        @if($todo->description)
                            <p class="text-sm text-gray-500">{{ $todo->description }}</p>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <!-- Toggle Status -->
                        <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="text-xs px-2 py-1 rounded {{ $todo->is_completed ? 'bg-yellow-500' : 'bg-green-500' }} text-white">
                                {{ $todo->is_completed ? 'Batal' : 'Selesai' }}
                            </button>
                        </form>

                        <!-- Hapus -->
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')" class="text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="py-3 text-gray-500 text-center">Belum ada catatan.</li>
            @endforelse
        </ul>
    </div>
</body>
</html>