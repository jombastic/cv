<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $cv['name'] }} - CV</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-900 antialiased">
    <div class="mx-auto max-w-3xl p-4 sm:p-6">
        {{-- HEADER --}}
        <div class="mb-6 rounded-2xl bg-white p-4 sm:p-6 shadow">
            <h1 class="text-2xl sm:text-3xl font-bold">{{ $cv['name'] }}</h1>
            <p class="text-base sm:text-lg text-gray-600">{{ $cv['title'] }}</p>
            <div class="mt-2 text-xs sm:text-sm text-gray-500">
                <p>{{ $cv['location'] }}</p>
                <p>{{ $cv['email'] }}</p>
            </div>

            {{-- SOCIAL --}}
            <div class="mt-4 flex flex-wrap gap-2 sm:gap-4">
                @foreach ($cv['social'] as $platform => $url)
                    <a href="{{ $url }}" target="_blank"
                        class="flex items-center text-blue-600 capitalize hover:underline text-sm sm:text-base">
                        @svg('icon-' . $platform, ['class' => 'w-5 h-5', 'aria-hidden' => 'true'])
                        {{ $platform }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- SUMMARY --}}
        <div class="mb-6 rounded-2xl bg-white p-4 sm:p-6 shadow">
            <h2 class="mb-2 text-lg sm:text-xl font-semibold">Summary</h2>
            <div class="prose prose-blue max-w-none text-sm sm:text-base">
                {!! $cv['summary_html'] !!}
            </div>
        </div>

        {{-- SKILLS --}}
        <div class="mb-6 rounded-2xl bg-white p-4 sm:p-6 shadow">
            <h2 class="mb-2 text-lg sm:text-xl font-semibold">Skills</h2>
            <ul class="flex flex-wrap gap-2">
                @foreach ($cv['top_skills'] as $skill)
                    <li class="rounded-full bg-gray-200 px-3 py-1 text-xs sm:text-sm text-gray-800">
                        {{ $skill }}
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- EXPERIENCE --}}
        <div class="mb-6 rounded-2xl bg-white p-4 sm:p-6 shadow">
            <h2 class="mb-4 text-lg sm:text-xl font-semibold">Experience</h2>

            @foreach ($cv['experience'] as $exp)
                <div class="mb-6">
                    <p class="text-base sm:text-lg font-semibold">
                        {{ $exp['role'] }} - {{ $exp['company'] }}
                    </p>
                    <p class="text-xs sm:text-sm text-gray-500">
                        {{ $exp['start'] }} – {{ $exp['end'] }}
                    </p>

                    <div class="prose prose-blue mt-2 max-w-none [&_ul]:list-disc [&_ul]:pl-6 text-sm sm:text-base">
                        {!! $exp['description_html'] !!}
                    </div>
                </div>
            @endforeach
        </div>

        {{-- EDUCATION --}}
        <div class="mb-6 rounded-2xl bg-white p-4 sm:p-6 shadow">
            <h2 class="mb-4 text-lg sm:text-xl font-semibold">Education</h2>
            @foreach ($cv['education'] as $edu)
                <div class="mb-4">
                    <p class="font-semibold text-sm sm:text-base">{{ $edu['degree'] }}</p>
                    <p class="text-gray-700 text-sm">{{ $edu['school'] }}</p>
                    <p class="text-gray-700 text-sm">{{ $edu['location'] }}</p>
                    <p class="text-xs sm:text-sm text-gray-500">
                        {{ $edu['start'] }} – {{ $edu['end'] }}
                    </p>
                </div>
            @endforeach
        </div>

        {{-- DOWNLOAD PDF --}}
        <div class="mt-8 text-center">
            <a href="{{ route('cv.download') }}"
                class="inline-block w-full sm:w-auto rounded-xl bg-blue-600 px-6 py-3 text-white shadow transition hover:bg-blue-700 text-base sm:text-lg">
                Download PDF
            </a>
        </div>
    </div>
</body>

</html>
