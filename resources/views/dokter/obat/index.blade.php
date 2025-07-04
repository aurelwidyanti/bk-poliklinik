<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat') }}
                        </h2>
                        <div class="flex flex-row gap-2">
                            <div>
                                <a href="{{ route('dokter.obat.create') }}" class="btn btn-primary">Tambah Obat</a>

                                @if (session('status') === 'obat-created')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">
                                        {{ __('Created.') }}
                                    </p>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('dokter.obat.deleted') }}" class="btn btn-secondary">Obat Terhapus</a>
                            </div>
                        </div>
                    </header>

                    <div class="overflow-x-auto mt-6 rounded">
                        <table class="table table-hover min-w-full">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Obat</th>
                                    <th scope="col">Kemasan</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($obats as $obat)
                                    <tr>
                                        <th scope="row" class="align-middle text-start">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="align-middle text-start">
                                            {{ $obat->nama_obat }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ $obat->kemasan }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="flex items-center gap-3">
                                            {{-- Button Edit --}}
                                            <a href="{{ route('dokter.obat.edit', $obat->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            {{-- Button Delete --}}
                                            <form action="{{ route('dokter.obat.destroy', $obat->id) }}"
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
                            {{ $obats->links() }}
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
