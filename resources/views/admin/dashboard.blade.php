<x-admin-layout>

  
                    <!-- Stats Cards -->
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
    <div class="bg-slate-800 rounded-lg p-5 border border-slate-700 hover:shadow-lg transition-all duration-300">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-base font-semibold text-slate-200">Total Users</h3>
            <span class="text-blue-400 flex items-center gap-1 text-xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                {{ number_format(($newUsersToday / max($totalUsers, 1)) * 100, 1) }}%
            </span>
        </div>
        <div class="flex justify-between items-end">
            <p class="text-3xl font-bold text-white">{{ number_format($totalUsers) }}</p>
            <p class="text-xs text-slate-400">+{{ number_format($newUsersToday) }} today</p>
        </div>
    </div>

    <div class="bg-slate-800 rounded-lg p-5 border border-slate-700 hover:shadow-lg transition-all duration-300">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-base font-semibold text-slate-200">Verified Users</h3>
            <span class="text-green-400 flex items-center gap-1 text-xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ number_format(($activeUsers / max($totalUsers, 1)) * 100, 1) }}%
            </span>
        </div>
        <div class="flex justify-between items-end">
            <p class="text-3xl font-bold text-white">{{ number_format($activeUsers) }}</p>
            <p class="text-xs text-slate-400">of {{ number_format($totalUsers) }} users</p>
        </div>
    </div>

    <div class="bg-slate-800 rounded-lg p-5 border border-slate-700 hover:shadow-lg transition-all duration-300">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-base font-semibold text-slate-200">User Growth</h3>
            <span class="text-purple-400 flex items-center gap-1 text-xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                {{ number_format(($activeUsers / max($totalUsers, 1)) * 100, 1) }}%
            </span>
        </div>
        <div class="flex justify-between items-end">
            <p class="text-3xl font-bold text-white">{{ number_format($totalUsers - $activeUsers) }}</p>
            <p class="text-xs text-slate-400">Unverified</p>
        </div>
    </div>
</div>
                    <!-- Chart Section -->
                    <div class="mt-4 sm:mt-6 grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                        <div class="bg-slate-800 rounded-lg p-4 sm:p-6 border border-slate-700">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-base sm:text-lg font-semibold">User Growth Overview</h3>
                                <select id="userGrowthTimeframe" class="bg-slate-700 border-none rounded-lg text-xs sm:text-sm px-2 py-1 sm:px-3 sm:py-2">
                                    <option value="entireYear">Entire Year</option>
                                    <option value="last12Months">Last 12 Months</option>
                                    <option value="thisMonth">This Month</option>
                                    <option value="byQuarter">By Quarter</option>
                                </select>
                            </div>
                            <div class="h-48 sm:h-80" id="userGrowthChart"></div>
                        </div>
                    
                        <div class="bg-slate-800 rounded-lg p-4 sm:p-6 border border-slate-700">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-base sm:text-lg font-semibold">User Verification Trend</h3>
                                <select id="verificationTimeframe" class="bg-slate-700 border-none rounded-lg text-xs sm:text-sm px-2 py-1 sm:px-3 sm:py-2">
                                    <option value="entireYear">Entire Year</option>
                                    <option value="last12Months">Last 12 Months</option>
                                    <option value="thisMonth">This Month</option>
                                    <option value="byQuarter">By Quarter</option>
                                </select>
                            </div>
                            <div class="h-48 sm:h-80" id="verificationTrendChart"></div>
                        </div>
                    </div>
                    
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let userGrowthChart, verificationTrendChart;
                        const fullYearData = @json($userGrowthData);
                    
                        function renderUserGrowthChart(data) {
                            if (userGrowthChart) userGrowthChart.destroy();
                            
                            userGrowthChart = new ApexCharts(document.getElementById('userGrowthChart'), {
                                series: [{
                                    name: 'Total Users',
                                    data: data.totalUsers
                                }, {
                                    name: 'Verified Users',
                                    data: data.verifiedUsers
                                }],
                                chart: {
                                    type: 'area',
                                    height: '100%',
                                    toolbar: { show: false }
                                },
                                colors: ['#3B82F6', '#10B981'],
                                fill: {
                                    type: 'gradient',
                                    gradient: {
                                        shadeIntensity: 0.5,
                                        opacityFrom: 0.7,
                                        opacityTo: 0.3,
                                    }
                                },
                                xaxis: {
                                    categories: data.months,
                                    labels: { style: { colors: '#CBD5E1' } }
                                },
                                yaxis: {
                                    labels: { style: { colors: '#CBD5E1' } }
                                },
                                tooltip: {
                                    theme: 'dark'
                                }
                            });
                            userGrowthChart.render();
                        }
                    
                        function renderVerificationTrendChart(data) {
                            if (verificationTrendChart) verificationTrendChart.destroy();
                            
                            verificationTrendChart = new ApexCharts(document.getElementById('verificationTrendChart'), {
                                series: [{
                                    name: 'Verification Rate',
                                    data: data.rates
                                }],
                                chart: {
                                    type: 'line',
                                    height: '100%',
                                    toolbar: { show: false }
                                },
                                stroke: {
                                    curve: 'smooth',
                                    width: 3
                                },
                                colors: ['#8B5CF6'],
                                xaxis: {
                                    categories: data.months,
                                    labels: { style: { colors: '#CBD5E1' } }
                                },
                                yaxis: {
                                    labels: { 
                                        formatter: (value) => value + '%',
                                        style: { colors: '#CBD5E1' } 
                                    }
                                },
                                tooltip: {
                                    theme: 'dark',
                                    y: {
                                        formatter: (value) => value + '% verification rate'
                                    }
                                }
                            });
                            verificationTrendChart.render();
                        }
                    
                        // Initial render
                        renderUserGrowthChart(fullYearData);
                        renderVerificationTrendChart(@json($verificationTrendData));
                    
                        // Timeframe selection handlers
                        document.getElementById('userGrowthTimeframe').addEventListener('change', function(e) {
                            const timeframe = e.target.value;
                            let filteredData = filterData(fullYearData, timeframe);
                            renderUserGrowthChart(filteredData);
                        });
                        
                    
                        document.getElementById('verificationTimeframe').addEventListener('change', function(e) {
                            const timeframe = e.target.value;
                            let filteredData = filterData(@json($verificationTrendData), timeframe);
                            renderVerificationTrendChart(filteredData);
                        });
                    
                        function filterData(data, timeframe, monthLength = null) {
                            switch(timeframe) {
                                case 'last12Months':
                                    return {
                                        months: data.months.slice(-12),
                                        totalUsers: data.totalUsers ? data.totalUsers.slice(-12) : [],
                                        verifiedUsers: data.verifiedUsers ? data.verifiedUsers.slice(-12) : [],
                                        rates: data.rates ? data.rates.slice(-12) : []
                                    };
                                case 'thisMonth':
                                const today = new Date();
            const currentMonthIndex = today.getMonth();
            const daysInMonth = new Date(today.getFullYear(), currentMonthIndex + 1, 0).getDate();
            const startDay = Math.max(0, daysInMonth - 30);
            const endDay = daysInMonth;

            // Slice current month's data to last 30 days or all available days if less than 30
            return {
                months: [data.months[currentMonthIndex]],
                totalUsers: data.totalUsers ? [data.totalUsers[currentMonthIndex]] : [],
                verifiedUsers: data.verifiedUsers ? [data.verifiedUsers[currentMonthIndex]] : [],
                rates: data.rates ? [data.rates[currentMonthIndex]] : []
            };
                                case 'byQuarter':
                                    return {
                                        months: ['Q1', 'Q2', 'Q3', 'Q4'],
                                        totalUsers: quarterlyAggregate(data.totalUsers),
                                        verifiedUsers: quarterlyAggregate(data.verifiedUsers),
                                        rates: quarterlyAggregate(data.rates)
                                    };
                                default: // entireYear
                                    return data;
                            }
                        }
                    
                        function quarterlyAggregate(arr) {
                            if (!arr || arr.length === 0) return [];
                            return [
                                Math.round((arr[0] + arr[1] + arr[2]) / 3),
                                Math.round((arr[3] + arr[4] + arr[5]) / 3),
                                Math.round((arr[6] + arr[7] + arr[8]) / 3),
                                Math.round((arr[9] + arr[10] + arr[11]) / 3)
                            ];
                        }
                    });
                    </script>
        
                    <!-- Recent Activity Table -->
                    <div class="mt-4 sm:mt-6">
                        <div class="bg-slate-800 rounded-lg border border-slate-700">
                            <div class="p-4 sm:p-6">
                                <h3 class="text-base sm:text-lg font-semibold">Recent Activity</h3>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-t border-slate-700 bg-slate-800/50">
                                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">User</th>
                                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden sm:table-cell">Action</th>
                                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden md:table-cell">Status</th>
                                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-700">
                                        <tr class="hover:bg-slate-700/50 transition-colors">
                                            <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-6 w-6 sm:h-8 sm:w-8 rounded-full bg-blue-500/10 flex items-center justify-center">
                                                        <span class="text-xs sm:text-sm text-blue-400">AS</span>
                                                    </div>
                                                    <div class="ml-2 sm:ml-3">
                                                        <p class="text-xs sm:text-sm font-medium">Alice Smith</p>
                                                        <p class="text-[10px] sm:text-xs text-slate-400 hidden sm:block">alice.s@example.com</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap text-xs sm:text-sm hidden sm:table-cell">Updated profile settings</td>
                                            <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap hidden md:table-cell">
                                                <span class="px-1 sm:px-2 py-0.5 sm:py-1 text-[10px] sm:text-xs rounded-full bg-green-500/10 text-green-400">Completed</span>
                                            </td>
                                            <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-slate-400">5 mins ago</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

   
    </x-admin-layout>