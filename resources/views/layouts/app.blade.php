<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockPilot Enterprise</title>

    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 w-72 bg-gradient-to-b from-slate-900 to-slate-950 text-white flex flex-col shadow-2xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40">
        <!-- BRAND -->
        <div class="px-6 py-6 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center font-bold text-slate-900">
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
            <input type="text" id="sidebarSearch" placeholder="Search modules..." class="w-full px-4 py-2 rounded-lg bg-slate-800 text-white placeholder-slate-400 border border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
        </div>
        <!-- NAV -->
        <nav class="flex-1 px-3 space-y-1 text-sm overflow-y-auto">
            <a href="/dashboard"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
                {{ request()->segment(1) == 'dashboard' 
                    ? 'bg-blue-600 text-white shadow-lg' 
                    : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                📊 Dashboard
            </a>
            <?php if($user_view != 0){ ?>
            <a href="{{ route('users.viewData') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
               {{ request()->segment(1) == 'users' || request()->segment(1) == 'add-user' || request()->segment(1) == 'edit-user'
                    ? 'bg-blue-600 text-white shadow-lg' 
                    : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                👤 Users
            </a>
            <?php } ?>
            <?php if($inventory_view != 0){ ?>
            <a href="{{ route('inventory.viewData') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
               {{ request()->segment(1) == 'inventory' || request()->segment(1) == 'add-inventory' || request()->segment(1) == 'edit-inventory'
                    ? 'bg-blue-600 text-white shadow-lg' 
                    : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                📦 Inventory
            </a>
            <?php } ?>
             <?php if($suppliers_view != 0){ ?>
            <a href="{{ route('suppliers.viewData') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
            {{ request()->segment(1) == 'suppliers' || request()->segment(1) == 'add-supplier' || request()->segment(1) == 'edit-supplier'  
                    ? 'bg-blue-600 text-white shadow-lg' 
                    : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                🏢 Suppliers
            </a>
            <?php } ?>
            <?php if($procurement_view != 0) {?>
            <a href="{{ route('procurements.viewData') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
                {{ request()->segment(1) == 'procurements' || request()->segment(1) == 'add-procurement' || request()->segment(1) == 'edit-procurement'
                    ? 'bg-blue-600 text-white shadow-lg' 
                    : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                🚚 Procurement
            </a> 
            <?php } ?>
          <?php if($recipe_menu_costing != 0){?>
            <a href="{{ route('recipe-menucosting.viewData') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
            {{ request()->segment(1) == 'recipe-menucosting' || request()->segment(1) == 'add-recipe' || request()->segment(1) == 'edit-recipe'
                    ? 'bg-blue-600 text-white shadow-lg' 
                    : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">

               👨‍🍳  Recipe Menu Costing

            </a>
            <?php } ?>
            <?php if($waste_management != 0){ ?>
            <a href="{{ route('waste-management.viewData') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
            {{ request()->segment(1) == 'waste-management' || request()->segment(1) == 'add-waste' || request()->segment(1) == 'edit-waste'
                    ? 'bg-blue-600 text-white shadow-lg' 
                    : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
               🗑️  Waste Management
            </a>
            <?php } ?>
             <a href="{{ route('ai-demands.viewData') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
              {{ request()->segment(1) == 'ai-demands' || request()->segment(1) == 'add-ai-demand' || request()->segment(1) == 'edit-ai-demand'
                    ? 'bg-blue-600 text-white shadow-lg' 
                    : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
              🤖 AI Demand Intelligence
            </a>

            <!-- Settings Heading -->
        <div class="px-4 pt-6 pb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
            ⚙️ Settings
        </div>
        <a href="{{ route('items.viewData') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
        {{ request()->segment(1) == 'items' 
        ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
         📦 Items
        </a>

            <a href="{{ route('categories.viewData') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
            {{ request()->segment(1) == 'categories' || request()->segment(1) == 'add-category' || request()->segment(1) == 'edit-category'
            ? 'bg-blue-600 text-white shadow-lg' 
            : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">        
        📂 Categories
            </a>
            <?php if($storage_locations_view != 0){ ?>
         <a href="{{ route('storage-locations.viewData') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
        {{ request()->segment(1) == 'storage-locations' 
        ? 'bg-blue-600 text-white shadow-lg' 
        : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
           🏬 Storage Locations
        </a>
        <?php } ?>
        <?php if($user_roles_view != 0){ ?>
        <a href="{{ route('user-roles.viewData') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
        {{ request()->segment(1) == 'user-roles' 
        ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
            👥 User Roles
        </a>
        <?php } ?>
    <a href="{{ route('access-control.viewData') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
        {{ request()->segment(1) == 'access-control' 
        ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
        🔐 Access Control
        </a>

        <a href="{{ route('profile.edit') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
        {{ request()->segment(1) == 'profile' 
        ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
         👤 Profile
        </a>

        </nav>
        <!-- FOOTER -->
        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 py-2 rounded-lg text-sm font-medium text-white transition shadow-lg">
                    🚪 Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Overlay for mobile -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 lg:hidden hidden z-30" onclick="toggleSidebar()"></div>

    <!-- ================= MAIN ================= -->
    <div class="flex-1 flex flex-col">

        <!-- TOP BAR -->
        <header class="bg-white/80 backdrop-blur border-b shadow-sm px-4 md:px-6 py-4 flex justify-between items-center sticky top-0 z-20">

            <!-- LEFT -->
            <div class="flex items-center gap-4">
                <!-- Mobile Menu Button -->
                <button onclick="toggleSidebar()" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div>
                    <h2 class="text-lg md:text-xl font-bold tracking-tight">Enterprise Dashboard</h2>
                    <p class="text-xs md:text-sm text-slate-500">Control inventory, users & operations</p>
                </div>
            </div>

            <!-- SEARCH -->
            <div class="hidden md:block w-1/3">
                <input type="text"
                       placeholder="Search anything..."
                       class="w-full px-4 py-2 border rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                    <p class="text-sm font-semibold">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </p>
                    <p class="text-xs text-slate-500">
                        {{ auth()->user()->email ?? 'admin@stockpilot.com' }}
                    </p>
                </div>

            </div>

        </header>

        <!-- CONTENT -->
        <main class="p-6 space-y-6">

            <!-- BREADCRUMB -->
            <div class="text-sm text-slate-500">
                Home <span class="text-slate-300">/</span> Dashboard
            </div>

            <!-- CONTENT CARD -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6">

                @yield('content')

            </div>

        </main>
 
    </div>
</div>

</body>
</html>
<script>
// Sidebar Toggle
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}

// Close sidebar when a link is clicked
document.querySelectorAll('nav a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth < 1024) {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.add('hidden');
        }
    });
});

// Sidebar Search
document.getElementById("sidebarSearch").addEventListener("keyup", function () {
    let value = this.value.toLowerCase();
    let links = document.querySelectorAll("nav a");

    links.forEach(function (link) {
        let text = link.textContent.toLowerCase();
        if (text.includes(value)) {
            link.style.display = "flex";
        } else {
            link.style.display = "none";
        }
    });
});
</script>