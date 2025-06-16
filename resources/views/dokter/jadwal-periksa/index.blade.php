<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Jadwal Periksa') }}
                        </h2>
                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.jadwal-periksa.create') }}" class="btn btn-primary">Tambah
                                Jadwal</a>

                            @if (session('status') === 'jadwal-created')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">
                                    {{ __('Jadwal berhasil ditambahkan.') }}
                                </p>
                            @elseif (session('status') === 'jadwal-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">
                                    {{ __('Jadwal berhasil diperbarui.') }}
                                </p>
                            @elseif (session('status') === 'jadwal-deleted')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">
                                    {{ __('Jadwal berhasil dihapus.') }}
                                </p>
                            @elseif (session('error'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-red-600">
                                    {{ session('error') }}
                                </p>
                            @endif
                        </div>
                    </header>

                    <div class="overflow-x-auto mt-6 rounded">
                        <table class="table table-hover min-w-full">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Jam Mulai</th>
                                    <th scope="col">Jam Selesai</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalPeriksas as $jadwalPeriksa)
                                    <tr>
                                        <th scope="row" class="align-middle text-start">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="align-middle text-start">
                                            {{ $jadwalPeriksa->hari }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ $jadwalPeriksa->jam_mulai }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ $jadwalPeriksa->jam_selesai }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ $jadwalPeriksa->status ? 'Aktif' : 'Tidak Aktif' }}
                                        </td>
                                        <td class="flex items-center gap-3">
                                            <form
                                                action="{{ route('dokter.jadwal-periksa.updateStatus', $jadwalPeriksa->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')

                                                @if ($jadwalPeriksa->status == true)
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa-solid fa-xmark inline-block mr-1"></i>
                                                        Nonaktifkan
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fa-solid fa-check inline-block mr-1"></i>
                                                        Aktifkan
                                                    </button>
                                                @endif

                                            </form>

                                            <a href="{{ route('dokter.jadwal-periksa.edit', $jadwalPeriksa->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <form action="{{ route('dokter.jadwal-periksa.destroy', $jadwalPeriksa->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div>
                            {{ $jadwalPeriksas->links() }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
