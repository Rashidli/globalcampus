<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Başvurular PDF</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 150px;
            height: auto;
        }
        .company-info {
            text-align: left;
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .profile-img img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="logo">
        <img src="{{ public_path('files/' . auth()->user()->image) }}" alt="Company Logo">
    </div>
</div>

<div class="company-info">
    <div>{{ auth()->user()->agent_info?->company_name }}</div>
    <div>{{ auth()->user()->phone }}</div>
</div>

<h2>Başvurular</h2>

<table>
    <thead>
    <tr>
{{--        <th>Foto</th>--}}
        <th>Ad Soyad</th>
        <th>Başvuru İxtisası</th>
        <th>Universitet</th>
        <th>Proqram</th>
        <th>Dönəm</th>
        <th>Agent</th>
        <th>Status</th>
        <th>Passport No</th>
{{--        <th>App No</th>--}}
        <th>Başvuru Tarixi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($applications as $key => $application)
        <tr>
{{--            <td class="profile-img">--}}
{{--                @if($application->user?->image)--}}
{{--                    <img src="{{ public_path('files/' . $application->user?->image) }}" alt="Profile">--}}
{{--                @endif--}}
{{--            </td>--}}
            <td>{{ $application->user?->name }} <br> {{ $application->user?->surname }}</td>
            <td>{{ $application->tariff?->profession->title ?? 'N/A' }}</td>
            <td>{{ $application->university_list?->title ?? 'N/A' }}</td>
            <td>{{ $application->education_level?->title ?? 'N/A' }}</td>
            <td>{{ $application->period?->title ?? 'N/A' }}</td>
            <td>{{ $application->user?->agent?->agent_info?->company_name ?? 'N/A' }}</td>
            <td>{{ $application->program_status?->title ?? 'N/A' }}</td>
            <td>{{ $application->user?->student_info?->passport_number ?? 'N/A' }}</td>
{{--            <td>{{ $application->app_no ?? 'N/A' }}</td>--}}
            <td>{{ $application->application_date ?? 'N/A' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
