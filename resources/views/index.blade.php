<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta
    name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
  >
  <meta
    http-equiv="X-UA-Compatible"
    content="ie=edge"
  >
  <title>{{ config('access-screen.app_name') }}</title>

  <link
    rel="stylesheet"
    href="{{ asset('vendor/access-screen/css/protection-screen.css') }}"
  >
</head>
<body>
  <div id="app">
    <div class="relative flex-none overflow-hidden px-6 lg:pointer-events-none lg:fixed lg:inset-0 lg:z-40 lg:flex lg:px-0">
      <div class="absolute inset-0 -z-10 overflow-hidden bg-gray-950 lg:min-w-[32rem]">
        <svg
          class="absolute -bottom-48 left-[-40%] h-[80rem] w-[180%] lg:top-[-40%] lg:-right-40 lg:bottom-auto lg:left-auto lg:h-[180%] lg:w-[80rem]"
          aria-hidden="true"
        >
          <defs>
            <radialGradient
              id=":S1:-desktop"
              cx="100%"
            >
              <stop
                offset="0%"
                stop-color="rgba(56, 189, 248, 0.3)"
              ></stop>
              <stop
                offset="53.95%"
                stop-color="rgba(0, 71, 255, 0.09)"
              ></stop>
              <stop
                offset="100%"
                stop-color="rgba(10, 14, 23, 0)"
              ></stop>
            </radialGradient>
            <radialGradient
              id=":S1:-mobile"
              cy="100%"
            >
              <stop
                offset="0%"
                stop-color="rgba(56, 189, 248, 0.3)"
              ></stop>
              <stop
                offset="53.95%"
                stop-color="rgba(0, 71, 255, 0.09)"
              ></stop>
              <stop
                offset="100%"
                stop-color="rgba(10, 14, 23, 0)"
              ></stop>
            </radialGradient>
          </defs>
          <rect
            width="100%"
            height="100%"
            fill="url(#:S1:-desktop)"
            class="hidden lg:block"
          ></rect>
          <rect
            width="100%"
            height="100%"
            fill="url(#:S1:-mobile)"
            class="lg:hidden"
          ></rect>
        </svg>
        <div class="absolute inset-x-0 right-0 bottom-0 h-px bg-white mix-blend-overlay lg:top-0 lg:left-auto lg:h-auto lg:w-px"></div>
      </div>

      <div class="relative flex justify-center w-full lg:pointer-events-auto lg:min-w-[32rem] lg:overflow-x-hidden lg:overflow-y-auto">
        <div class="mx-auto max-w-lg lg:mx-0 lg:flex lg:w-96 lg:max-w-none lg:flex-col lg:before:pt-6">
          <div class="pt-20 pb-16 sm:pt-32 sm:pb-20 lg:py-20">
            <div class="relative">
              <h2 class="text-2xl font-bold text-white">
                {{ config('access-screen.app_name') }}
              </h2>

              <h1 class="mt-14 font-display text-4xl/tight font-light text-white">
                {{ config('access-screen.title_line1') }}

                <br>

                <span class="text-sky-300">
                  {{ config('access-screen.title_line2') }}
                </span>
              </h1>

              <p class="mt-4 text-sm/6 text-gray-300">
                {{ config('access-screen.description') }}
              </p>

              <form
                action="{{ route('access-screen::store') }}"
                method="POST"
              >
                <div
                  class="relative isolate mt-8 flex items-center pr-1"
                >
                  @csrf

                  <label
                    for="access-key-input"
                    class="sr-only"
                  >
                    Access key
                  </label>

                  <input
                    type="{{ config('access-screen.input_type') }}"
                    autocomplete="password"
                    id="access-key-input"
                    placeholder="ACCESS KEY"
                    class="
                      peer w-0 flex-auto bg-transparent px-4 py-2.5 text-base text-white
                      placeholder:text-gray-500 focus:outline-hidden sm:text-[0.8125rem]/6
                    "
                    name="access_key"
                    value="{{ old('access_key') }}"
                    required
                    autofocus
                  >

                  <button
                    class="group relative isolate flex-none rounded-md py-1.5 text-[0.8125rem]/6 font-semibold text-white pl-2.5 pr-[calc(9/16*1rem)]"
                    type="submit"
                  >
                    <span class="absolute inset-0 rounded-md bg-linear-to-b from-white/80 to-white opacity-10 transition-opacity group-hover:opacity-15"></span>
                    <span class="absolute inset-0 rounded-md opacity-7.5 shadow-[inset_0_1px_1px_white] transition-opacity group-hover:opacity-10"></span>
                    Get access
                    <span aria-hidden="true">→</span>
                  </button>

                  <div class="absolute inset-0 -z-10 rounded-lg transition peer-focus:ring-4 peer-focus:ring-sky-300/15"></div>
                  <div class="absolute inset-0 -z-10 rounded-lg bg-white/2.5 ring-1 ring-white/15 transition peer-focus:ring-sky-300"></div>
                </div>

                @error('access_key')
                <div class="mt-2 text-sm text-rose-500">
                  {{ $message }}
                </div>
                @enderror
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
