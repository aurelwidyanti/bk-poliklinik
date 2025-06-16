<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Janji Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center mb-2 justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Janji Periksa') }}
                        </h2>
                    </header>
                    @if ($jadwalPeriksa)
                        <header class="flex items-center justify-between">
                            <h2 class="text-base text-gray-600">
                                {{ __('Jadwal') }} : {{ $jadwalPeriksa->full_jadwal }}
                            </h2>
                        </header>
                    @endif

                    @if (!$jadwalPeriksa)
                        <div class="text-center py-12">
                            <h3 class="text-lg font-medium uppercase text-gray-900 mb-2">Belum Ada Jadwal Periksa</h3>
                            <p class="text-gray-600">Anda belum memiliki jadwal periksa yang aktif. Silakan tambah atau
                                aktifkan
                                jadwal periksa anda.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto mt-6 rounded">
                            <table class="table table-hover min-w-full">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No Antrian</th>
                                        <th scope="col">No RM</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Keluhan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($janjiPeriksas as $janjiPeriksa)
                                        <tr>
                                            <td class="align-middle text-start">
                                                {{ $janjiPeriksa->no_antrian }}
                                            </td>
                                            <td class="align-middle text-start">
                                                {{ $janjiPeriksa->pasien->no_rm }}
                                            </td>

                                            <td class="align-middle text-start">
                                                {{ $janjiPeriksa->pasien->nama }}
                                            </td>

                                            <td class="align-middle text-start">
                                                {{ $janjiPeriksa->keluhan }}
                                            </td>

                                            <td class="flex items-center gap-3">
                                                {{-- Button Create --}}
                                                @php
                                                    // Cari nomor antrian terkecil dari koleksi janjiPeriksas
                                                    $minNoAntrian = $janjiPeriksas->min('no_antrian');
                                                @endphp
                                                <a href="{{ route('dokter.janji-periksa.show', $janjiPeriksa->id) }}"
                                                    class="btn {{ $janjiPeriksa->no_antrian == $minNoAntrian ? 'btn-success' : 'btn-secondary' }} btn-sm">
                                                    <i class="fa-solid fa-stethoscope"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="align-middle text-center">
                                            Tidak ada janji periksa.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div>
                                {{ $janjiPeriksas->links() }}
                            </div>

                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
