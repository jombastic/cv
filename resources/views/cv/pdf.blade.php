<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $cv['name'] }} — CV</title>
    <style type="text/css">
        @page {
            margin: 20mm 18mm;
        }

        html,
        body {
            font-family: "DejaVu Sans", Arial, sans-serif;
            font-size: 12px;
            color: #222;
            line-height: 1.35;
        }

        .container {
            width: 100%;
            box-sizing: border-box;
        }

        .section {
            margin-bottom: 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e5e5e5;
        }

        .name {
            font-size: 22px;
            font-weight: 700;
            margin: 0;
        }

        .title {
            margin: 2px 0 6px 0;
            color: #555;
            font-size: 13px;
        }

        .contact {
            font-size: 11px;
            color: #333;
        }

        .section-title {
            font-weight: 700;
            font-size: 13px;
            margin: 0 0 6px 0;
            color: #111;
        }

        .prose {
            font-size: 11.5px;
            color: #222;
        }

        .skills {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .skills li {
            display: inline-block;
            margin: 0 6px 6px 0;
            padding: 3px 7px;
            background: #f0f0f0;
            border-radius: 3px;
            font-size: 10.5px;
        }

        .exp {
            margin-bottom: 12px;
        }

        .exp .role {
            font-weight: 600;
            font-size: 12.5px;
            margin: 0;
        }

        .exp .meta {
            font-size: 11px;
            color: #555;
            margin: 0 0 4px 0;
        }

        .exp .desc {
            font-size: 11.5px;
            color: #222;
        }

        .edu-item {
            margin-bottom: 10px;
            font-size: 11.5px;
        }

        a {
            color: #1a56db;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- HEADER --}}
        <div class="section">
            <h1 class="name">{{ $cv['name'] }}</h1>
            <p class="title">{{ $cv['title'] }}</p>
            <div class="contact">
                <div>{{ $cv['location'] ?? '' }}</div>
                <div>{{ $cv['email'] ?? '' }}</div>
            </div>
            @if (!empty($cv['social']) && is_array($cv['social']))
                <div class="contact" style="margin-top:6px;">
                    @foreach ($cv['social'] as $platform => $url)
                        <a href="{{ $url }}" style="margin-right:8px; text-decoration:none; color:#333;">
                            {{ $platform }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- SUMMARY --}}
        <div class="section">
            <div class="section-title">Summary</div>
            <div class="prose">
                {!! $cv['summary_html'] ?? '' !!}
            </div>
        </div>

        {{-- SKILLS --}}
        <div class="section">
            <div class="section-title">Skills</div>
            <ul class="skills">
                @foreach ($cv['top_skills'] as $skill)
                    <li>{{ $skill }}</li>
                @endforeach
            </ul>
        </div>

        {{-- EXPERIENCE --}}
        <div class="section">
            <div class="section-title">Experience</div>
            @foreach ($cv['experience'] as $exp)
                <div class="exp">
                    <p class="role">
                        {{ $exp['role'] ?? '' }} — {{ $exp['company'] ?? '' }}
                    </p>
                    <p class="meta">
                        {{ $exp['start'] ?? '' }} – {{ $exp['end'] ?? '' }}
                    </p>
                    <div class="desc">
                        {!! $exp['description_html'] ?? '' !!}
                    </div>
                </div>
            @endforeach
        </div>

        {{-- EDUCATION --}}
        <div class="section">
            <div class="section-title">Education</div>
            @foreach ($cv['education'] as $edu)
                <div class="edu-item">
                    <div style="font-weight:600;">{{ $edu['degree'] ?? '' }}</div>
                    <div>{{ $edu['school'] ?? '' }}</div>
                    <div>{{ $edu['location'] ?? '' }}</div>
                    <div style="font-size:11px;color:#555;">
                        {{ $edu['start'] ?? '' }} – {{ $edu['end'] ?? '' }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
