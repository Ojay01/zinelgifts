<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background-color: #4a90e2;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .order-details {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table thead {
            background-color: #f2f2f2;
        }
        .totals {
            text-align: right;
            font-weight: bold;
        }
        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Order Confirmation</h1>
        </div>
        
        <div class="content">
            <p>Thank you for your purchase!</p>
            
            <div class="order-details">
                <h2>Order Details</h2>
                <p>Order Number: {{ $order->order_number }}</p>
                <p>Date: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
            </div>

            <h3>Items</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price * $item->quantity }} CFA</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="totals">
                <p>Subtotal: {{ $subtotal }} CFA</p>
                <p>Shipping: {{ $shipping }} CFA</p>
                <p>Total: {{ $total }} CFA</p>
            </div>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Zinelgifts. All rights reserved.</p>
            <p>Contact us: support@zinelgifts.com </p>
        </div>
    </div>
</body>
</html>