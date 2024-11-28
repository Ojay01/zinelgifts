<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Order Confirmation - Zinelgifts</title>
    <style type="text/css">
        /* Reset styles */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; }

        /* Responsive styles */
        img { max-width: 100%; height: auto; }
        
        /* Specific email client fixes */
        @media screen and (max-width: 600px) {
            .email-container { width: 100% !important; }
            .mobile-center { text-align: center !important; }
            .mobile-full-width { width: 100% !important; }
            .content { padding: 20px !important; }
            .order-details { 
                flex-direction: column !important; 
                text-align: center !important; 
            }
            .order-details > div { margin-bottom: 10px !important; }
            table { width: 100% !important; }
        }

        /* Fallback font stack */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" class="email-container" style="border-collapse: collapse; box-shadow: 0 4px 6px rgba(0,0,0,0.1); background-color: white;">
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #c19d56; color: white; text-align: center; padding: 30px;">
                            <img src="https://zinelgifts.com/logo/logowhite.png" alt="Zinelgifts Logo" style="max-width: 250px; max-height: 80px;">
                            <h1 style="margin-top: 15px; font-size: 24px; color: white;">Order Confirmation</h1>
                        </td>
                    </tr>
                    
                    <!-- Order Details -->
                    <tr>
                        <td class="content" style="padding: 30px;">
                            <table class="order-details" role="presentation" width="100%" style="margin-bottom: 20px;">
                                <tr>
                                    <td class="mobile-center" style="text-align: left; width: 50%;">
                                        <strong>Order Number:</strong>
                                        <p style="margin: 5px 0;">{{ $order->order_number }}</p>
                                    </td>
                                    <td class="mobile-center" style="text-align: right; width: 50%;">
                                        <strong>Order Date:</strong>
                                        <p style="margin: 5px 0;">{{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Shipping Note -->
                            <div style="background-color: #fffbea; border-left: 5px solid #ffd700; padding: 15px; margin-bottom: 20px;">
                                <p>Your gift is being carefully crafted with love! We're meticulously preparing your order 
                                to ensure it arrives as a perfect surprise. Patience brings joy – your package is 
                                on its magical journey to you!</p>
                            </div>

                            <!-- Items Table -->
                            <table role="presentation" width="100%" style="border-collapse: collapse; margin-bottom: 20px;">
                                <thead>
                                    <tr style="background-color: #f8f9fa;">
                                        <th style="padding: 10px; text-align: left; border: 1px solid #e9ecef;">Product</th>
                                        <th style="padding: 10px; text-align: left; border: 1px solid #e9ecef;">Quantity</th>
                                        <th style="padding: 10px; text-align: left; border: 1px solid #e9ecef;">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #e9ecef;">{{ $item->product->name }}</td>
                                        <td style="padding: 10px; border: 1px solid #e9ecef;">{{ $item->quantity }}</td>
                                        <td style="padding: 10px; border: 1px solid #e9ecef;">{{ $item->product->price * $item->quantity }} CFA</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Totals -->
                            <div style="text-align: right; padding-top: 20px; border-top: 2px solid #c19d56;">
                                <p style="margin: 5px 0;">Subtotal: {{ $subtotal }} CFA</p>
                                <p style="margin: 5px 0;">Shipping: {{ $shipping }} CFA</p>
                                <p style="margin: 5px 0; color: #c19d56; font-size: 1.2em; font-weight: bold;">Total: {{ $total }} CFA</p>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 20px; text-align: center;">
                            <div style="margin-bottom: 20px;">
                                <a href="https://facebook.com/zinelgifts" style="display: inline-block; margin: 0 10px;">
                                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/facebook.svg" alt="Facebook" width="30" height="30">
                                </a>
                                <a href="https://instagram.com/zinelgifts" style="display: inline-block; margin: 0 10px;">
                                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/instagram.svg" alt="Instagram" width="30" height="30">
                                </a>
                                <a href="https://x.com/zinelgifts" style="display: inline-block; margin: 0 10px;">
                                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/x.svg" alt="X (Twitter)" width="30" height="30">
                                </a>
                            </div>
                            <p style="margin: 10px 0; color: #6c757d;">&copy; {{ date('Y') }} Zinelgifts. All rights reserved.</p>
                            <p style="margin: 10px 0;">
                                <a href="mailto:support@zinelgifts.com" style="color: #c19d56; text-decoration: none;">support@zinelgifts.com</a> | 
                                <a href="tel:+237653840833" style="color: #c19d56; text-decoration: none;">+237 653 840 833</a>
                            </p>
                            <p style="margin: 10px 0;">
                                <a href="#" style="color: #c19d56; text-decoration: none; margin: 0 10px;">Shipping & Returns</a>
                                <a href="#" style="color: #c19d56; text-decoration: none; margin: 0 10px;">Privacy Policy</a>
                                <a href="#" style="color: #c19d56; text-decoration: none; margin: 0 10px;">Terms of Service</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>