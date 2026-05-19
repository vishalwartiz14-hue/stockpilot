<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Pilot — Smart Restaurant Inventory & Procurement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="AI-powered restaurant inventory and auto-reorder system. Track stock in real time, predict demand, and generate smart purchase orders.">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

    <style> 
        :root {
            --bg: #0e1410;
            --card: #18211c;
            --border: rgba(180, 220, 180, 0.12);
            --muted: #93a89a;
            --fg: #f1f5ef;
            --primary: #c5f24b;
            --accent: #ffb547;
            --gradient: linear-gradient(135deg, #c5f24b 0%, #ffb547 100%);
            --glow: 0 30px 80px -20px rgba(197, 242, 75, 0.35);
            --shadow: 0 10px 40px -12px rgba(0,0,0,0.5);
        }
        * { border-color: var(--border); }
        html { font-family: 'Inter', system-ui, sans-serif; }
        body {
            background-color: var(--bg);
            color: var(--fg);
            background-image:
                radial-gradient(ellipse 80% 60% at 20% 0%, rgba(197,242,75,0.18), transparent 60%),
                radial-gradient(ellipse 70% 50% at 100% 100%, rgba(255,181,71,0.14), transparent 60%);
            background-attachment: fixed;
            -webkit-font-smoothing: antialiased;
        }
        .font-display { font-family: 'Instrument Serif', Georgia, serif; font-weight: 400; letter-spacing: -0.02em; }
        .text-gradient {
            background: var(--gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .bg-gradient-accent { background: var(--gradient); }
        .glass {
            background: rgba(24,33,28,0.7);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
        }
        .btn-primary {
            background: var(--gradient);
            color: #14201a;
            box-shadow: var(--glow);
        }
        .btn-primary:hover { opacity: .92; }
        .card { background: var(--card); border: 1px solid var(--border); box-shadow: var(--shadow); }
        .text-muted { color: var(--muted); }
        .text-primary-c { color: var(--primary); }
        .text-accent-c { color: var(--accent); }
        .border-soft { border-color: var(--border); }
        .ring-primary { box-shadow: 0 0 0 1px rgba(197,242,75,0.3); background: rgba(197,242,75,0.06); }

        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
        @keyframes pulse-dot { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.3)} }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-dot { animation: pulse-dot 2s ease-in-out infinite; }

        .feature-card { transition: all .3s ease; }
        .feature-card:hover { transform: translateY(-4px); border-color: rgba(197,242,75,0.4); }
        .stat-card { transition: all .25s ease; }
        .stat-card:hover { transform: translateY(-2px); }

        .dot-pattern {
            background-image:
                radial-gradient(circle at 20% 30%, rgba(255,255,255,0.9) 1px, transparent 1px),
                radial-gradient(circle at 80% 70%, rgba(255,255,255,0.9) 1px, transparent 1px);
            background-size: 40px 40px, 60px 60px;
            opacity: .18;
        }
    </style>
</head>
<body>

<!-- NAV -->
<header class="sticky top-0 z-50 backdrop-blur-xl border-b border-soft" style="background: rgba(14,20,16,0.75);">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <a href="#" class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-xl grid place-items-center bg-gradient-accent">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="#14201a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 13.87A4 4 0 0 1 7.41 6a5.11 5.11 0 0 1 1.05-1.54 5 5 0 0 1 7.08 0A5.11 5.11 0 0 1 16.59 6 4 4 0 0 1 18 13.87V21H6Z"/><line x1="6" y1="17" x2="18" y2="17"/></svg>
            </div>
            <span class="font-display text-2xl">Stock<span class="text-gradient">Pilot</span></span>
        </a>
        <nav class="hidden md:flex items-center gap-8 text-sm text-muted">
            <a href="#features" class="hover:text-white transition">Features</a>
            <a href="#dashboard" class="hover:text-white transition">Dashboard</a>
            <a href="#pricing" class="hover:text-white transition">Pricing</a>
        </nav>
        <div class="flex items-center gap-2">
            <a href="{{ route('login') }}" class="px-4 py-2 text-sm text-muted hover:text-white transition">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 text-sm rounded-full bg-white text-black font-medium hover:opacity-90 transition">Register</a>
        </div>
    </div>
</header>

<!-- HERO -->
<section class="relative max-w-7xl mx-auto px-6 pt-20 pb-24">
    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full glass text-xs text-muted mb-8">
        <span class="w-1.5 h-1.5 rounded-full bg-gradient-accent animate-pulse-dot"></span>
        New · Predictive demand engine v2
    </div>

    <h1 class="font-display text-5xl sm:text-6xl md:text-8xl leading-[0.95] max-w-5xl">
        Your kitchen runs on instinct.
        <span class="text-gradient">Your inventory</span> shouldn't.
    </h1>

    <p class="mt-8 text-lg text-muted max-w-2xl">
        StockPilot watches every ingredient, predicts what you'll need, and writes your
        purchase orders before stock runs out. Built for restaurants that can't afford
        a missing tomato on a Friday night. 🍽️
    </p>

    <div class="mt-10 flex flex-wrap gap-3">
        <a href="{{ route('dashboard') }}" class="group btn-primary inline-flex items-center gap-2 px-6 py-3.5 rounded-full font-semibold transition">
            Open Dashboard
            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
        <a href="#features" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full glass font-medium hover:bg-white/5 transition">
            Explore Features
        </a>
    </div>

    <div class="mt-12 flex flex-wrap gap-2">
        <?php
        $tags = ['AI Auto Reorder', 'Smart Procurement', 'Real-time Inventory', 'Waste Analytics'];
        foreach ($tags as $tag): ?>
            <span class="px-3 py-1.5 rounded-full text-xs border border-soft text-muted"><?= $tag ?></span>
        <?php endforeach; ?>
    </div>
</section>

<!-- DASHBOARD -->
<section id="dashboard" class="max-w-7xl mx-auto px-6 pb-32">
    <div class="rounded-3xl glass p-8 md:p-10" style="box-shadow: var(--shadow);">
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="text-xs uppercase tracking-[0.2em] text-muted mb-2">Live overview</div>
                <h2 class="font-display text-4xl">Today, at a glance</h2>
            </div>
            <div class="hidden sm:flex items-center gap-2 text-xs text-muted">
                <span class="w-2 h-2 rounded-full bg-gradient-accent animate-pulse-dot"></span>
                Syncing every 30s
            </div>
        </div>

        <?php
        $stats = [
            ['label' => 'Total Items', 'value' => '1,240', 'delta' => '+4.2%', 'tone' => 'primary', 'icon' => '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>'],
            ['label' => 'Orders', 'value' => '320', 'delta' => '+12%', 'tone' => 'accent', 'icon' => '<circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6"/>'],
            ['label' => 'Pending', 'value' => '18', 'delta' => '−3', 'tone' => 'primary', 'icon' => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>'],
            ['label' => 'Low Stock', 'value' => '7', 'delta' => 'alert', 'tone' => 'destructive', 'icon' => '<path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>'],
        ];
        ?>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php foreach ($stats as $s):
                $color = $s['tone'] === 'destructive' ? '#ff6b5b' : ($s['tone'] === 'accent' ? 'var(--accent)' : 'var(--primary)');
            ?>
                <div class="stat-card p-5 rounded-2xl card">
                    <div class="flex items-center justify-between mb-6">
                        <svg class="w-5 h-5" style="color: <?= $color ?>;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= $s['icon'] ?></svg>
                        <span class="text-xs <?= $s['tone'] === 'destructive' ? 'text-red-400' : 'text-muted' ?>"><?= $s['delta'] ?></span>
                    </div>
                    <div class="font-display text-4xl"><?= $s['value'] ?></div>
                    <div class="text-xs text-muted mt-1"><?= $s['label'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- AI suggestion -->
        <div class="mt-6 p-6 rounded-2xl ring-primary flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl grid place-items-center shrink-0 animate-float bg-gradient-accent">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="#14201a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><line x1="8" y1="16" x2="8" y2="16"/><line x1="16" y1="16" x2="16" y2="16"/></svg>
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs uppercase tracking-[0.2em] text-primary-c">AI Suggestion</span>
                    <svg class="w-3 h-3 text-primary-c" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0l2.5 9.5L24 12l-9.5 2.5L12 24l-2.5-9.5L0 12l9.5-2.5z"/></svg>
                </div>
                <p>Tomatoes &amp; olive oil running low — reorder recommended in <span class="font-semibold text-primary-c">2 days</span> based on weekend demand trend.</p>
            </div>
            <button class="hidden sm:inline-flex items-center gap-1 px-4 py-2 rounded-full btn-primary text-sm font-semibold shrink-0">
                Approve
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
            </button>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section id="features" class="max-w-7xl mx-auto px-6 pb-32">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12 gap-4">
        <h2 class="font-display text-5xl md:text-6xl max-w-2xl">
            Less spreadsheet. <span class="text-gradient">More service.</span>
        </h2>
        <p class="text-sm text-muted max-w-xs">
            Three engines working together so your team can focus on the plate, not the pantry.
        </p>
    </div>

    <?php
    $features = [
        ['emoji' => '🤖', 'title' => 'AI Auto Reorder', 'body' => 'Purchase orders write themselves, tuned to your usage curves and seasonality.'],
        ['emoji' => '📦', 'title' => 'Real-time Inventory', 'body' => 'Every shelf, walk-in, and prep station synced live with low-stock alerts.'],
        ['emoji' => '🚚', 'title' => 'Smart Procurement', 'body' => 'Compare suppliers on price, lead-time, and reliability — auto-pick the winner.'],
    ];
    ?>

    <div class="grid md:grid-cols-3 gap-4">
        <?php foreach ($features as $i => $f): ?>
            <article class="feature-card group p-8 rounded-3xl card">
                <div class="flex items-center justify-between mb-12">
                    <span class="text-4xl"><?= $f['emoji'] ?></span>
                    <span class="text-xs text-muted tabular-nums">0<?= $i + 1 ?></span>
                </div>
                <h3 class="font-display text-3xl mb-3"><?= $f['title'] ?></h3>
                <p class="text-muted leading-relaxed"><?= $f['body'] ?></p>
                <div class="mt-8 flex items-center gap-2 text-sm text-primary-c opacity-0 group-hover:opacity-100 transition">
                    Learn more
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<!-- CTA -->
<section id="pricing" class="max-w-7xl mx-auto px-6 pb-32">
    <div class="relative overflow-hidden rounded-[2.5rem] p-12 md:p-20 text-center border border-soft bg-gradient-accent">
        <div class="absolute inset-0 dot-pattern"></div>
        <div class="relative">
            <h2 class="font-display text-5xl md:text-7xl leading-tight max-w-3xl mx-auto" style="color:#14201a;">
                Ready to automate your restaurant inventory?
            </h2>
            <p class="mt-6 max-w-xl mx-auto text-lg" style="color: rgba(20,32,26,0.8);">
                Save time, cut waste, and ship a tighter operation with AI-driven procurement.
            </p>
            <div class="mt-10 flex flex-wrap justify-center gap-3">
                <a href="#" class="inline-flex items-center gap-2 px-7 py-4 rounded-full bg-[#0e1410] text-white font-medium hover:opacity-90 transition">
                    Get Started Now
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a href="#" class="inline-flex items-center gap-2 px-7 py-4 rounded-full border-2 font-medium transition hover:bg-black/10" style="border-color: rgba(20,32,26,0.3); color:#14201a;">
                    Book a demo
                </a>
            </div>
            <div class="mt-10 flex flex-wrap justify-center gap-6 text-sm" style="color: rgba(20,32,26,0.85);">
                <?php foreach (['No credit card', '14-day free trial', 'Cancel anytime'] as $t): ?>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <?= $t ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="border-t border-soft">
    <div class="max-w-7xl mx-auto px-6 py-10 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-muted">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg grid place-items-center bg-gradient-accent">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="#14201a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 13.87A4 4 0 0 1 7.41 6a5.11 5.11 0 0 1 1.05-1.54 5 5 0 0 1 7.08 0A5.11 5.11 0 0 1 16.59 6 4 4 0 0 1 18 13.87V21H6Z"/><line x1="6" y1="17" x2="18" y2="17"/></svg>
            </div>
            <span class="font-display text-lg text-white">StockPilot</span>
        </div>
        <div>&copy; <?= date('Y') ?> StockPilot — AI Restaurant Inventory Ordering System. All rights reserved.</div>
    </div>
</footer>

</body>
</html>