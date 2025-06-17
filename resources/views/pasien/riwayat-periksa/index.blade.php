<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Riwayat Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm-sm:p-8 sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Riwayat Janji Periksa') }}
                        </h2>
                    </header>

                    {{-- Table --}}
                    <div class="overflow-x-auto mt-6 rounded">
                        <table class="table table-hover min-w-full">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Poliklinik</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Mulai</th>
                                    <th scope="col">Selesai</th>
                                    <th scope="col">Antrian</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($janjiPeriksas as $janjiPeriksa)
                                    <tr>
                                        <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                        <td class="align-middle text-start">
                                            {{ $janjiPeriksa->jadwalPeriksa->dokter->poli->nama }}</td>
                                        <td class="align-middle text-start">
                                            {{ $janjiPeriksa->jadwalPeriksa->dokter->nama }}</td>
                                        <td class="align-middle text-start">{{ $janjiPeriksa->jadwalPeriksa->hari }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ \Carbon\Carbon::parse($janjiPeriksa->jadwalPeriksa->jam_mulai)->format('H.i') }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ \Carbon\Carbon::parse($janjiPeriksa->jadwalPeriksa->jam_selesai)->format('H.i') }}
                                        </td>
                                        <td class="align-middle text-start">{{ $janjiPeriksa->no_antrian }}</td>
                                        <td class="align-middle text-start">
                                            @if (is_null($janjiPeriksa->periksa))
                                                <span
                                                    class="inline-block px-3 py-2 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">
                                                    <i class="fas fa-clock mr-1"></i> Belum Diperiksa
                                                </span>
                                            @else
                                                <span
                                                    class="inline-block px-3 py-2 text-xs font-semibold text-green-800 bg-green-200 rounded-full">
                                                    <i class="fas fa-check-circle mr-1"></i> Sudah Diperiksa
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-start">
                                            @if (is_null($janjiPeriksa->periksa))
                                                <a href="{{ route('pasien.riwayat-periksa.detail', $janjiPeriksa->id) }}"
                                                    class="btn btn-info">Detail</a>

                                                <!-- Modal -->
                                                <div class="modal fade bd-example-modal-lg"
                                                    id="detailModal{{ $janjiPeriksa->id }}" tabindex="-1"
                                                    role="dialog"
                                                    aria-labelledby="detailModalTitle{{ $janjiPeriksa->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered"
                                                        role="document">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h5 class="modal-title font-weight-bold"
                                                                    id="riwayatModalLabel{{ $janjiPeriksa->id }}">
                                                                    Detail Riwayat Pemeriksaan
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <!-- Modal Body -->
                                                            <div class="modal-body">
                                                                <ul class="list-group">
                                                                    <li class="list-group-item">
                                                                        <strong>Poliklinik:</strong>
                                                                        {{ $janjiPeriksa->jadwalPeriksa->dokter->poli->nama }}
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <strong>Nama Dokter:</strong>
                                                                        {{ $janjiPeriksa->jadwalPeriksa->dokter->nama }}
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <strong>Hari Pemeriksaan:</strong>
                                                                        {{ $janjiPeriksa->jadwalPeriksa->hari }}
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <strong>Jam Mulai:</strong>
                                                                        {{ \Carbon\Carbon::parse($janjiPeriksa->jadwalPeriksa->jam_mulai)->format('H.i') }}
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <strong>Jam Selesai:</strong>
                                                                        {{ \Carbon\Carbon::parse($janjiPeriksa->jadwalPeriksa->jam_selesai)->format('H.i') }}
                                                                    </li>
                                                                </ul>

                                                                <!-- Highlight Nomor Antrian -->
                                                                <div class="mt-4 text-center">
                                                                    <div class="mb-2 h5 font-weight-bold">Nomor Antrian
                                                                        Anda
                                                                    </div>
                                                                    <span class="badge badge-primary"
                                                                        style="font-size: 1.75rem; padding: 0.6em 1.2em;">
                                                                        {{ $janjiPeriksa->no_antrian }}
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <!-- Modal Footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    Tutup
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <a href="{{ route('pasien.riwayat-periksa.riwayat', $janjiPeriksa->id) }}"
                                                    class="btn btn-secondary">Riwayat</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="align-middle text-center">
                                            Anda belum memiliki janji periksa. Silakan membuat janji periksa dulu.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div>
                        {{ $janjiPeriksas->links() }}
                    </div>

                </section>
            </div>
        </div>
    </div>
</x-app-layout>
