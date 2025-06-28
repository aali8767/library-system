<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            لوحة التحكم
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 shadow rounded text-center">
                <h3 class="text-lg">عدد المستخدمين</h3>
                <p class="text-3xl font-bold">{{ $usersCount }}</p>
            </div>
            <div class="bg-white p-6 shadow rounded text-center">
                <h3 class="text-lg">عدد الكتب</h3>
                <p class="text-3xl font-bold">{{ $booksCount }}</p>
            </div>
            <div class="bg-white p-6 shadow rounded text-center">
                <h3 class="text-lg">عدد الطلبات</h3>
                <p class="text-3xl font-bold">{{ $ordersCount }}</p>
            </div>
            <div class="bg-white p-6 shadow rounded text-center">
                <h3 class="text-lg">عدد الإيجارات</h3>
                <p class="text-3xl font-bold">{{ $rentalsCount }}</p>
            </div>
        </div>

        <!-- Chart -->
        <div class="bg-white p-6 shadow rounded">
            <canvas id="dashboardChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('dashboardChart').getContext('2d');

    const data = {
    labels: JSON.parse('{!! json_encode($months) !!}'),
    datasets: [
        {
            label: 'عدد الكتب',
            data: JSON.parse('{!! json_encode($booksPerMonth) !!}'),
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            tension: 0.4
        },
        {
            label: 'عدد الطلبات',
            data: JSON.parse('{!! json_encode($ordersPerMonth) !!}'),
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            tension: 0.4
        },
        {
            label: 'عدد الإيجارات',
            data: JSON.parse('{!! json_encode($rentalsPerMonth) !!}'),
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.4
        }
    ]
};



     
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'الإحصائيات الشهرية (آخر 6 شهور)'
                    }
                }
            },
        };

        new Chart(ctx, config);
    </script>
</x-app-layout>
