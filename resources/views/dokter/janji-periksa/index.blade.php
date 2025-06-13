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
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Jadwal') }} : {{ $jadwalPeriksa->full_jadwal }}
                        </h2>
                    </header>

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
                                @foreach ($janjiPeriksas as $janjiPeriksa)
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
                                            <a href="{{ route('dokter.janji-periksa.show', $janjiPeriksa->id) }}"
                                                class="btn btn-secondary btn-sm">
                                                <i class="fa-solid fa-stethoscope"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div>
                            {{ $janjiPeriksas->links() }}
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
