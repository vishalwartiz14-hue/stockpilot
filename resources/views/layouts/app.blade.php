<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>StockPilot Enterprise</title>

    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* DataTables overrides */
        table.dataTable thead th {
            background: #f8fafc;
            font-weight: 600;
        }
        .dataTables_wrapper {
            padding: 10px 0;
        }
        .dataTables_filter input {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 6px 12px;
            margin-left: 6px;
        }
        .dataTables_length select {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 5px 10px;
        }
        .dataTables_paginate .paginate_button {
            border-radius: 6px !important;
        }
    </style>
</head>
<?php
$UserLogindetails = auth()->user();
$user_view              =   DB::table('access')->where('module_name','users')->where('role', $UserLogindetails->type)->where('view','1')->count();
$inventory_view         =   DB::table('access')->where('module_name','inventory')->where('role', $UserLogindetails->type)->where('view','1')->count();
$suppliers_view         =   DB::table('access')->where('module_name','suppliers')->where('role', $UserLogindetails->type)->where('view','1')->count();
$procurement_view       =   DB::table('access')->where('module_name','procurement')->where('role', $UserLogindetails->type)->where('view','1')->count();
$recipe_menu_costing    =   DB::table('access')->where('module_name','recipe_menu_costing')->where('role', $UserLogindetails->type)->where('view','1')->count();
$waste_management       =   DB::table('access')->where('module_name','waste_management')->where('role', $UserLogindetails->type)->where('view','1')->count();
$storage_locations_view =   DB::table('access')->where('module_name','storage_locations')->where('role', $UserLogindetails->type)->where('view','1')->count();
$user_roles_view        =   DB::table('access')->where('module_name','user_roles')->where('role', $UserLogindetails->type)->where('view','1')->count();
?>
<body class="bg-gradient-to-br from-slate-100 via-slate-50 to-blue-50 text-slate-900 font-[Figtree]">

<div class="flex min-h-screen">
    <!-- ================= SIDEBAR ================= -->
    <aside class="w-72 bg-slate-950 text-white flex flex-col shadow-2xl flex-shrink-0">
        <!-- BRAND -->
        <div class="px-6 py-6 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center font-bold text-white text-sm">
                    SP
                </div>
                <div>
                    <h1 class="text-lg font-bold text-white">StockPilot</h1>
                    <p class="text-xs text-slate-400">Enterprise ERP System</p>
                </div>
            </div>
        </div>

        <!-- SEARCH -->
        <div class="p-4">
            <input type="text" id="sidebarSearch" placeholder="Search modules..."
                   class="w-full px-4 py-2 rounded-lg bg-slate-800 text-slate-100 border border-slate-700 placeholder-slate-400 focus:outline-none focus:border-cyan-500 transition text-sm">
        </div>

        <!-- NAV -->
        <nav class="flex-1 px-3 space-y-1 text-sm overflow-y-auto pb-4">
            <a href="/dashboard"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
                {{ request()->segment(1) == 'dashboard'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                📊 Dashboard
            </a>

            <?php if($user_view != 0){ ?>
            <a href="{{ route('users.viewData') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'users' || request()->segment(1) == 'add-user' || request()->segment(1) == 'edit-user'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                👤 Users
            </a>
            <?php } ?>

            <?php if($inventory_view != 0){ ?>
            <a href="{{ route('inventory.viewData') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'inventory' || request()->segment(1) == 'add-inventory' || request()->segment(1) == 'edit-inventory'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                📦 Inventory
            </a>
            <?php } ?>

            <?php if($suppliers_view != 0){ ?>
            <a href="{{ route('suppliers.viewData') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'suppliers' || request()->segment(1) == 'add-supplier' || request()->segment(1) == 'edit-supplier'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                🏢 Suppliers
            </a>
            <?php } ?>

            <?php if($procurement_view != 0) {?>
            <a href="{{ route('procurements.viewData') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'procurements' || request()->segment(1) == 'add-procurement' || request()->segment(1) == 'edit-procurement'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                🚚 Procurement
            </a>
            <?php } ?>

            <?php if($recipe_menu_costing != 0){?>
            <a href="{{ route('recipe-menucosting.viewData') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'recipe-menucosting' || request()->segment(1) == 'add-recipe' || request()->segment(1) == 'edit-recipe'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                👨‍🍳 Recipe Menu Costing
            </a>
            <?php } ?>

            <?php if($waste_management != 0){ ?>
            <a href="{{ route('waste-management.viewData') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'waste-management' || request()->segment(1) == 'add-waste' || request()->segment(1) == 'edit-waste'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                🗑️ Waste Management
            </a>
            <?php } ?>

            <a href="{{ route('ai-demands.viewData') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'ai-demands' || request()->segment(1) == 'add-ai-demand' || request()->segment(1) == 'edit-ai-demand'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                🤖 AI Demand Intelligence
            </a>

            <!-- Settings Heading -->
            <div class="px-4 pt-5 pb-1 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                Settings
            </div>

            <a href="{{ route('items.viewData') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'items'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                📦 Items
            </a>

            <a href="{{ route('categories.viewData') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'categories' || request()->segment(1) == 'add-category' || request()->segment(1) == 'edit-category'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                📂 Categories
            </a>

            <?php if($storage_locations_view != 0){ ?>
            <a href="{{ route('storage-locations.viewData') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'storage-locations'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                🏬 Storage Locations
            </a>
            <?php } ?>

            <?php if($user_roles_view != 0){ ?>
            <a href="{{ route('user-roles.viewData') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'user-roles'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                👥 User Roles
            </a>
            <?php } ?>

            <a href="{{ route('access-control.viewData') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'access-control'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                🔐 Access Control
            </a>

            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
               {{ request()->segment(1) == 'profile'
                    ? 'bg-slate-800 text-white font-medium'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                👤 Profile
            </a>
        </nav>

        <!-- SIDEBAR FOOTER / LOGOUT -->
        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg text-sm font-medium transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ================= MAIN ================= -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- TOP BAR -->
        <header class="bg-white border-b shadow-sm px-6 py-4 flex justify-between items-center">

            <!-- LEFT -->
            <div>
                <h2 class="text-xl font-bold tracking-tight text-slate-900">Enterprise Dashboard</h2>
                <p class="text-sm text-slate-500">Control inventory, users & operations</p>
            </div>

            <!-- SEARCH -->
            <div class="hidden md:block w-1/3">
                <input type="text"
                       placeholder="Search anything..."
                       class="w-full px-4 py-2 border border-slate-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                <!-- NOTIFICATION -->
                <button class="relative p-2 rounded-xl hover:bg-slate-100 transition">
                    🔔
                    <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- USER -->
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-slate-800">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </p>
                    <p class="text-xs text-slate-500">
                        {{ auth()->user()->email ?? 'admin@stockpilot.com' }}
                    </p>
                </div>

            </div>

        </header>

        <!-- CONTENT -->
        <main class="p-6 space-y-6 flex-1">

            <!-- BREADCRUMB -->
            <div class="text-sm text-slate-500">
                Home <span class="text-slate-300 mx-1">/</span>
                <span class="text-slate-700">{{ ucfirst(request()->segment(1) ?? 'Dashboard') }}</span>
            </div>

            <!-- CONTENT CARD -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6">
                @yield('content')
            </div>

        </main>

    </div>
</div>

<!-- jQuery + DataTables JS (loaded once globally) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById("sidebarSearch");
    if (searchInput) {
        searchInput.addEventListener("keyup", function () {
            var value = this.value.toLowerCase();
            var links = document.querySelectorAll("nav a");
            links.forEach(function (link) {
                var text = link.textContent.toLowerCase();
                link.style.display = text.includes(value) ? "flex" : "none";
            });
        });
    }
});
</script>

</body>
</html>