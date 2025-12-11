<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>{{ $cv["name"] }} — CV</title>
        @vite("resources/css/app.css")
    </head>

    <body class="bg-gray-100 text-gray-900 antialiased">
        <div class="mx-auto max-w-3xl p-6">
            {{-- HEADER --}}
            <div class="mb-6 rounded-2xl bg-white p-6 shadow">
                <h1 class="text-3xl font-bold">{{ $cv["name"] }}</h1>
                <p class="text-lg text-gray-600">{{ $cv["title"] }}</p>
                <div class="mt-2 text-sm text-gray-500">
                    <p>{{ $cv["location"] }}</p>
                    <p>{{ $cv["email"] }}</p>
                </div>

                {{-- SOCIAL --}}
                <div class="mt-4 flex gap-4">
                    @foreach ($cv["social"] as $platform => $url)
                        <a
                            href="{{ $url }}"
                            target="_blank"
                            class="text-blue-600 capitalize hover:underline"
                        >
                            {{ $platform }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- SUMMARY --}}
            <div class="mb-6 rounded-2xl bg-white p-6 shadow">
                <h2 class="mb-2 text-xl font-semibold">Summary</h2>
                <div class="prose prose-blue max-w-none">
                    {!! $cv["summary_html"] !!}
                </div>
            </div>

            {{-- SKILLS --}}
            <div class="mb-6 rounded-2xl bg-white p-6 shadow">
                <h2 class="mb-2 text-xl font-semibold">Skills</h2>
                <ul class="flex flex-wrap gap-2">
                    @foreach ($cv["top_skills"] as $skill)
                        <li
                            class="rounded-full bg-gray-200 px-3 py-1 text-sm text-gray-800"
                        >
                            {{ $skill }}
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- EXPERIENCE --}}
            <div class="mb-6 rounded-2xl bg-white p-6 shadow">
                <h2 class="mb-4 text-xl font-semibold">Experience</h2>

                @foreach ($cv["experience"] as $exp)
                    <div class="mb-6">
                        <p class="text-lg font-semibold">
                            {{ $exp["role"] }} — {{ $exp["company"] }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $exp["start"] }} – {{ $exp["end"] }}
                        </p>

                        <div
                            class="prose prose-blue mt-2 max-w-none [&_ul]:list-disc [&_ul]:pl-6"
                        >
                            {!! $exp["description_html"] !!}
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- EDUCATION --}}
            <div class="mb-6 rounded-2xl bg-white p-6 shadow">
                <h2 class="mb-4 text-xl font-semibold">Education</h2>

                @foreach ($cv["education"] as $edu)
                    <div class="mb-4">
                        <p class="font-semibold">{{ $edu["degree"] }}</p>
                        <p class="text-gray-700">{{ $edu["school"] }}</p>
                        <p class="text-gray-700">{{ $edu["location"] }}</p>
                        <p class="text-sm text-gray-500">
                            {{ $edu["start"] }} – {{ $edu["end"] }}
                        </p>
                    </div>
                @endforeach
            </div>

            {{-- DOWNLOAD PDF --}}
            <div class="mt-8 text-center">
                <a
                    href="{{ route("cv.download") }}"
                    class="rounded-xl bg-blue-600 px-6 py-3 text-white shadow transition hover:bg-blue-700"
                >
                    Download PDF
                </a>
            </div>
        </div>
    </body>
</html>
