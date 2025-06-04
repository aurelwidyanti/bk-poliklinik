<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Data Jadwal Periksa') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan perbarui informasi jadwal periksa sesuai dengan hari, jam, dan status terbaru.') }}
                            </p>
                        </header>

                        <form class="mt-6" action="{{ route('dokter.jadwal-periksa.update', $jadwalPeriksa->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- ID Dokter (Hidden) --}}
                            <input
                                type="hidden"
                                name="id_dokter"
                                value="{{ Auth::user()->id }}"
                            >

                            {{-- Hari --}}
                            <div class="mb-3 form-group">
                                <label for="editHariInput">Hari</label>
                                <select
                                    class="rounded form-control"
                                    id="editHariInput"
                                    name="hari"
                                >
                                    <option value="" disabled>Pilih Hari</option>
                                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                        <option value="{{ $hari }}" {{ $jadwalPeriksa->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                    @endforeach
                                </select>
                                @error('hari')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Jam Mulai --}}
                            <div class="mb-3 form-group">
                                <label for="editJamMulaiInput">Jam Mulai</label>
                                <input
                                    type="time"
                                    class="rounded form-control"
                                    id="editJamMulaiInput"
                                    name="jam_mulai"
                                    value="{{ \Carbon\Carbon::parse($jadwalPeriksa->jam_mulai)->format('H:i') }}"
                                >
                                @error('jam_mulai')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Jam Selesai --}}
                            <div class="mb-3 form-group">
                                <label for="editJamSelesaiInput">Jam Selesai</label>
                                <input
                                    type="time"
                                    class="rounded form-control"
                                    id="editJamSelesaiInput"
                                    name="jam_selesai"
                                    value="{{ \Carbon\Carbon::parse($jadwalPeriksa->jam_selesai)->format('H:i') }}"
                                >
                                @error('jam_selesai')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Status --}}
                            {{-- <div class="mb-3 form-group">
                                <label for="editStatusInput">Status</label>
                                <select
                                    class="rounded form-control"
                                    id="editStatusInput"
                                    name="status"
                                >
                                    <option value="1" {{ $jadwalPeriksa->status ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ !$jadwalPeriksa->status ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            {{-- Tombol Aksi --}}
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ route('dokter.jadwal-periksa.index') }}" class="btn btn-secondary">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>