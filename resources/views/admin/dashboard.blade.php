@extends('layouts.admin')

@section('page-title', 'Dashboard Overview')

@section('content')
<div class="dashboard-container">
    <!-- 1. Top Filter Bar -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div class="flex items-center gap-3">
            <i data-lucide="filter" class="w-5 h-5 text-slate-400"></i>
            <span class="font-bold text-slate-700">Filter Data</span>
        </div>
        <form method="GET" class="flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-xl border border-slate-200 transition-all hover:border-[#da291c]">
            <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i>
            <input type="date" name="date_filter" value="{{ request('date_filter') }}" class="border-none bg-transparent p-0 text-sm font-bold focus:ring-0 text-slate-700 outline-none cursor-pointer" onchange="this.form.submit()">
            @if(request('date_filter'))
                <a href="{{ url()->current() }}" class="ml-2 w-5 h-5 bg-red-100 text-[#da291c] rounded-full flex items-center justify-center hover:bg-[#da291c] hover:text-white transition-colors" title="Hapus Filter">
                    <i data-lucide="x" class="w-3 h-3"></i>
                </a>
            @endif
        </form>
    </div>

    <!-- 2. Top Data Blocks -->
    <div class="grid lg:grid-cols-2 gap-6 mb-8">
        <!-- Block 1: User & Komunikasi -->
        <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm p-8 relative flex items-center gap-8">
            <div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-[#da291c] to-[#991b1b] rounded-[20px] flex items-center justify-center text-white shadow-lg shadow-red-900/20">
                <i data-lucide="users" class="w-10 h-10"></i>
            </div>
            <div class="flex-1 grid grid-cols-2 md:grid-cols-3 gap-6">
                <div>
                    <span class="text-[11px] font-black text-slate-400 uppercase tracking-widest block mb-2">Total Member</span>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-slate-900 leading-none">{{ $stats['total_users'] }}</span>
                        @if(request('date_filter'))<span class="text-xs font-bold text-emerald-500 mb-0.5">/ {{ $totalStats['total_users'] }}</span>@endif
                    </div>
                </div>
                <div>
                    <span class="text-[11px] font-black text-slate-400 uppercase tracking-widest block mb-2">Total Pesan</span>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-slate-900 leading-none">{{ $stats['total_messages'] }}</span>
                        @if(request('date_filter'))<span class="text-xs font-bold text-emerald-500 mb-0.5">/ {{ $totalStats['total_messages'] }}</span>@endif
                    </div>
                </div>
                <div class="hidden md:block">
                    <span class="text-[11px] font-black text-slate-400 uppercase tracking-widest block mb-2">Kapasitas Server</span>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-slate-900 leading-none">Optimal</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Block 2: Performa Konten -->
        <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm p-8 relative flex items-center gap-8">
            <div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-slate-700 to-slate-900 rounded-[20px] flex items-center justify-center text-white shadow-lg shadow-slate-900/20">
                <i data-lucide="bar-chart-2" class="w-10 h-10"></i>
            </div>
            <div class="flex-1 grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Artikel</span>
                    <div class="flex items-end gap-1">
                        <span class="text-2xl font-black text-slate-900 leading-none">{{ $stats['total_articles'] }}</span>
                    </div>
                </div>
                <div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">View</span>
                    <div class="flex items-end gap-1">
                        <span class="text-2xl font-black text-slate-900 leading-none">{{ number_format($stats['article_views']) }}</span>
                    </div>
                </div>
                <div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">E-Book</span>
                    <div class="flex items-end gap-1">
                        <span class="text-2xl font-black text-slate-900 leading-none">{{ $stats['total_ebooks'] }}</span>
                    </div>
                </div>
                <div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Unduhan</span>
                    <div class="flex items-end gap-1">
                        <span class="text-2xl font-black text-slate-900 leading-none">{{ number_format($stats['ebook_downloads']) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Performance Over Time -->
    <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm p-6 mb-8">
        <div class="flex justify-between items-center mb-6 px-2">
            <h3 class="font-black text-slate-900 text-lg">Performance Over Time</h3>
        </div>
        <div id="mainChart" class="w-full h-[300px]"></div>
    </div>

    <!-- 4. Bottom Grid -->
    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Device Breakdown -> Content Breakdown -->
        <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm p-8">
            <h3 class="font-black text-slate-900 text-sm mb-6">Distribusi Konten</h3>
            <div id="doughnutChart" class="w-full h-[220px]"></div>
            <div class="flex justify-center items-center mt-6 gap-6">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-md bg-[#da291c]"></div>
                    <span class="text-xs font-black text-slate-600">Artikel ({{ $totalStats['total_articles'] }})</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-md bg-slate-800"></div>
                    <span class="text-xs font-black text-slate-600">E-Book ({{ $totalStats['total_ebooks'] }})</span>
                </div>
            </div>
        </div>
        
        <!-- Performance By Campaign -> Top Articles -->
        <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm p-8">
            <h3 class="font-black text-slate-900 text-sm mb-6">Performa Top Artikel</h3>
            <div id="barChart" class="w-full h-[250px]"></div>
        </div>
        
        <!-- Performance By Country -> Latest Activity -->
        <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm p-8">
            <h3 class="font-black text-slate-900 text-sm mb-6">Pesan Masuk Terbaru</h3>
            <div class="flex flex-col gap-5">
                @forelse($latestMessages as $msg)
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center flex-shrink-0 font-bold text-xs uppercase">
                        {{ substr($msg->name, 0, 2) }}
                    </div>
                    <div class="flex-1 min-w-0 border-b border-slate-50 pb-4">
                        <div class="flex justify-between items-start mb-1">
                            <span class="block font-black text-slate-800 text-sm truncate pr-2">{{ $msg->name }}</span>
                            <span class="text-[10px] font-black text-slate-400 uppercase whitespace-nowrap">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                        <span class="block text-xs font-medium text-slate-500 truncate">{{ $msg->subject ?? 'Tanpa Subjek' }}</span>
                    </div>
                </div>
                @empty
                <div class="text-center text-xs text-slate-400 py-8 font-bold uppercase tracking-widest">Belum ada pesan</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Main Line Chart
        var mainOptions = {
            series: [{
                name: 'Member Baru',
                data: @json($chartData['users'])
            }, {
                name: 'Pesan Masuk',
                data: @json($chartData['messages'])
            }],
            chart: {
                height: 300,
                type: 'area',
                fontFamily: 'inherit',
                toolbar: { show: false }
            },
            colors: ['#da291c', '#0f172a'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            fill: {
                type: 'gradient',
                gradient: { shadeIntensity: 1, opacityFrom: 0.2, opacityTo: 0.0, stops: [0, 90, 100] }
            },
            xaxis: {
                categories: @json($chartData['labels']),
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: '#94a3b8', fontSize: '12px', fontWeight: 600 } }
            },
            yaxis: {
                labels: { 
                    formatter: function (val) { return Math.floor(val); },
                    style: { colors: '#94a3b8', fontSize: '12px', fontWeight: 600 }
                }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4,
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left',
                markers: { radius: 12 },
                fontWeight: 700,
                itemMargin: { horizontal: 10, vertical: 0 }
            }
        };
        new ApexCharts(document.querySelector("#mainChart"), mainOptions).render();

        // Doughnut Chart
        var doughnutOptions = {
            series: [{{ $totalStats['total_articles'] ?: 0 }}, {{ $totalStats['total_ebooks'] ?: 0 }}],
            chart: { type: 'donut', height: 240, fontFamily: 'inherit' },
            labels: ['Artikel', 'E-Book'],
            colors: ['#da291c', '#0f172a'],
            plotOptions: {
                pie: {
                    donut: { size: '75%' }
                }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            stroke: { show: false }
        };
        new ApexCharts(document.querySelector("#doughnutChart"), doughnutOptions).render();

        // Bar Chart
        var barOptions = {
            series: [{
                name: 'Views',
                data: @json($topArticles->pluck('views_count'))
            }],
            chart: { type: 'bar', height: 250, fontFamily: 'inherit', toolbar: { show: false } },
            colors: ['#da291c'],
            plotOptions: {
                bar: { borderRadius: 4, horizontal: false, columnWidth: '45%' }
            },
            dataLabels: { enabled: false },
            xaxis: {
                categories: @json($topArticles->pluck('title')->map(function($title) { return \Illuminate\Support\Str::limit($title, 12); })),
                labels: { style: { colors: '#94a3b8', fontSize: '10px', fontWeight: 700 } },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: { style: { colors: '#94a3b8', fontSize: '11px', fontWeight: 600 } }
            },
            grid: { show: false }
        };
        new ApexCharts(document.querySelector("#barChart"), barOptions).render();
    });
</script>
@endpush
@endsection
