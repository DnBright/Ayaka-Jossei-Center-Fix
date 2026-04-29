@extends('layouts.admin')

@section('page-title', 'Manajemen Alumni')

@section('content')
<div x-data="{ 
    showModal: false, 
    modalType: 'create', 
    formAction: '{{ route('admin.alumni.store') }}',
    formMethod: 'POST',
    editData: {
        id: '',
        name: '',
        batch: '',
        working_at: '',
        testimonial: '',
        is_featured: false,
        image_url: ''
    },
    openEdit(alumni) {
        this.modalType = 'edit';
        this.formAction = '/admin/alumni/' + alumni.id;
        this.formMethod = 'PUT';
        this.editData = JSON.parse(JSON.stringify(alumni));
        this.editData.is_featured = alumni.is_featured == 1;
        this.showModal = true;
    },
    openCreate() {
        this.modalType = 'create';
        this.formAction = '{{ route('admin.alumni.store') }}';
        this.formMethod = 'POST';
        this.editData = { name: '', batch: '', working_at: '', testimonial: '', is_featured: false, image_url: '' };
        this.showModal = true;
    }
}">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Data Alumni</h1>
            <p class="text-slate-500 font-medium mt-1">Kelola data alumni yang ditampilkan di halaman publik.</p>
        </div>
        <button @click="openCreate()" class="bg-gradient-to-r from-[#da291c] to-[#b91c1c] text-white px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Alumni
        </button>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 text-emerald-600 rounded-2xl border border-emerald-100 font-bold text-sm flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-2xl border border-red-100 font-bold text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Profil</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Info Kerja</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Testimoni</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($alumnis as $alumni)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <img src="{{ str_starts_with($alumni->image_url, 'http') ? $alumni->image_url : asset($alumni->image_url) }}" alt="{{ $alumni->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-slate-100">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <div class="font-bold text-slate-900">{{ $alumni->name }}</div>
                                            @if($alumni->is_featured)
                                                <span class="bg-amber-50 text-amber-600 px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-wider border border-amber-100 flex items-center gap-1 shrink-0">
                                                    <i data-lucide="star" class="w-2.5 h-2.5"></i> Featured
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">{{ $alumni->batch }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                                    <i data-lucide="building-2" class="w-4 h-4 text-slate-400"></i>
                                    {{ $alumni->working_at }}
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-xs text-slate-500 font-medium line-clamp-2 max-w-xs italic">
                                    "{{ $alumni->testimonial }}"
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button @click="openEdit({{ json_encode($alumni) }})" class="w-9 h-9 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                        <i data-lucide="edit-2" class="w-4 h-4"></i>
                                    </button>
                                    <form action="{{ route('admin.alumni.destroy', $alumni->id) }}" method="POST" onsubmit="return confirm('Hapus data alumni ini?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-9 h-9 bg-red-50 text-[#da291c] rounded-lg flex items-center justify-center hover:bg-[#da291c] hover:text-white transition-all shadow-sm">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center text-slate-400 text-xs font-bold uppercase tracking-widest">
                                <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                    <i data-lucide="graduation-cap" class="w-8 h-8"></i>
                                </div>
                                Belum ada data alumni
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($alumnis->hasPages())
            <div class="p-6 border-t border-slate-50 bg-slate-50/50">
                {{ $alumnis->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Form -->
    <div x-show="showModal" 
         class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-slate-900/50 backdrop-blur-sm p-4 md:p-0"
         x-transition.opacity
         style="display: none;">
         
        <div class="relative w-full max-w-2xl bg-white rounded-[32px] shadow-2xl" 
             @click.away="showModal = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100">
            
            <form :action="formAction" method="POST" enctype="multipart/form-data">
                @csrf
                <template x-if="formMethod === 'PUT'">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight" x-text="modalType === 'create' ? 'Tambah Data Alumni' : 'Edit Data Alumni'"></h3>
                    <button type="button" @click="showModal = false" class="w-8 h-8 bg-slate-50 text-slate-400 hover:text-[#da291c] hover:bg-red-50 rounded-full flex items-center justify-center transition-all focus:outline-none">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>

                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" name="name" x-model="editData.name" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-[#da291c] focus:border-[#da291c] block p-3.5 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Angkatan (Batch)</label>
                            <input type="text" name="batch" x-model="editData.batch" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-[#da291c] focus:border-[#da291c] block p-3.5 transition-all" placeholder="Contoh: Batch 14">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Tempat Kerja</label>
                        <input type="text" name="working_at" x-model="editData.working_at" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-[#da291c] focus:border-[#da291c] block p-3.5 transition-all" placeholder="Contoh: Tokyo Care Center">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Testimoni</label>
                        <textarea name="testimonial" x-model="editData.testimonial" required rows="3" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-[#da291c] focus:border-[#da291c] block p-3.5 transition-all"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Foto Profil</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-red-50 file:text-[#da291c] hover:file:bg-red-100 transition-all cursor-pointer">
                            <p class="mt-2 text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed">Biarkan kosong jika tidak ingin mengubah foto saat edit data.</p>
                        </div>
                        
                        <div class="flex items-center gap-3 mt-4 md:mt-0 md:pt-8 bg-slate-50 p-4 rounded-2xl border border-slate-100 h-max">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer" x-model="editData.is_featured">
                                <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#da291c]"></div>
                            </label>
                            <span class="text-xs font-black text-slate-900 uppercase tracking-widest">Tampilkan & Highlight di Beranda</span>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-6 border-t border-slate-100 bg-slate-50 rounded-b-[32px] flex items-center justify-end gap-3">
                    <button type="button" @click="showModal = false" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-700 hover:bg-slate-200/50 rounded-xl transition-all">
                        Batal
                    </button>
                    <button type="submit" class="bg-gradient-to-r from-[#da291c] to-[#b91c1c] text-white px-8 py-3 rounded-xl font-black text-sm uppercase tracking-widest shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
