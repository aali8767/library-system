<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            تعديل الكتاب
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('books.update', $book) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>العنوان</label>
                        <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label>المؤلف</label>
                        <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
                    </div>
                    <div class="mb-3">
                        <label>الوصف</label>
                        <textarea name="description" class="form-control">{{ $book->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>السعر</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ $book->price }}" required>
                    </div>
                    <div class="mb-3">
                        <label>الكمية</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $book->quantity }}" required>
                    </div>
                    <div class="mb-3">
                        <label>التصنيف</label>
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $book->category_id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
