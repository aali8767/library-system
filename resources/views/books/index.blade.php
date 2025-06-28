<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            قائمة الكتب
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">إضافة كتاب جديد</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>الرقم</th>
                            <th>العنوان</th>
                            <th>المؤلف</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->price }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">تعديل</a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
