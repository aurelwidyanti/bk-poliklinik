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
                            {{ __('Daftar Obat Terhapus') }}
                        </h2>
                        <div class="flex items-center gap-2">
                            <form action="{{ route('dokter.obat.restoreAll') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Restore All
                                </button>
                            </form>

                            <form action="{{ route('dokter.obat.forceDeleteAll') }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus PERMANEN semua obat? Data yang dihapus tidak dapat dikembalikan!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt mr-1"></i>Hapus Semua Permanen
                                </button>
                            </form>

                        </div>
                    </header>

                    @if (session('status'))
                        <div
                            class="mt-4 p-4 rounded-md 
                              {{ session('status') === 'obat-restored' ? 'bg-green-50 border border-green-200' : '' }}
                              {{ session('status') === 'obat-force-deleted' ? 'bg-red-50 border border-red-200' : '' }}
                              {{ session('status') === 'all-obat-force-deleted' ? 'bg-red-50 border border-red-200' : '' }}">
                            <p
                                class="text-sm 
                                {{ session('status') === 'obat-restored' ? 'text-green-800' : '' }}
                                {{ session('status') === 'obat-force-deleted' ? 'text-red-800' : '' }}
                                {{ session('status') === 'all-obat-force-deleted' ? 'text-red-800' : '' }}">
                                @if (session('status') === 'obat-restored')
                                    <i class="fas fa-check-circle mr-2"></i>Obat berhasil direstore!
                                @elseif (session('status') === 'obat-force-deleted')
                                    <i class="fas fa-trash-alt mr-2"></i>Obat berhasil dihapus permanen!
                                @elseif (session('status') === 'all-obat-force-deleted')
                                    <i class="fas fa-trash-alt mr-2"></i>Semua obat berhasil dihapus permanen!
                                @endif
                            </p>
                        </div>
                    @endif

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
                                @forelse ($obats as $obat)
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
                                            {{-- Button Restore --}}
                                            <form action="{{ route('dokter.obat.restore', $obat->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fa-solid fa-rotate-left"></i>
                                                </button>
                                            </form>

                                            {{-- Button Force Delete --}}
                                            <form action="{{ route('dokter.obat.forceDelete', $obat->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Yakin ingin menghapus PERMANEN obat {{ $obat->nama_obat }}? Data yang dihapus tidak dapat dikembalikan!')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    title="Hapus permanen">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="align-middle text-center">
                                            Tidak ada obat yang ditandai terhapus.
                                        </td>
                                    </tr>
                                @endforelse
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
