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
  
<x-header></x-header>
@if (session('success'))
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="rounded-lg bg-green-100 border border-green-400 text-green-800 px-4 py-3 shadow-md">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-green-600 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-semibold">Berhasil:</span>
                <span class="ml-1">{{ session('success') }}</span>
            </div>
        </div>
    </div>
@endif

    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="container">
          <h4 class="mb-4">Sinkronisasi Data SIRUP</h4>
 
          <div class="d-flex gap-3">
              <form method="POST" action="{{ route('syncpenyedia') }}">
                  @csrf
                  <select name="tahun" class="form-control" id="tahun">
                    @php
                        $currentYear = now()->year;
                    @endphp
                    @for ($i = $currentYear; $i >= $currentYear - 9; $i--)
                        <option value="{{ $i }}" {{ request('tahun', $currentYear) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                  <button type="submit" class="btn btn-success">Sync SIRUP Penyedia</button>
              </form>
      
              <form method="POST" action="{{ route('syncswakelola') }}">
                  @csrf
                  <select name="tahun" class="form-control" id="tahun">
                    @php
                        $currentYear = now()->year;
                    @endphp
                    @for ($i = $currentYear; $i >= $currentYear - 9; $i--)
                        <option value="{{ $i }}" {{ request('tahun', $currentYear) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                  <button type="submit" class="btn btn-warning">Sync SIRUP Swakelola</button>
              </form>
              <form method="POST" action="{{ route('syncsatker') }}">
                @csrf
                <select name="tahun" class="form-control" id="tahun">
                  @php
                      $currentYear = now()->year;
                  @endphp
                  @for ($i = $currentYear; $i >= $currentYear - 9; $i--)
                      <option value="{{ $i }}" {{ request('tahun', $currentYear) == $i ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
              </select>
                <button type="submit" class="btn btn-success">Sync SIRUP Satker</button>
            </form>
          </div>
      </div>

      </div>
    </main>
  </div>
  
</body>
</html>