<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Riwayat Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Riwayat Periksa') }}
                        </h2>
                        @if (session('success'))
                            <div class="mb-4 text-green-600 bg-green-100 border border-green-300 rounded px-4 py-2">
                                {{ session('success') }}
                            </div>
                        @endif
                    </header>

                    <div class="overflow-x-auto mt-6 rounded">
                        <table class="table table-hover min-w-full">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal Periksa</th>
                                    <th scope="col">No RM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Biaya Periksa</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($periksas as $periksa)
                                    <tr>
                                        <td class="align-middle text-start">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d-m-Y') }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ $periksa->janjiPeriksa->pasien->no_rm }}
                                        </td>

                                        <td class="align-middle text-start">
                                            {{ $periksa->janjiPeriksa->pasien->nama }}
                                        </td>

                                        <td class="align-middle text-start">
                                            {{ $periksa->janjiPeriksa->keluhan }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ 'Rp' . number_format($periksa->biaya_periksa, 0, ',', '.') }}
                                        </td>
                                        <td class="flex items-center gap-3">
                                            {{-- Button Edit --}}
                                            <a href="{{ route('dokter.riwayat-periksa.edit', $periksa->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="align-middle text-center">
                                            Tidak ada riwayat periksa.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div>
                            {{ $periksas->links() }}
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
