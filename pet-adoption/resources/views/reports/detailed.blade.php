<!DOCTYPE html>
<html>
<head>
    <title>Detailed Pets Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .period { color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Detailed Pets Report</h1>
        <div class="period">Period: {{ $start_date }} to {{ $end_date }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Breed</th>
                <th>Status</th>
                <th>Date Added</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $pet)
            <tr>
                <td>{{ $pet->id }}</td>
                <td>{{ $pet->name }}</td>
                <td>{{ $pet->type->name }}</td>
                <td>{{ $pet->breed }}</td>
                <td>{{ ucfirst($pet->status) }}</td>
                <td>{{ $pet->created_at->format('M j, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: center; font-size: 12px; color: #94a3b8;">
        Report generated on {{ $generated_at }}
    </div>
</body>
</html>