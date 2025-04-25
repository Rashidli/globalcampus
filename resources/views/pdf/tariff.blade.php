<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tariflər PDF</title>
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

<h2>Universitet Tarifləri</h2>

<table>
    <thead>
    <tr>
        <th>University</th>
        <th>School Type</th>
        <th>Education Level</th>
        <th>Language</th>
        <th>Profession</th>
        <th>Town</th>
        <th>Country</th>
        <th>Price</th>
        <th>Currency</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tariffs as $tariff)
        <tr>
            <td>{{ $tariff->university_list->title ?? 'N/A' }}</td>
            <td>{{ $tariff->school_type->title ?? 'N/A' }}</td>
            <td>{{ $tariff->education_level->title ?? 'N/A' }}</td>
            <td>{{ $tariff->education_language->title ?? 'N/A' }}</td>
            <td>{{ $tariff->profession->title ?? 'N/A' }}</td>
            <td>{{ $tariff->town->title ?? 'N/A' }}</td>
            <td>{{ $tariff->country->title ?? 'N/A' }}</td>
            <td>{{ $tariff->price ?? 'N/A' }}</td>
            <td>{{ $tariff->currency->title ?? 'N/A' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
