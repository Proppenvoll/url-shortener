<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full flex flex-col">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>🌐️ Url-Shortener ✂️</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="flex flex-1 flex-col items-center">
    <main class="flex-1 flex flex-col max-w-(--breakpoint-md) w-full p-4 justify-center">
      <h1 class="text-2xl font-bold text-center mt-auto">🌐️ Url-Shortener ✂️</h1>
      <p class="mt-8">Trage unten einen Link ein und klicke auf Umwandeln, um eine verkürzte Version zu erhalten. Dies ist eine Demo-Anwendung. Die generierten Links sind nicht für den dauerhaften Gebrauch gedacht und werden täglich zurückgesetzt.</p>

      <form method="post" action="{{ $formAction }}" class="mt-10">
        @csrf
        <label class="flex flex-col">
          <span class="text-sm font-bold text-neutral-500">Url</span>
          <input type="text" name="{{ $inputName }}" class="bg-neutral-200 border border-neutral-300 rounded p-4" />
        </label>

        <div class="flex items-center mt-2 gap-2">
          <button class="p-4 bg-blue-300 border border-blue-200 rounded cursor-pointer hover:border-blue-400">Umwandeln</button>
          @if (count($errors))
          <p class="text-red-600 m-auto">{{ $errors->first($inputName) }}</p>
          @endif
          </div>
      </form>

      @if (count($urls))
      <table class="mt-12 table-auto border-collapse">
        <thead class="border-bottom-2 border-black sr-only sm:not-sr-only">
          <tr class="text-sm text-neutral-500">
            <th>{{ $tableHeaders['original_url'] }}</th>
            <th>{{ $tableHeaders['short_link'] }}</th>
            <th>{{ $tableHeaders['visit_count'] }}</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($urls as $url)
          <tr class="sm:text-center flex flex-col mt-4 gap-1 sm:table-row">
            <td data-label="{{ $tableHeaders['original_url'] }}" class="before:content-[attr(data-label)':'] before:text-neutral-500 sm:before:hidden"><a href="{{ $url['original_url'] }}" class="hover:underline">{{ $url["original_url"] }}</a></td>

            <td data-label="{{ $tableHeaders['short_link'] }}" class="before:content-[attr(data-label)':'] before:text-neutral-500 before:mr-2 sm:before:hidden"><a href="{{ $url->shortCodeUrl }}" class="hover:underline">{{ $url->shortCodeUrl }}</a></td>

            <td data-label="{{ $tableHeaders['visit_count'] }}" class="before:content-[attr(data-label)':'] before:text-neutral-500 before:mr-2 sm:before:hidden">{{ $url["visit_count"] }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif

      <div class="text-sm mt-auto text-center text-red-400">
        <a href="{{ config('custom.git_repo_url') }}" class="border p-1 px-2 rounded w-fit m-auto hover:bg-red-400 hover:text-neutral-100 cursor-pointer">Zeig mir den Code!</a>

        <div class="mt-3">
          Powered by
          <a href="https://laravel.com" class="hover:underline inline-flex gap-1 items-center">Laravel <x-laravel-icon class="size-8"/></a>
        </div>
      </div>
    </main>
</body>
