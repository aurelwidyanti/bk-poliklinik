<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Detail Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="mt-6">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nomor Rekam Medis</label>
                            <input type="text" class="rounded form-control" id="formGroupExampleInput"
                                placeholder="Example input" value="{{ $periksa->janjiPeriksa->pasien->no_rm }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nama</label>
                            <input type="text" class="rounded form-control" id="formGroupExampleInput"
                                placeholder="Example input" value="{{ $periksa->janjiPeriksa->pasien->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Keluhan</label>
                            <textarea type="text" class="rounded form-control" id="formGroupExampleInput" placeholder="Example input" readonly>{{ $periksa->janjiPeriksa->keluhan }}</textarea>
                        </div>
                    </div>
                    <form class="mt-6" action="{{ route('dokter.janji-periksa.store', $periksa->janjiPeriksa->id) }}"
                        method="POST">
                        @csrf

                        <div class="mb-3 form-group">
                            <label for="tgl_periksa">Tanggal Periksa</label>
                            <input type="date" class="rounded form-control" id="tgl_periksa" name="tgl_periksa"
                                value="{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('Y-m-d') }}">
                        </div>

                        <div class="mb-3 form-group">
                            <label for="catatan">Catatan</label>
                            <textarea type="text" class="rounded form-control" id="catatan" name="catatan">{{ $periksa->catatan }}</textarea>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="obat">Obat</label>
                            <select class="rounded form-control" id="obat" name="obat[]" required multiple>
                                @foreach ($obats as $obat)
                                    <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                        {{ $obat->nama_obat }} - {{ $obat->harga }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-gray-500">Tahan tombol Ctrl untuk memilih lebih dari satu obat.</small>
                            @error('obat')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="">Biaya Periksa</label>
                            <input type="text" class="rounded form-control" id="biaya_periksa" name="biaya_periksa"
                                value="150000" readonly>
                        </div>


                        {{-- Tombol Aksi --}}
                        <div class="flex items-center gap-4 mt-4">
                            <a href="{{ route('dokter.janji-periksa.index') }}" class="btn btn-secondary">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const obatSelect = document.getElementById('obat');
            const biayaInput = document.getElementById('biaya_periksa');
            const biayaDokter = 150000;

            function updateBiayaPeriksa() {
                let total = biayaDokter;
                Array.from(obatSelect.selectedOptions).forEach(option => {
                    const harga = parseInt(option.getAttribute('data-harga')) || 0;
                    total += harga;
                });
                biayaInput.value = total
            }

            obatSelect.addEventListener('change', updateBiayaPeriksa);
        })
    </script>
</x-app-layout>
