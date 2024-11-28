<x-app-layout>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        /* Pemecahan halaman untuk PDF */
        tr {
            page-break-inside: avoid;
        }

        thead {
            display: table-header-group;
        }

        tbody {
            display: table-row-group;
        }

        tfoot {
            display: table-footer-group;
        }

        /* Hindari tabel terpotong */
        table {
            page-break-inside: auto;
        }
    </style>

    <x-slot name="header">
        @if (empty($isPDF)) {{-- Hanya tampilkan di web --}}
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Dashboard') }}
            </h2>
        @endif
    </x-slot>

    <div class="container p-4 mx-auto">
        <div class="overflow-x-auto">
            @if (empty($isPDF)) {{-- Hanya tampilkan di web --}}
                <!-- Tombol Add Product dan Export -->
                <div class="flex justify-between mb-4">
                    <a href="{{ route('product-create') }}">
                        <button
                            class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Add Product Data
                        </button>
                    </a>
                    <a href="{{ route('product.export.excel') }}">
                        <button
                            class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Export to Excel
                        </button>
                    </a>
                    <a href="{{ route('product.export.pdf') }}">
                        <button
                            class="px-6 py-4 text-white bg-red-500 border border-red-500 rounded-lg shadow-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Export to PDF
                        </button>
                    </a>
                </div>

                <!-- Form Pencarian -->
                <div class="flex mt-4">
                    <form action="{{ route('product.index') }}" method="get">
                        <input
                            class="w-full rounded-lg border border-gray-300 py-2 focus:outline-none focus:ring-3 focus:ring-green-500"
                            type="text" name="search" value="{{ request('search') }}" placeholder="Cari product...">
                        <button
                            class="ml-2 rounded-lg bg-green-500 px-4 py-2 text-white shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500"
                            type="submit">Cari</button>
                    </form>
                </div>
            @endif

            <!-- Tabel Produk -->
            <table class="min-w-full mt-4 border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Product Name</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Unit</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Type</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Information</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Qty</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Producer</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Supplier Name </th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Action</th>
                        </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="bg-white">
                            <td class="px-4 py-2 border border-gray-200">{{ $item->id }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $item->product_name }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $item->unit }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $item->type }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $item->information }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $item->qty }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $item->producer }}</td>
                            <td class="px-4 py-2 border border-gray-200">
                                {{ $item->supplier?->supplier_name ?? '-' }}
                            </td>
                            <td class="px-4 py-2 border border-gray-200">
                                <a href="{{ route('product-edit', $item->id) }}" class="px-2 text-blue-600 hover:text-blue-800">Edit</a>
                                <button class="px-2 text-red-600 hover:text-red-800" onclick="confirmDelete(id)">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-red-600 font-bold">No Products Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            @if (empty($isPDF) && $data instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="mt-4">
                    {{ $data->appends(['search' => request('search')])->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function confirmDelete(id, deleteUrl) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;

                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</x-app-layout>