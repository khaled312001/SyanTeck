<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('Warranty Certificate')}} - {{ $order->warranty_code }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', 'Tahoma', sans-serif;
            direction: rtl;
            font-size: 14px;
            color: #333;
            background: #fff;
        }
        .warranty-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            border: 3px solid #667eea;
            border-radius: 10px;
        }
        .warranty-header {
            text-align: center;
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .warranty-header h1 {
            color: #667eea;
            font-size: 36px;
            margin-bottom: 10px;
        }
        .warranty-header .warranty-code {
            font-size: 20px;
            color: #666;
            background: #f8f9fa;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
        .certificate-badge {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border-radius: 10px;
        }
        .certificate-badge h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        .info-section {
            margin: 30px 0;
        }
        .info-section h3 {
            color: #667eea;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 5px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        .info-box {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .info-box p {
            margin: 8px 0;
            color: #555;
        }
        .warranty-details {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
        }
        .warranty-details h3 {
            color: #856404;
            margin-bottom: 15px;
        }
        .warranty-details ul {
            list-style: none;
            padding: 0;
        }
        .warranty-details li {
            padding: 8px 0;
            border-bottom: 1px solid #ffeaa7;
        }
        .warranty-details li:last-child {
            border-bottom: none;
        }
        .warranty-details li strong {
            color: #856404;
        }
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            padding-top: 30px;
            border-top: 2px solid #ddd;
        }
        .signature-box {
            text-align: center;
            width: 45%;
        }
        .signature-box p {
            margin-top: 50px;
            border-top: 1px solid #333;
            padding-top: 10px;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        .validity-period {
            background: #d4edda;
            border: 2px solid #28a745;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .validity-period h3 {
            color: #155724;
            margin-bottom: 10px;
        }
        .validity-period p {
            font-size: 18px;
            color: #155724;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="warranty-container">
        <div class="warranty-header">
            <h1>{{__('Warranty Certificate')}}</h1>
            <div class="warranty-code">
                <strong>{{__('Warranty Code')}}:</strong> {{ $order->warranty_code }}
            </div>
        </div>

        <div class="certificate-badge">
            <h2>{{__('Certificate of Warranty')}}</h2>
            <p style="font-size: 16px;">{{ get_static_option('site_title') ?? 'شركة الصيانة' }}</p>
        </div>

        <div class="info-section">
            <h3>{{__('Service Information')}}</h3>
            <div class="info-grid">
                <div class="info-box">
                    <p><strong>{{__('Service')}}:</strong> {{ $order->service->title ?? 'N/A' }}</p>
                    <p><strong>{{__('Order ID')}}:</strong> #{{ $order->id }}</p>
                    <p><strong>{{__('Tracking Code')}}:</strong> {{ $order->tracking_code ?? 'N/A' }}</p>
                </div>
                <div class="info-box">
                    <p><strong>{{__('Completed Date')}}:</strong> {{ $order->completed_at ? $order->completed_at->format('Y-m-d') : 'N/A' }}</p>
                    <p><strong>{{__('Issued Date')}}:</strong> {{ $order->warranty_issued_at ? $order->warranty_issued_at->format('Y-m-d') : Carbon\Carbon::now()->format('Y-m-d') }}</p>
                    @if($order->technician)
                    <p><strong>{{__('Technician')}}:</strong> {{ $order->technician->name }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="info-section">
            <h3>{{__('Client Information')}}</h3>
            <div class="info-box">
                <p><strong>{{__('Name')}}:</strong> {{ $order->name }}</p>
                <p><strong>{{__('Phone')}}:</strong> {{ $order->phone }}</p>
                <p><strong>{{__('Email')}}:</strong> {{ $order->email }}</p>
                <p><strong>{{__('Address')}}:</strong> {{ $order->address }}</p>
            </div>
        </div>

        <div class="validity-period">
            <h3>{{__('Warranty Validity Period')}}</h3>
            <p>{{ $order->warranty_days ?? 30 }} {{__('Days')}}</p>
            @if($order->completed_at)
            <p style="margin-top: 10px; font-size: 14px;">
                {{__('Valid From')}}: {{ $order->completed_at->format('Y-m-d') }}<br>
                {{__('Valid Until')}}: {{ $order->completed_at->addDays($order->warranty_days ?? 30)->format('Y-m-d') }}
            </p>
            @endif
        </div>

        <div class="warranty-details">
            <h3>{{__('Warranty Terms and Conditions')}}</h3>
            <ul>
                <li><strong>{{__('Coverage')}}:</strong> {{__('This warranty covers defects in workmanship and materials used in the service provided.')}}</li>
                <li><strong>{{__('Duration')}}:</strong> {{__('The warranty is valid for')}} {{ $order->warranty_days ?? 30 }} {{__('days from the completion date.')}}</li>
                <li><strong>{{__('Scope')}}:</strong> {{__('The warranty covers the same issue that was repaired. Any new issues or damages caused by misuse are not covered.')}}</li>
                <li><strong>{{__('Claim Process')}}:</strong> {{__('To claim warranty service, please contact us with the warranty code and order details.')}}</li>
                <li><strong>{{__('Exclusions')}}:</strong> {{__('Warranty does not cover damages caused by accidents, misuse, or natural disasters.')}}</li>
            </ul>
        </div>

        @if($order->order_note)
        <div style="margin-top: 30px; padding: 15px; background: #f8f9fa; border-radius: 8px;">
            <h3 style="color: #667eea; margin-bottom: 10px;">{{__('Service Notes')}}:</h3>
            <p>{{ $order->order_note }}</p>
        </div>
        @endif

        <div class="signature-section">
            <div class="signature-box">
                <p><strong>{{__('Client Signature')}}</strong></p>
            </div>
            <div class="signature-box">
                <p><strong>{{__('Company Seal')}}</strong></p>
            </div>
        </div>

        <div class="footer">
            <p><strong>{{ get_static_option('site_title') ?? 'شركة الصيانة' }}</strong></p>
            <p>{{__('This is an official warranty certificate. Please keep it safe.')}}</p>
            <p>{{ get_static_option('site_footer_copyright') ?? '© ' . date('Y') . ' All Rights Reserved' }}</p>
        </div>
    </div>
</body>
</html>

