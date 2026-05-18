@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Add AI Demand Data</h1>
            <p class="text-sm text-slate-500 mt-1">Record demand forecasting data for AI analysis</p>
        </div>
        <a href="{{ route('ai-demands.viewData') }}"
           class="px-4 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800 transition text-sm">
            ← Back
        </a>
    </div>

    <!-- FORM -->
    <div class="bg-white rounded-2xl shadow border p-6">
        <p class="text-slate-500 text-sm">AI Demand data entry form coming soon.</p>
    </div>

</div>
@endsection
