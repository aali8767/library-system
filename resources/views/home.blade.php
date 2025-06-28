<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            مرحبًا بك في المكتبة الإلكترونية
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">
        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 shadow rounded text-center">
                <h3 class="text-lg">عدد الكتب في المكتبة</h3>
                <p class="text-3xl font-bold">{{ $booksCount }}</p>
            </div>
            <div class="bg-white p-6 shadow rounded text-center">
                <h3 class="text-lg">عدد التصنيفات</h3>
                <p class="text-3xl font-bold">{{ $categoriesCount }}</p>
            </div>
        </div>

        <!-- Latest Books -->
        <div class="bg-white p-6 shadow rounded mt-8">
            <h3 class="text-xl font-semibold mb-4">أحدث الكتب المضافة</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @forelse ($latestBooks as $book)
                    <div class="border p-4 rounded shadow hover:shadow-lg transition">
                        <h4 class="font-bold">{{ $book->title }}</h4>
                        <p class="text-sm text-gray-600">المؤلف: {{ $book->author }}</p>
                        <p class="text-sm text-gray-600">السعر: ${{ $book->price }}</p>
                        <p class="text-sm text-gray-600">الكمية: {{ $book->quantity }}</p>
                    </div>
                @empty
                    <p>لا توجد كتب مضافة حتى الآن.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
