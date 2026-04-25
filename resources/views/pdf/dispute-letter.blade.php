<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dispute Letter - #{{ $analysis->bill_id }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.6; padding: 40px; }
        .date { margin-bottom: 30px; }
        .address { margin-bottom: 30px; }
        .subject { font-weight: bold; text-decoration: underline; margin-bottom: 30px; }
        .body { margin-bottom: 40px; white-space: pre-wrap; }
        .signature { margin-top: 50px; }
    </style>
</head>
<body>
    <div class="date">{{ now()->format('F d, Y') }}</div>

    <div class="address">
        To,<br>
        Billing Department,<br>
        [Utility Provider Name]<br>
        [Utility Provider Address]
    </div>

    <div class="subject">
        Subject: Formal Dispute of Charges for Account [Account Number] - Bill Date [Bill Date]
    </div>

    <div class="body">
        {!! $analysis->dispute_letter !!}
    </div>

    <div class="signature">
        Sincerely,<br><br><br>
        _______________________<br>
        {{ $bill->user->name }}
    </div>
</body>
</html>
