@extends('layouts.app')

@section('title', 'Hubungi Kami - Ayaka Josei Center')

@section('content')
<div class="contact-wrapper font-['Inter']">
    <!-- 1. HERO SECTION -->
    <header class="contact-header py-16 md:py-24 text-center bg-white border-b border-slate-100 relative z-10">
        <div class="container mx-auto px-6 contact-reveal">
            <span class="text-[#da291c] font-black tracking-[0.4em] text-[10px] mb-8 block uppercase">Get In Touch</span>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-slate-900 tracking-tighter mb-8 font-['Outfit'] leading-[0.95] md:leading-[0.9] italic uppercase">
                {{ $pages['contact']->content['hero_title'] ?? 'Kemitraan & Konsultasi' }}
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed">
                {{ $pages['contact']->content['hero_subtitle'] ?? 'Kami siap membantu Anda memulai perjalanan karir profesional di Jepang. Hubungi tim kami untuk konsultasi gratis.' }}
            </p>
        </div>
    </header>

    <!-- 2. MAIN SPLIT LAYOUT -->
    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-24">
                
                <!-- Left: Info & Map -->
                <div class="contact-info-col contact-reveal text-center md:text-left">
                    <div class="mb-16">
                        <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-10 md:mb-12 font-['Outfit'] tracking-tighter">Informasi Lembaga</h2>
                        
                        <div class="space-y-8 md:space-y-10">
                            <div class="flex flex-col md:flex-row gap-4 md:gap-8 items-center md:items-start">
                                <div class="w-14 h-14 bg-red-50 text-[#da291c] rounded-2xl flex items-center justify-center shrink-0 shadow-sm border border-red-100">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <label class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Alamat Kantor</label>
                                    <p class="text-base md:text-lg font-semibold text-slate-900 leading-snug">Remame, Jl. Magelang - Yogyakarta Jl. Remame No.km 19.5, RT.002/RW.13, Kemburan, Jumoyo, Kec. Salam, Kabupaten Magelang, Jawa Tengah 56172</p>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row gap-4 md:gap-8 items-center md:items-start">
                                <div class="w-14 h-14 bg-red-50 text-[#da291c] rounded-2xl flex items-center justify-center shrink-0 shadow-sm border border-red-100">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                </div>
                                <div>
                                    <label class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">WhatsApp Official</label>
                                    <p class="text-base md:text-lg font-semibold text-slate-900 leading-snug">+62 815-4200-7626</p>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row gap-4 md:gap-8 items-center md:items-start">
                                <div class="w-14 h-14 bg-red-50 text-[#da291c] rounded-2xl flex items-center justify-center shrink-0 shadow-sm border border-red-100">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <label class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Email Support</label>
                                    <p class="text-base md:text-lg font-semibold text-slate-900 leading-snug">{{ $settings->site_email ?? 'admin@ayakajosei.com' }}</p>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row gap-4 md:gap-8 items-center md:items-start">
                                <div class="w-14 h-14 bg-red-50 text-[#da291c] rounded-2xl flex items-center justify-center shrink-0 shadow-sm border border-red-100">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <label class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Jam Operasional</label>
                                    <p class="text-base md:text-lg font-semibold text-slate-900 leading-snug">Senin - Jumat: 08:00 - 17:00 WIB</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center md:justify-start gap-4 mt-12 md:mt-16">
                                <a href="{{ $settings->instagram_url ?? '#' }}" target="_blank" class="w-12 h-12 border border-slate-200 rounded-full flex items-center justify-center text-slate-900 hover:bg-[#da291c] hover:text-white hover:border-[#da291c] transition-all">
                                    <span class="sr-only">Instagram</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h-2v-6h2v6zm-1-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm5 7h-2v-3.5c0-1.1-.9-2-2-2s-2 .9-2 2V17h-2v-6h2v1.07c.73-.7 1.76-1.07 2.85-1.07 2.21 0 4 1.79 4 4V17z"></path></svg>
                                </a>
                                <a href="{{ $settings->facebook_url ?? '#' }}" target="_blank" class="w-12 h-12 border border-slate-200 rounded-full flex items-center justify-center text-slate-900 hover:bg-[#da291c] hover:text-white hover:border-[#da291c] transition-all">
                                    <span class="sr-only">Facebook</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.312h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.324v-21.35c0-.732-.593-1.325-1.325-1.325z"></path></svg>
                                </a>
                        </div>
                    </div>

                    <!-- MAP PLACEHOLDER -->
                    <div class="rounded-[30px] overflow-hidden shadow-2xl border border-slate-100 h-[300px] md:h-[350px] bg-slate-50 relative group">
                        <div class="absolute inset-0 bg-slate-900/5 group-hover:bg-transparent transition-all pointer-events-none z-10"></div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15816.6579840254!2d110.3015433!3d-7.6005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a89668d904791%3A0x6b7b51b75b9f7f4e!2sJumoyo%2C%20Salam%2C%20Magelang%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1714300000000!5m2!1sen!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Right: Form -->
                <div class="contact-form-col contact-reveal mt-12 lg:mt-0">
                    <div class="bg-white p-8 md:p-12 lg:p-16 rounded-[30px] md:rounded-[40px] shadow-2xl border border-slate-50 relative">
                        <div class="mb-10 md:mb-12 text-center md:text-left">
                            <h3 class="text-3xl md:text-4xl font-black text-slate-900 mb-3 font-['Outfit'] tracking-tighter">
                                {{ $pages['contact']->content['form_title'] ?? 'Kirim Pesan' }}
                            </h3>
                            <p class="text-sm md:text-base text-slate-500 font-medium leading-relaxed">
                                {{ $pages['contact']->content['form_subtitle'] ?? 'Tim kami biasanya merespon dalam waktu kurang dari 24 jam.' }}
                            </p>
                        </div>

                        @if(session('success'))
                            <div class="mb-10 p-5 bg-emerald-50 text-emerald-700 rounded-2xl font-bold text-sm border border-emerald-100 animate-in fade-in slide-in-from-top-4 duration-500">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('kontak.store') }}" method="POST" class="space-y-6 md:space-y-8">
                            @csrf
                            <div class="space-y-3">
                                <label class="text-sm font-bold text-slate-900">Nama Lengkap</label>
                                <input type="text" name="name" required placeholder="Masukkan nama Anda" value="{{ old('name') }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 focus:outline-none focus:border-[#da291c] focus:bg-white transition-all text-sm">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                                <div class="space-y-3">
                                    <label class="text-sm font-bold text-slate-900">Email Kontak</label>
                                    <input type="email" name="email" required placeholder="example@email.com" value="{{ old('email') }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 focus:outline-none focus:border-[#da291c] focus:bg-white transition-all text-sm">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-sm font-bold text-slate-900">Subjek</label>
                                    <select name="subject" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 focus:outline-none focus:border-[#da291c] focus:bg-white transition-all appearance-none text-sm">
                                        <option value="">Pilih Subjek</option>
                                        <option value="Konsultasi Program">Konsultasi Program</option>
                                        <option value="Pendaftaran">Pendaftaran</option>
                                        <option value="Pertanyaan Umum">Pertanyaan Umum</option>
                                    </select>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-sm font-bold text-slate-900">Pesan Anda</label>
                                <textarea name="message" rows="5" required placeholder="Tuliskan pesan atau pertanyaan Anda di sini..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 focus:outline-none focus:border-[#da291c] focus:bg-white transition-all resize-none text-sm">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black uppercase tracking-widest text-sm flex items-center justify-center gap-4 hover:bg-[#da291c] transition-all shadow-xl group">
                                Kirim Pesan Sekarang
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </button>
                        </form>
                    </div>

                    <div class="mt-8 md:mt-12 p-6 md:p-8 bg-green-50 rounded-2xl border border-dashed border-green-200 flex items-center gap-6">
                        <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4"></path></svg>
                        </div>
                        <p class="text-xs md:text-sm font-medium text-green-800 leading-relaxed">Data Anda aman bersama kami. Kami menghormati privasi Anda dan tidak akan pernah menyebarluaskan informasi pribadi tanpa izin.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. FOOTER QUOTE -->
    <footer class="py-16 md:py-24 border-t border-slate-100 text-center">
        <div class="container mx-auto px-6 contact-reveal">
            <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-8 md:mb-10 font-['Outfit'] tracking-tighter leading-tight italic">
                {{ $pages['contact']->content['footer_quote'] ?? 'Mari Bergabung Bersama Ribuan Alumni Sukses Kami' }}
            </h2>
            <div class="w-16 h-1.5 bg-[#da291c] mx-auto rounded-full"></div>
        </div>
    </footer>
</div>

<style>
    .contact-reveal {
        opacity: 0;
        transform: translateY(30px);
        animation: reveal 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes reveal {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
