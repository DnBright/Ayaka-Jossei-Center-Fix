@extends('layouts.app')

@section('title', 'Profil - Ayaka Josei Center')

@section('content')
<div class="professional-profil-page">
    <!-- CLEAN INSTITUTIONAL HERO -->
    <header class="prof-hero">
        <div class="container mx-auto px-6">
            <div class="hero-content-prof text-center professional-reveal">
                <span class="prof-label">INSTITUTIONAL PROFILE</span>
                <h1 class="prof-main-title">
                    Dedikasi Kami Untuk <br /> <span class="text-[#da291c]">Masa Depan</span> Perempuan Indonesia
                </h1>
                <p class="prof-hero-lead">
                    Ayaka Josei Center adalah jembatan profesional menuju karir gemilang di Jepang.
                </p>
            </div>
        </div>
        <div class="hero-decoration">
            <div class="hero-blob"></div>
        </div>
    </header>

    <!-- STRUCTURED CONTENT: PENGANTAR & LATAR BELAKANG -->
    <section class="prof-narrative-section py-32">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-24 items-start professional-reveal">
                <div class="narrative-visual">
                    <div class="image-stack relative">
                        <div class="img-main rounded-[20px] overflow-hidden shadow-2xl">
                            <img src="{{ asset('images/hero-bg.png') }}" alt="Ayaka Office" class="w-full h-[600px] object-cover grayscale">
                        </div>
                        <div class="img-accent absolute -bottom-10 -right-10 w-48 h-48 bg-[#da291c] rounded-[20px] -z-10 opacity-10"></div>
                    </div>
                </div>
                <div class="narrative-text-box">
                    <div class="narrative-block">
                        <h2 class="text-4xl font-black text-slate-900 mb-8 tracking-tighter">Pengantar</h2>
                        <p class="text-lg text-slate-600 leading-relaxed">
                            Ayaka Josei Center (AJC) adalah Lembaga Pelatihan Kerja (LPK) yang secara khusus didirikan untuk mempersiapkan perempuan Indonesia agar mampu bersaing secara profesional di Jepang. Kami memahami bahwa tantangan bekerja di luar negeri bukan hanya soal keterampilan teknis, melainkan juga mentalitas dan penguasaan budaya.
                        </p>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 my-12"></div>
                    <div class="narrative-block">
                        <h2 class="text-4xl font-black text-slate-900 mb-8 tracking-tighter">Latar Belakang</h2>
                        <p class="text-lg text-slate-600 leading-relaxed">
                            Bermula dari keinginan untuk memberikan perlindungan dan edukasi yang benar bagi calon tenaga kerja perempuan, AJC hadir dengan sistem yang transparan. Kami bekerja sama dengan berbagai perusahaan Jepang untuk memastikan setiap alumni kami mendapatkan hak dan perlindungan yang layak selama bekerja di sana.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRESTIGIOUS VISION & MISSION -->
    <section class="prof-vision-section py-32 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="vision-card bg-white p-12 lg:p-20 rounded-[40px] shadow-sm border border-slate-100 professional-reveal">
                <div class="vision-header text-center mb-16">
                    <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mx-auto text-[#da291c]">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h2 class="text-4xl font-black text-slate-900 mt-8 tracking-tighter uppercase">Visi & Misi</h2>
                </div>
                <div class="grid md:grid-cols-2 gap-16">
                    <div class="vision-text">
                        <h3 class="text-xs font-black uppercase tracking-[0.2em] text-[#da291c] mb-6">Visi Kami</h3>
                        <p class="text-2xl leading-relaxed text-slate-800 italic font-medium">
                            "Menjadi lembaga pelatihan terdepan dalam mencetak perempuan Indonesia yang mandiri, berkarakter, dan ahli di bidangnya untuk pasar kerja internasional."
                        </p>
                    </div>
                    <div class="mission-list space-y-6">
                        <h3 class="text-xs font-black uppercase tracking-[0.2em] text-[#da291c] mb-6">Misi Kami</h3>
                        @php
                            $misi = [
                                'Menyelenggarakan pelatihan bahasa Jepang yang intensif dan efektif.',
                                'Membangun mentalitas kerja profesional sesuai standar industri Jepang.',
                                'Memberikan pendampingan karir yang transparan dan akuntabel.',
                                'Menjamin keamanan dan kenyamanan peserta selama proses pelatihan hingga penempatan.'
                            ];
                        @endphp
                        @foreach($misi as $idx => $item)
                            <div class="mission-item-prof flex gap-6 items-start">
                                <div class="num-dot w-8 h-8 min-w-[32px] bg-[#da291c] text-white rounded-full flex items-center justify-center text-[10px] font-black">
                                    {{ $idx + 1 }}
                                </div>
                                <p class="text-lg text-slate-600 leading-snug">{{ $item }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- IMPACT GRID: LEGAL & FOCUS -->
    <section class="prof-impact-section py-32 bg-slate-900 text-white">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-px bg-slate-800 border border-slate-800 overflow-hidden rounded-3xl">
                <div class="impact-block-prof bg-slate-900 p-16">
                    <svg class="w-10 h-10 text-[#da291c] mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <h3 class="text-3xl font-black mb-6 tracking-tighter uppercase italic">Fokus Utama</h3>
                    <p class="text-slate-400 leading-relaxed text-lg">Pelatihan kami difokuskan pada sektor Kaigo (Caregiver), F&B, dan Industri Manufaktur, menyesuaikan dengan kebutuhan pasar kerja perempuan yang stabil di Jepang.</p>
                </div>
                <div class="impact-block-prof bg-slate-900 p-16">
                    <svg class="w-10 h-10 text-[#da291c] mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04kM12 21a8.966 8.966 0 01-5.917-2.24L4 15.033V12a1 1 0 011-1h14a1 1 0 011 1v3.033l-2.083 3.727A8.966 8.966 0 0112 21z"></path></svg>
                    <h3 class="text-3xl font-black mb-6 tracking-tighter uppercase italic">Legalitas & Kepercayaan</h3>
                    <p class="text-slate-400 leading-relaxed text-lg">AJC beroperasi di bawah PT Ayaka Global Indonesia dengan izin resmi dari Kementerian Ketenagakerjaan (Izin SO No. 123/2026), menjamin keamanan setiap langkah karir Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <section class="prof-cta py-32 text-center bg-white relative overflow-hidden">
        <div class="container mx-auto px-6 professional-reveal">
            <h2 class="text-5xl lg:text-7xl font-black text-slate-900 tracking-tighter italic uppercase mb-8">Wujudkan Impianmu</h2>
            <p class="text-xl text-slate-500 max-w-2xl mx-auto mb-12">Bergabunglah dengan keluarga besar Ayaka Josei Center dan mulailah perjalanan karir profesionalmu di Negeri Sakura.</p>
            <div class="mt-12">
                <button class="bg-slate-900 text-white px-12 py-5 rounded-full font-black uppercase tracking-widest text-sm flex items-center gap-4 mx-auto hover:bg-[#da291c] transition-all shadow-xl group">
                    Hubungi Kami
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </div>
    </section>
</div>

<style>
    .prof-hero {
        padding: 8rem 0 6rem;
        background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        position: relative;
    }
    .prof-label {
        display: inline-block;
        font-weight: 800;
        letter-spacing: 0.2em;
        color: #da291c;
        font-size: 0.7rem;
        margin-bottom: 2rem;
        padding: 0.5rem 1.5rem;
        background: rgba(218, 41, 28, 0.05);
        border-radius: 100px;
        text-transform: uppercase;
    }
    .prof-main-title {
        font-size: clamp(2.5rem, 8vw, 5rem);
        font-weight: 900;
        letter-spacing: -0.04em;
        line-height: 1;
        color: #0f172a;
        max-width: 1000px;
        margin: 0 auto 2.5rem;
        text-transform: uppercase;
        font-style: italic;
    }
    .prof-hero-lead {
        font-size: 1.25rem;
        line-height: 1.6;
        color: #64748b;
        max-width: 700px;
        margin: 0 auto;
    }
    .professional-reveal {
        opacity: 0;
        transform: translateY(30px);
        animation: reveal 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes reveal {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
