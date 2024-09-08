<tr>
    <td>
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="content-cell" align="center">
                    {{-- Social Media Icons --}}
                    <p class="text-gray-600 dark:text-white/70">
                        Follow us on:
                    </p>
                    <div style="margin: 10px 0;">
                        <a href="#" style="text-decoration: none; margin-right: 10px;">
                            <img src="https://cdn.pixabay.com/photo/2021/08/10/17/03/facebook-6536473_1280.png" alt="Facebook" width="24" height="24">
                        </a>
                        <a href="#" style="text-decoration: none; margin-right: 10px;">
                            <img src="https://clipartcraft.com/images/instagram-logo-transparent-background-2.png" alt="Instagram" width="24" height="24">
                        </a>
                    </div>

                    {{-- Footer Text --}}
                    {{ Illuminate\Mail\Markdown::parse($slot) }}

                    {{-- Website Link --}}
                    <p style="margin-top: 20px;">
                        <a href="{{ config('app.url') }}" class="text-yellow-500 hover:text-yellow-600" style="text-decoration: none; color: #F59E0B;">
                            Visit our website: {{ config('app.url') }}
                        </a>
                    </p>
                    
                    {{-- Copyright Notice --}}
                    <p style="font-size: 14px; color: #888; margin-top: 10px;">
                        © {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>
