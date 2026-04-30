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
            <div id="doughnutLegend" class="flex flex-wrap justify-center items-center mt-6 gap-x-4 gap-y-2">
                <!-- filled by JS -->
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

        // ===== 1. MAIN AREA CHART: Views Artikel vs Download Ebook =====
        var articleLabels   = @json($chartData['labels']);
        var articleViews    = @json($chartData['views']);
        var ebookLabels     = @json($chartData['ebookLabels']);
        var ebookDownloads  = @json($chartData['downloads']);

        // Use article labels as primary axis (pad ebook data if shorter)
        var mainLabels = articleLabels.length >= ebookLabels.length ? articleLabels : ebookLabels;
        while (articleViews.length < mainLabels.length)    articleViews.push(0);
        while (ebookDownloads.length < mainLabels.length)  ebookDownloads.push(0);

        var mainOptions = {
            series: [
                { name: 'Views Artikel', data: articleViews },
                { name: 'Download E-Book', data: ebookDownloads }
            ],
            chart: {
                height: 320,
                type: 'area',
                fontFamily: 'inherit',
                toolbar: { show: false },
                animations: { enabled: true, easing: 'easeinout', speed: 800 }
            },
            colors: ['#da291c', '#0f172a'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: [3, 3] },
            fill: {
                type: 'gradient',
                gradient: { shadeIntensity: 1, opacityFrom: 0.25, opacityTo: 0.02, stops: [0, 90, 100] }
            },
            xaxis: {
                categories: mainLabels,
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: '#94a3b8', fontSize: '11px', fontWeight: 700 },
                    rotate: -30,
                    maxHeight: 60
                }
            },
            yaxis: {
                labels: {
                    formatter: function(val) { return Number(val).toLocaleString('id-ID'); },
                    style: { colors: '#94a3b8', fontSize: '11px', fontWeight: 600 }
                }
            },
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
            markers: { size: 4, strokeWidth: 0, hover: { size: 6 } },
            tooltip: {
                y: { formatter: function(val) { return Number(val).toLocaleString('id-ID'); } }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left',
                markers: { radius: 6, width: 12, height: 12 },
                fontWeight: 700,
                fontSize: '12px',
                itemMargin: { horizontal: 12, vertical: 0 }
            }
        };
        new ApexCharts(document.querySelector("#mainChart"), mainOptions).render();

        // ===== 2. DOUGHNUT CHART: Distribusi per Kategori Artikel =====
        var catData  = @json($categoryDistribution);
        var catNames = catData.map(function(c){ return c.name; });
        var catVals  = catData.map(function(c){ return c.total; });

        // Fallback: if no category data, show artikel vs ebook
        if (catVals.length === 0) {
            catNames = ['Artikel', 'E-Book'];
            catVals  = [{{ $totalStats['total_articles'] }}, {{ $totalStats['total_ebooks'] }}];
        }

        var doughnutPalette = ['#da291c','#0f172a','#ef4444','#64748b','#f97316','#6366f1','#10b981','#f59e0b'];

        var doughnutOptions = {
            series: catVals,
            chart: { type: 'donut', height: 240, fontFamily: 'inherit', animations: { enabled: true } },
            labels: catNames,
            colors: doughnutPalette.slice(0, catVals.length),
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                fontSize: '11px',
                                fontWeight: 800,
                                color: '#0f172a',
                                formatter: function(w) {
                                    return w.globals.seriesTotals.reduce(function(a,b){ return a+b; }, 0);
                                }
                            }
                        }
                    }
                }
            },
            dataLabels: { enabled: false },
            stroke: { show: false },
            legend: { show: false },
            tooltip: {
                y: { formatter: function(val, opts) {
                    var total = opts.globals.seriesTotals.reduce(function(a,b){return a+b;},0);
                    return val + ' Artikel (' + Math.round(val/total*100) + '%)';
                }}
            }
        };
        var doughnutChart = new ApexCharts(document.querySelector("#doughnutChart"), doughnutOptions);
        doughnutChart.render();

        // Update legend dynamically
        var legendEl = document.getElementById('doughnutLegend');
        if (legendEl) {
            legendEl.innerHTML = catNames.map(function(n, i) {
                return '<div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full flex-shrink-0" style="background:' + doughnutPalette[i] + '"></div><span class="text-[11px] font-bold text-slate-600 truncate">' + n + ' (' + catVals[i] + ')</span></div>';
            }).join('');
        }

        // ===== 3. BAR CHART: Top Artikel by Views =====
        var topTitles = @json($topArticles->pluck('title')->map(fn($t) => \Illuminate\Support\Str::limit($t, 14)));
        var topViews  = @json($topArticles->pluck('views_count')->map(fn($v) => (int)$v));

        if (topTitles.length === 0) {
            topTitles = ['Belum ada data'];
            topViews  = [0];
        }

        var barOptions = {
            series: [{ name: 'Views', data: topViews }],
            chart: {
                type: 'bar',
                height: 260,
                fontFamily: 'inherit',
                toolbar: { show: false },
                animations: { enabled: true, easing: 'easeinout', speed: 600 }
            },
            colors: ['#da291c'],
            plotOptions: {
                bar: {
                    borderRadius: 6,
                    horizontal: true,
                    barHeight: '60%',
                    distributed: false
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) { return Number(val).toLocaleString('id-ID'); },
                style: { fontSize: '10px', fontWeight: 700, colors: ['#fff'] },
                offsetX: -6
            },
            xaxis: {
                categories: topTitles,
                labels: {
                    style: { colors: '#94a3b8', fontSize: '11px', fontWeight: 700 },
                    formatter: function(val) { return Number(val).toLocaleString('id-ID'); }
                },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: { style: { colors: '#334155', fontSize: '11px', fontWeight: 700 } }
            },
            grid: { show: false },
            tooltip: {
                y: { formatter: function(val) { return Number(val).toLocaleString('id-ID') + ' Views'; } }
            }
        };
        new ApexCharts(document.querySelector("#barChart"), barOptions).render();
    });
</script>
@endpush
@endsection

