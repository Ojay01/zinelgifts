<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ZINEL GIFTS Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.42.0/apexcharts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/lucide.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-slate-900 text-white">
    <div x-data="{ 
        sidebarOpen: window.innerWidth >= 768,
        mobileMenuOpen: false,
        userMenuOpen: false,
        darkMode: true,
        isMobile: window.innerWidth < 768,
        initApp() {
            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth < 768;
                if (!this.isMobile) {
                    this.mobileMenuOpen = false;
                }
                this.sidebarOpen = window.innerWidth >= 768;
            });
            
            document.addEventListener('click', (e) => {
                if (this.mobileMenuOpen && !e.target.closest('aside') && !e.target.closest('[data-menu-toggle]')) {
                    this.mobileMenuOpen = false;
                }
            });
        }
    }" x-init="initApp(); $watch('darkMode', value => document.documentElement.classList.toggle('dark', value))" 
    class="min-h-screen flex">
        <!-- Backdrop for mobile menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
             @click="mobileMenuOpen = false">
        </div>
        <!-- Sidebar -->
        <x-admin.header />

        <!-- Enhanced Sidebar -->
        <x-admin.sidebar /> 


        <div class="flex-1 flex flex-col min-h-screen">

            <main class="p-4 sm:p-6 md:p-8">
                <div class="pt-16 mx-auto">

    <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
        {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Initialize Icons -->
   <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Revenue Chart
        const revenueOptions = {
            chart: {
                type: 'area',
                height: 320,
                toolbar: { show: false },
                background: 'transparent'
            },
            series: [{
                name: 'Revenue',
                data: [31, 40, 28, 51, 42, 109, 100]
            }],
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                labels: {
                    style: { colors: '#94a3b8' }
                }
            },
            yaxis: {
                labels: {
                    style: { colors: '#94a3b8' }
                }
            },
            stroke: {
                curve: 'smooth'
            },
            colors: ['#3b82f6'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.2,
                    stops: [0, 90, 100]
                }
            }
        };
        const revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
        revenueChart.render();

        // User Activity Chart
        const userActivityOptions = {
            chart: {
                type: 'bar',
                height: 320,
                toolbar: { show: false },
                background: 'transparent'
            },
            series: [{
                name: 'Active Users',
                data: [44, 55, 57, 56, 61, 58, 63]
            }],
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                labels: {
                    style: { colors: '#94a3b8' }
                }
            },
            yaxis: {
                labels: {
                    style: { colors: '#94a3b8' }
                }
            },
            colors: ['#3b82f6'],
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    columnWidth: '60%',
                }
            }
        };
        const userActivityChart = new ApexCharts(document.querySelector("#userActivityChart"), userActivityOptions);
        userActivityChart.render();
    });
</script>
<script>
    // Check for success or error messages from server
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            createToast('{{ session('success') }}', 'success');
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                createToast('{{ $error }}', 'error');
            @endforeach
        @endif
    });

    // Image preview function
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('image-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('hidden');
        }
    }

    // Toaster notification function
    function createToast(message, type = 'info') {
        const toaster = document.getElementById('toaster');
        
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `
            p-4 rounded-lg shadow-lg transform transition-all duration-300 ease-in-out 
            ${type === 'success' ? 'bg-green-600' : 'bg-red-600'} 
            text-white flex items-center justify-between
        `;
        
        // Toast content
        toast.innerHTML = `
            <span class="mr-4">${message}</span>
            <button onclick="this.parentElement.remove()" class="ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;

        // Add to toaster
        toaster.appendChild(toast);

        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }
</script>
</body>
</html>
