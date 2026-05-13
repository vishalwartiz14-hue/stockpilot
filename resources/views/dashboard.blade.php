<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- TOP CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

                <div class="bg-white p-5 rounded-xl shadow">
                    <p class="text-gray-500">Total Users</p>
                    <h2 class="text-2xl font-bold">12</h2>
                </div>

                <div class="bg-white p-5 rounded-xl shadow">
                    <p class="text-gray-500">Total Items</p>
                    <h2 class="text-2xl font-bold">240</h2>
                </div>

                <div class="bg-white p-5 rounded-xl shadow">
                    <p class="text-gray-500">Stock Value</p>
                    <h2 class="text-2xl font-bold">₹ 1,25,000</h2>
                </div>

                <div class="bg-red-50 p-5 rounded-xl shadow">
                    <p class="text-gray-500">Low Stock Alerts</p>
                    <h2 class="text-2xl font-bold text-red-600">8</h2>
                </div>

            </div>

            <!-- SECOND ROW -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                <div class="bg-white p-5 rounded-xl shadow">
                    <h3 class="font-semibold mb-2">Expiring Soon</h3>
                    <p class="text-yellow-500 text-2xl font-bold">5 Items</p>
                </div>

                <div class="bg-white p-5 rounded-xl shadow">
                    <h3 class="font-semibold mb-2">Purchase Orders</h3>
                    <p class="text-blue-500 text-2xl font-bold">18</p>
                </div>

                <div class="bg-white p-5 rounded-xl shadow">
                    <h3 class="font-semibold mb-2">Suppliers</h3>
                    <p class="text-green-500 text-2xl font-bold">6</p>
                </div>

            </div>

            <!-- ALERTS + ACTIVITY -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- ALERT BOX -->
                <div class="bg-white p-5 rounded-xl shadow">
                    <h3 class="font-bold mb-4">⚠ Alerts</h3>

                    <div class="space-y-3">

                        <div class="bg-red-100 p-3 rounded">
                            Low Stock: Tomato (5 KG left)
                        </div>

                        <div class="bg-yellow-100 p-3 rounded">
                            Expiry Soon: Milk (2 Days left)
                        </div>

                        <div class="bg-blue-100 p-3 rounded">
                            Overstock: Rice (500 KG)
                        </div>

                    </div>
                </div>

                <!-- ACTIVITY FEED -->
                <div class="bg-white p-5 rounded-xl shadow">
                    <h3 class="font-bold mb-4">📊 Recent Activity</h3>

                    <ul class="space-y-3 text-sm text-gray-600">

                        <li>✔ Admin added 20kg Rice</li>
                        <li>✔ Purchase order approved</li>
                        <li>✔ Milk stock reduced</li>
                        <li>✔ Tomato marked as low stock</li>

                    </ul> 

                </div>

            </div>

        </div>

    </div>

</x-app-layout>