<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bill Audit Report - #{{ $analysis->bill_id }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 50px; border-bottom: 2px solid #7C5C3E; padding-bottom: 20px; }
        .logo { color: #7C5C3E; font-size: 28px; font-weight: bold; }
        .section { margin-bottom: 30px; }
        .section-title { font-size: 20px; font-weight: bold; color: #7C5C3E; margin-bottom: 15px; border-bottom: 1px solid #eee; }
        .error-item { background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 10px; border-left: 4px solid #E8A87C; }
        .error-title { font-weight: bold; margin-bottom: 5px; }
        .summary { font-size: 18px; font-weight: bold; margin-top: 20px; }
        .total-savings { color: #27ae60; font-size: 24px; }
        .footer { font-size: 12px; color: #999; margin-top: 50px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">FixMyUtility</div>
        <div>Utility Bill Audit Report</div>
        <div style="font-size: 14px; color: #666;">Date: {{ now()->format('M d, Y') }} | ID: #{{ $analysis->bill_id }}</div>
    </div>

    <div class="section">
        <div class="section-title">Bill Information</div>
        <table width="100%">
            <tr>
                <td><strong>Utility Type:</strong> {{ ucfirst($bill->utility_type) }}</td>
                <td><strong>Currency:</strong> {{ $bill->currency }}</td>
            </tr>
            <tr>
                <td><strong>Customer:</strong> {{ $bill->user->name }}</td>
                <td><strong>Status:</strong> Analyzed</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Findings & Errors</div>
        @php $aiResponse = $analysis->ai_response; @endphp
        @forelse($aiResponse['errors'] ?? [] as $error)
            <div class="error-item">
                <div class="error-title">{{ $error['type'] }}</div>
                <div>{{ $error['description'] }}</div>
                <div style="margin-top: 5px; font-weight: bold;">Potential Overcharge: {{ $bill->currency }} {{ number_format($error['amount'], 2) }}</div>
            </div>
        @empty
            <p>No specific errors found in this audit.</p>
        @endforelse
    </div>

    <div class="section">
        <div class="section-title">Audit Summary</div>
        <p>{{ $aiResponse['summary'] ?? 'Audit completed successfully.' }}</p>
        <div class="summary">
            Total Estimated Savings: <span class="total-savings">{{ $bill->currency }} {{ number_format($analysis->overcharge_amount, 2) }}</span>
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} FixMyUtility - Saving you money on every bill.
    </div>
</body>
</html>
