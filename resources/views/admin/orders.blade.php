<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            إدارة الطلبات
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            <table class="table-auto w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">المستخدم</th>
                        <th class="px-4 py-2">الكتاب</th>
                        <th class="px-4 py-2">السعر</th>
                        <th class="px-4 py-2">الحالة</th>
                        <th class="px-4 py-2">تاريخ الإنشاء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @foreach ($order->orderItems as $item)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $order->id }}</td>
                            <td class="px-4 py-2">{{ $order->user->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->book->title ?? '-' }}</td>
                            <td class="px-4 py-2">${{ $item->price }}</td>
                            <td class="px-4 py-2">{{ $order->status }}</td>
                            <td class="px-4 py-2">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
