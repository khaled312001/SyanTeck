<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('Invoice')}} - {{ $order->invoice_number }}</title>
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
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
        }
        .invoice-header {
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .invoice-header h1 {
            color: #667eea;
            font-size: 32px;
            margin-bottom: 10px;
        }
        .invoice-header .invoice-number {
            font-size: 18px;
            color: #666;
        }
        .company-info {
            margin-bottom: 30px;
        }
        .company-info h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .info-box {
            flex: 1;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            margin: 0 10px;
        }
        .info-box h3 {
            color: #667eea;
            font-size: 16px;
            margin-bottom: 10px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 5px;
        }
        .info-box p {
            margin: 5px 0;
            color: #555;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }
        .invoice-table th,
        .invoice-table td {
            padding: 12px;
            text-align: right;
            border: 1px solid #ddd;
        }
        .invoice-table th {
            background: #667eea;
            color: #fff;
            font-weight: bold;
        }
        .invoice-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-section {
            margin-top: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }
        .total-row:last-child {
            border-bottom: none;
            font-size: 18px;
            font-weight: bold;
            color: #667eea;
            margin-top: 10px;
            padding-top: 15px;
            border-top: 2px solid #667eea;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>{{__('Invoice')}}</h1>
            <div class="invoice-number">
                <strong>{{__('Invoice Number')}}:</strong> {{ $order->invoice_number ?? 'N/A' }}
            </div>
            <div style="margin-top: 10px;">
                <strong>{{__('Date')}}:</strong> {{ $order->invoice_date ? $order->invoice_date->format('Y-m-d') : Carbon\Carbon::now()->format('Y-m-d') }}
            </div>
        </div>

        <div class="company-info">
            <h2>{{ get_static_option('site_title') ?? 'شركة الصيانة' }}</h2>
        </div>

        <div class="info-row">
            <div class="info-box">
                <h3>{{__('Client Information')}}</h3>
                <p><strong>{{__('Name')}}:</strong> {{ $order->name }}</p>
                <p><strong>{{__('Phone')}}:</strong> {{ $order->phone }}</p>
                <p><strong>{{__('Email')}}:</strong> {{ $order->email }}</p>
                <p><strong>{{__('Address')}}:</strong> {{ $order->address }}</p>
                @if($order->region)
                <p><strong>{{__('Region')}}:</strong> {{ $order->region->name }}</p>
                @endif
            </div>

            <div class="info-box">
                <h3>{{__('Order Information')}}</h3>
                <p><strong>{{__('Order ID')}}:</strong> #{{ $order->id }}</p>
                <p><strong>{{__('Tracking Code')}}:</strong> {{ $order->tracking_code ?? 'N/A' }}</p>
                <p><strong>{{__('Service')}}:</strong> {{ $order->service->title ?? 'N/A' }}</p>
                @if($order->technician)
                <p><strong>{{__('Technician')}}:</strong> {{ $order->technician->name }}</p>
                @endif
                @if($order->completed_at)
                <p><strong>{{__('Completed Date')}}:</strong> {{ $order->completed_at->format('Y-m-d H:i') }}</p>
                @endif
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>{{__('Description')}}</th>
                    <th class="text-center">{{__('Quantity')}}</th>
                    <th class="text-left">{{__('Unit Price')}}</th>
                    <th class="text-left">{{__('Total')}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->service->title ?? __('Service') }}</td>
                    <td class="text-center">1</td>
                    <td class="text-left">{{ amount_with_currency_symbol($order->package_fee) }}</td>
                    <td class="text-left">{{ amount_with_currency_symbol($order->package_fee) }}</td>
                </tr>
                @if($order->extra_service > 0)
                <tr>
                    <td>{{__('Extra Services')}}</td>
                    <td class="text-center">1</td>
                    <td class="text-left">{{ amount_with_currency_symbol($order->extra_service) }}</td>
                    <td class="text-left">{{ amount_with_currency_symbol($order->extra_service) }}</td>
                </tr>
                @endif
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                <span><strong>{{__('Sub Total')}}:</strong></span>
                <span>{{ amount_with_currency_symbol($order->sub_total) }}</span>
            </div>
            @if($order->tax > 0)
            <div class="total-row">
                <span><strong>{{__('Tax')}} (15%):</strong></span>
                <span>{{ amount_with_currency_symbol($order->tax) }}</span>
            </div>
            @endif
            @if($order->coupon_amount > 0)
            <div class="total-row">
                <span><strong>{{__('Discount')}} ({{ $order->coupon_code }}):</strong></span>
                <span>-{{ amount_with_currency_symbol($order->coupon_amount) }}</span>
            </div>
            @endif
            <div class="total-row">
                <span><strong>{{__('Total Amount')}}:</strong></span>
                <span>{{ amount_with_currency_symbol($order->total) }}</span>
            </div>
        </div>

        @if($order->order_note)
        <div style="margin-top: 30px; padding: 15px; background: #f8f9fa; border-radius: 8px;">
            <h3 style="color: #667eea; margin-bottom: 10px;">{{__('Notes')}}:</h3>
            <p>{{ $order->order_note }}</p>
        </div>
        @endif

        <div class="footer">
            <p>{{__('Thank you for your business!')}}</p>
            <p>{{ get_static_option('site_footer_copyright') ?? '© ' . date('Y') . ' All Rights Reserved' }}</p>
        </div>
    </div>
</body>
</html>

