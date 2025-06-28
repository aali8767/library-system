<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            إدارة الإيجارات
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
                        <th class="px-4 py-2">تاريخ الإيجار</th>
                        <th class="px-4 py-2">تاريخ الإرجاع</th>
                        <th class="px-4 py-2">الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rentals as $rental)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $rental->id }}</td>
                        <td class="px-4 py-2">{{ $rental->user->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $rental->book->title ?? '-' }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($rental->rental_date)->format('Y-m-d') }}</td>
<td class="px-4 py-2">{{ \Carbon\Carbon::parse($rental->return_date)->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">{{ $rental->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $rentals->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
