<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Halaman Home</title>
</head>

<body class="h-full">

    <div class="min-h-full">
        <x-navbar></x-navbar>

        <header class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Penyedia</h1>
            </div>
        </header>
        <main>
            <section class="container px-4 mx-auto">
                <div class="flex justify-end items-center mt-2">
                    <form action="{{ route('penyedia') }}" method="GET" class="flex gap-4 items-center">
                        <div>
                            <label for="tahun" class="sr-only">Tahun</label>
                            <select name="tahun" id="tahun" class="px-4 py-2 border rounded-lg">
                                <option value="">Pilih Tahun</option>
                                @foreach ($tahun_options as $tahun)
                                    <option value="{{ $tahun->tahun_anggaran }}"
                                        @if (request('tahun') == $tahun->tahun_anggaran) selected @endif>
                                        {{ $tahun->tahun_anggaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="opd" class="sr-only">OPD</label>
                            <select name="opd" id="opd" class="px-4 py-2 border rounded-lg">
                                <option value="">Pilih OPD</option>
                                @foreach ($opd_options as $opd)
                                    <option value="{{ $opd->nama_satker }}"
                                        @if (request('opd') == $opd->nama_satker) selected @endif>
                                        {{ $opd->nama_satker }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <input type="text" name="search" id="search" class="px-4 py-2 border rounded-lg"
                                placeholder="Cari Nama Paket atau ID RUP" value="{{ request('search') }}">
                        </div>

                        <div>
                            <button type="submit"
                                class="px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                                Filter
                            </button>
                        </div>
                        <div>
                            <button type="submit" formaction="{{ route('penyedia.export') }}"
                                class="px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-green-600 rounded-lg hover:bg-green-500 focus:outline-none focus:ring focus:ring-green-300 focus:ring-opacity-80">
                                Export Excel
                            </button>
                        </div>
                    </form>
                </div>


                <div class="flex flex-col mt-2">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">

                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-800">
                                        <tr class="text-center">
                                            <th scope="col" class="py-3.5 px-4">No</th>
                                            <th scope="col" class="py-3.5 px-4">OPD</th>
                                            <th scope="col" class="py-3.5 px-4">Nama Paket</th>
                                            <th scope="col" class="py-3.5 px-4">ID RUP</th>
                                            <th scope="col" class="py-3.5 px-4">Jenis</th>
                                            <th scope="col" class="py-3.5 px-4">Metode</th>
                                            <th scope="col" class="py-3.5 px-4">Pagu</th>
                                            <th scope="col" class="py-3.5 px-4">Terumumkan</th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                        @php
                                            $no = $siruppenyedia->firstItem();
                                        @endphp
                                        @foreach ($siruppenyedia as $item)
                                            <tr>
                                                <td class="px-2 py-2 text-sm font-medium text-center">
                                                    {{ $no++ }}</td>
                                                <td class="px-2 py-2 text-sm font-medium">{{ $item->nama_satker }}</td>
                                                <td class="px-2 py-2 text-sm font-medium">{{ $item->nama_paket }}</td>
                                                <td class="px-2 py-2 text-sm font-medium">{{ $item->kd_rup }}</td>
                                                <td class="px-2 py-2 text-sm font-medium">{{ $item->jenis_pengadaan }}
                                                </td>
                                                <td class="px-2 py-2 text-sm font-medium">{{ $item->metode_pengadaan }}
                                                </td>
                                                <td class="px-2 py-2 text-sm font-medium">
                                                    {{ 'Rp.' . number_format($item->pagu, 0, ',', '.') . ',-' }}</td>
                                                <td class="px-2 py-2 text-sm font-medium">
                                                    {{ date('d F Y', strtotime($item->tgl_pengumuman_paket)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex items-center mt-6">
                    {{ $siruppenyedia->links() }}
                </div>
            </section>
        </main>
    </div>

</body>

</html>
