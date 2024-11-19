<x-admin-layout>

  
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                        <div class="bg-slate-800 rounded-lg p-4 sm:p-6 border border-slate-700">
                            <div class="flex items-center justify-between">
                                <h3 class="text-base sm:text-lg font-semibold">Total Revenue</h3>
                                <span class="text-green-400 flex items-center gap-1 text-xs sm:text-sm">
                                    <svg class="h-3 w-3 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    12.5%
                                </span>
                            </div>
                            <p class="text-2xl sm:text-3xl font-bold mt-2 sm:mt-4">$124,563.00</p>
                            <p class="text-slate-400 text-xs sm:text-sm mt-1 sm:mt-2">Compared to $110,742.00 last month</p>
                        </div>
        
                        <div class="bg-slate-800 rounded-lg p-4 sm:p-6 border border-slate-700">
                            <div class="flex items-center justify-between">
                                <h3 class="text-base sm:text-lg font-semibold">Active Users</h3>
                                <span class="text-blue-400 flex items-center gap-1 text-xs sm:text-sm">
                                    <svg class="h-3 w-3 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                    </svg>
                                    8.2%
                                </span>
                            </div>
                            <p class="text-2xl sm:text-3xl font-bold mt-2 sm:mt-4">2,453</p>
                            <p class="text-slate-400 text-xs sm:text-sm mt-1 sm:mt-2">Compared to 2,267 last month</p>
                        </div>
        
                        <div class="bg-slate-800 rounded-lg p-4 sm:p-6 border border-slate-700">
                            <div class="flex items-center justify-between">
                                <h3 class="text-base sm:text-lg font-semibold">Conversion Rate</h3>
                                <span class="text-red-400 flex items-center gap-1 text-xs sm:text-sm">
                                    <svg class="h-3 w-3 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7"></path>
                                    </svg>
                                    3.1%
                                </span>
                            </div>
                            <p class="text-2xl sm:text-3xl font-bold mt-2 sm:mt-4">4.2%</p>
                            <p class="text-slate-400 text-xs sm:text-sm mt-1 sm:mt-2">Compared to 4.6% last month</p>
                        </div>
                    </div>
        
                    <!-- Chart Section -->
                    <div class="mt-4 sm:mt-6 grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                        <div class="bg-slate-800 rounded-lg p-4 sm:p-6 border border-slate-700">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-base sm:text-lg font-semibold">Revenue Overview</h3>
                                <select class="bg-slate-700 border-none rounded-lg text-xs sm:text-sm px-2 py-1 sm:px-3 sm:py-2">
                                    <option>Last 7 Days</option>
                                    <option>Last 30 Days</option>
                                    <option>Last 90 Days</option>
                                </select>
                            </div>
                            <div class="h-48 sm:h-80" id="revenueChart"></div>
                        </div>
        
                        <div class="bg-slate-800 rounded-lg p-4 sm:p-6 border border-slate-700">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-base sm:text-lg font-semibold">User Activity</h3>
                                <select class="bg-slate-700 border-none rounded-lg text-xs sm:text-sm px-2 py-1 sm:px-3 sm:py-2">
                                    <option>By Day</option>
                                    <option>By Week</option>
                                    <option>By Month</option>
                                </select>
                            </div>
                            <div class="h-48 sm:h-80" id="userActivityChart"></div>
                        </div>
                    </div>
        
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