<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            المكتبة الإلكترونية
        </h2>
    </x-slot>

    <div x-data="{
            showModal: false,
            modalBook: {},
            actionType: '',
            confirmAction() {
                if (this.actionType === 'buy') {
                    alert('✅ تم تنفيذ شراء الكتاب: ' + this.modalBook.title);
                    // هنا لاحقًا سيتم إرسال طلب شراء عبر axios أو form
                } else if (this.actionType === 'rent') {
                    alert('✅ تم تنفيذ تأجير الكتاب: ' + this.modalBook.title);
                    // هنا لاحقًا سيتم إرسال طلب تأجير عبر axios أو form
                }
                this.showModal = false;
            }
        }"
        class="py-12 max-w-7xl mx-auto"
    >
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach ($books as $book)
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-lg font-bold mb-2">{{ $book->title }}</h3>
                    <p class="text-gray-600 mb-1">المؤلف: {{ $book->author }}</p>
                    <p class="text-gray-600 mb-1">التصنيف: {{ $book->category->name ?? '-' }}</p>
                    <p class="text-gray-800 font-bold mb-3">السعر: ${{ $book->price }}</p>
                    <div class="flex gap-2">
                        <button
                            @click="showModal = true; modalBook = {{ $book }}; actionType = 'buy';"
                            class="bg-green-500 text-white px-3 py-1 rounded">
                            شراء
                        </button>
                        <button
                            @click="showModal = true; modalBook = {{ $book }}; actionType = 'rent';"
                            class="bg-blue-500 text-white px-3 py-1 rounded">
                            تأجير
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div
            x-show="showModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            x-transition
        >
            <div class="bg-white p-6 rounded shadow max-w-md w-full"
                @click.away="showModal = false">
                <h2 class="text-xl font-bold mb-4" x-text="modalBook.title"></h2>
                <p class="mb-2"><span class="font-semibold">المؤلف:</span> <span x-text="modalBook.author"></span></p>
                <p class="mb-2"><span class="font-semibold">الوصف:</span> <span x-text="modalBook.description ?? 'لا يوجد وصف'"></span></p>
                <p class="mb-4"><span class="font-semibold">السعر:</span> $<span x-text="modalBook.price"></span></p>
                <div class="flex justify-end gap-2">
                    <button @click="showModal = false" class="bg-gray-500 text-white px-4 py-2 rounded">إغلاق</button>
                    <button @click="confirmAction()" class="bg-green-600 text-white px-4 py-2 rounded" x-show="actionType === 'buy'">تأكيد الشراء</button>
                    <button @click="confirmAction()" class="bg-blue-600 text-white px-4 py-2 rounded" x-show="actionType === 'rent'">تأكيد التأجير</button>
                </div>
            </div>
        </div>

        <div class="mt-6">
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>
