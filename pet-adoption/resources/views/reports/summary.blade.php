<!DOCTYPE html>
<html>
<head>
    <title>Pet Adoption Summary Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { height: 60px; margin-bottom: 10px; }
        .period { color: #666; margin-bottom: 20px; }
        .stats { display: flex; justify-content: space-around; margin: 30px 0; }
        .stat-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; text-align: center; width: 22%; }
        .stat-value { font-size: 24px; font-weight: bold; color: #3b82f6; margin: 10px 0; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pet Adoption Summary Report</h1>
        <div class="period">Period: {{ $start_date }} to {{ $end_date }}</div>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div>Total Pets</div>
            <div class="stat-value">{{ $total_pets }}</div>
        </div>
        <div class="stat-card">
            <div>Adopted Pets</div>
            <div class="stat-value">{{ $adopted_pets }}</div>
        </div>
        <div class="stat-card">
            <div>New Users</div>
            <div class="stat-value">{{ $new_users }}</div>
        </div>
    </div>

    <div class="footer">
        Report generated on {{ $generated_at }}
    </div>
</body>
</html>