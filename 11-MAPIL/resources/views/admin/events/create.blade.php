<x-app-layout>
    <div class="dash-main">
        <div style="background: white; border-bottom: 1px solid #e8edf8; padding: 0 36px; height: 64px; display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 17px; font-weight: 800; color: #172554; letter-spacing: -0.3px;">Buat Pengajuan Event</div>
                <div style="font-size: 12px; color: #94a3b8; font-weight: 500;">Isi detail kegiatan untuk diajukan ke Pembina/Guru</div>
            </div>
            <a href="{{ route('dashboard') }}" style="font-size: 13px; font-weight: 700; color: #64748b; text-decoration: none;">
                ← Kembali ke Dashboard
            </a>
        </div>

        <div style="padding: 32px 36px;">
            {{-- Alert Error jika validasi gagal atau ruangan bentrok --}}
            @if ($errors->any())
                <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-size: 14px; font-weight: 600;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); animation: slideUp 0.4s ease;">
                
                {{-- TAMBAHAN: enctype="multipart/form-data" WAJIB ADA UNTUK UPLOAD FILE --}}
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="requested_by" value="{{ auth()->id() }}">

                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
                        
                        <div style="display: flex; flex-direction: column; gap: 20px;">
                            <div>
                                <label style="display:block; font-size:13px; font-weight:700; color:#64748b; margin-bottom:8px;">Judul Event</label>
                                <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Classmeeting Futsal XI PPLG" required 
                                    style="width:100%; padding:12px; border-radius:12px; border:2px solid #f1f5f9; font-weight:600; outline:none; transition:0.2s;"
                                    onfocus="this.style.borderColor='#3b82f6'">
                            </div>

                            <div>
                                <label style="display:block; font-size:13px; font-weight:700; color:#64748b; margin-bottom:8px;">Deskripsi & Tujuan</label>
                                <textarea name="description" rows="5" placeholder="Jelaskan detail acaramu di sini..." 
                                    style="width:100%; padding:12px; border-radius:12px; border:2px solid #f1f5f9; font-weight:500; outline:none;">{{ old('description') }}</textarea>
                            </div>

                            {{-- TAMBAHAN: INPUT FILE (ATTACHMENTS) --}}
                            <div>
                                <label style="display:block; font-size:13px; font-weight:700; color:#64748b; margin-bottom:8px;">Lampiran Dokumen / Proposal (Optional)</label>
                                <div style="border: 2px dashed #f1f5f9; padding: 20px; border-radius: 12px; text-align: center;">
                                    <input type="file" name="attachments[]" multiple style="font-size: 13px; color: #64748b;">
                                    <div style="font-size: 11px; color: #94a3b8; margin-top: 8px;">Format: PDF, JPG, PNG, DOC (Maks. 5MB per file)</div>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div>
                                    <label style="display:block; font-size:13px; font-weight:700; color:#64748b; margin-bottom:8px;">Target Peserta</label>
                                    <input type="text" name="target_audience" value="{{ old('target_audience') }}" placeholder="Contoh: Siswa Kelas X & XI" 
                                        style="width:100%; padding:12px; border-radius:12px; border:2px solid #f1f5f9;">
                                </div>
                                <div>
                                    <label style="display:block; font-size:13px; font-weight:700; color:#64748b; margin-bottom:8px;">Kategori Event</label>
                                    <select name="category_id" required style="width:100%; padding:12px; border-radius:12px; border:2px solid #f1f5f9; font-weight:600; background:white;">
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 20px; background: #f8fafc; padding: 24px; border-radius: 20px; border: 1px solid #f1f5f9;">
                            <div>
                                <label style="display:block; font-size:13px; font-weight:700; color:#64748b; margin-bottom:8px;">Lokasi / Ruangan</label>
                                <select name="room_id" style="width:100%; padding:12px; border-radius:12px; border:2px solid #e2e8f0; font-weight:600; background:white;">
                                    <option value="">-- Pilih Lokasi --</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label style="display:block; font-size:13px; font-weight:700; color:#64748b; margin-bottom:8px;">Waktu Mulai</label>
                                <input type="datetime-local" name="start_datetime" value="{{ old('start_datetime') }}" required style="width:100%; padding:12px; border-radius:12px; border:2px solid #e2e8f0; font-family:inherit;">
                            </div>

                            <div>
                                <label style="display:block; font-size:13px; font-weight:700; color:#64748b; margin-bottom:8px;">Waktu Selesai</label>
                                <input type="datetime-local" name="end_datetime" value="{{ old('end_datetime') }}" required style="width:100%; padding:12px; border-radius:12px; border:2px solid #e2e8f0; font-family:inherit;">
                            </div>

                            <hr style="border:0; border-top: 1px solid #e2e8f0; margin: 10px 0;">

                            <button type="submit" name="status" value="pending" 
                                style="width:100%; background: #2563eb; color: white; padding: 14px; border-radius: 12px; border: none; font-weight: 800; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 12px rgba(37,99,235,0.2);">
                                Kirim Pengajuan 🚀
                            </button>
                            
                            <button type="submit" name="status" value="draft" 
                                style="width:100%; background: white; color: #64748b; padding: 12px; border-radius: 12px; border: 1px solid #e2e8f0; font-weight: 700; cursor: pointer;">
                                Simpan sebagai Draft
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <style>
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-app-layout>