<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="flex flex-col bg-gray-50 min-h-screen">
        <!-- Main Content Area -->
        <div class="flex flex-1 overflow-hidden">
            <!-- Fixed Sidebar -->
            <div class="fixed top-0 left-0 h-full z-40 md:z-auto">
                @include('admin.sidebar')
            </div>

            <!-- Main Content -->
            <div id="main-content" class="flex-1 p-6 ml-0 md:ml-64 overflow-y-auto pt-16 transition-all duration-300">
                <!-- Dashboard Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Dashboard Overview</h1>
                    <p class="text-gray-600 mt-2">Welcome back, Admin! Here's what's happening with your pet adoption platform.</p>
                    
                    <!-- Date and Quick Actions -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mt-4 gap-4">
                        <div class="flex items-center bg-white rounded-lg px-4 py-2 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-700">{{ now()->format('l, F j, Y') }}</span>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex items-center bg-blue-50 hover:bg-blue-100 text-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Pet
                            </button>
                            <button 
                                id="generateReportBtn"
                                class="flex items-center bg-green-50 hover:bg-green-100 text-green-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors"
                                onclick="generateReport()"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <span id="reportBtnText">Generate Report</span>
                                <span id="reportSpinner" class="hidden ml-2">
                                    <svg class="animate-spin h-4 w-4 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Report Generation Modal -->
                <div id="reportModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Generate Report</h3>
                            <button onclick="closeReportModal()" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Report Type</label>
                            <select id="reportType" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="summary">Summary Report</option>
                                <option value="detailed">Detailed Report</option>
                                <option value="adoptions">Adoptions Report</option>
                                <option value="users">Users Report</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="date" id="startDate" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <input type="date" id="endDate" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Format</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="format" value="pdf" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">PDF</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="format" value="csv" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">CSV</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="format" value="excel" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Excel</span>
                                </label>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button onclick="closeReportModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button onclick="confirmReportGeneration()" class="px-4 py-2 bg-blue-600 rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Generate
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Report Success Notification -->
                <div id="reportSuccess" class="hidden fixed top-4 right-4 z-50">
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">
                                    Report generated successfully! <a href="#" id="downloadLink" class="font-semibold underline hover:text-green-600">Download now</a>
                                </p>
                            </div>
                            <div class="ml-auto pl-3">
                                <button onclick="closeSuccessNotification()" class="-mx-1.5 -my-1.5 inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Pets -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-blue-500 group">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Pets</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalPets }}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full group-hover:bg-blue-200 transition-colors">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded">12% increase</span>
                            <span class="text-xs text-gray-500 ml-2">vs last month</span>
                        </div>
                    </div>

                    <!-- Adopted Pets -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-green-500 group">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Adopted Pets</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $adoptedPets }}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full group-hover:bg-green-200 transition-colors">
                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center">
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-0.5 rounded">8% increase</span>
                            <span class="text-xs text-gray-500 ml-2">vs last month</span>
                        </div>
                    </div>

                    <!-- Pending Approvals -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-yellow-500 group">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pending Approvals</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $pendingPets }}</p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full group-hover:bg-yellow-200 transition-colors">
                                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center">
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-0.5 rounded">3% decrease</span>
                            <span class="text-xs text-gray-500 ml-2">vs last month</span>
                        </div>
                    </div>

                    <!-- Total Users -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-purple-500 group">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Users</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalUsers }}</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full group-hover:bg-purple-200 transition-colors">
                                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center">
                            <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2 py-0.5 rounded">15% increase</span>
                            <span class="text-xs text-gray-500 ml-2">vs last month</span>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Pet Types Distribution -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Pet Types Distribution</h3>
                                <p class="text-sm text-gray-500">Breakdown by animal type</p>
                            </div>
                            <select class="text-sm border border-gray-200 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50">
                                <option>This Month</option>
                                <option>Last Month</option>
                                <option>This Year</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="petTypesChart"></canvas>
                        </div>
                    </div>

                    <!-- Adoption Rate -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Adoption Rate</h3>
                                <p class="text-sm text-gray-500">Adoptions over time</p>
                            </div>
                            <select class="text-sm border border-gray-200 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50">
                                <option>Last 7 Days</option>
                                <option>Last 30 Days</option>
                                <option>Last 90 Days</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="adoptionRateChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Popular Breeds & Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Popular Breeds -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Most Popular Breeds</h3>
                            <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">View All</button>
                        </div>
                        <div class="space-y-4">
                            @foreach($popularBreeds as $breed)
                            <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-gray-800 truncate">{{ $breed->breed }}</h4>
                                    <p class="text-sm text-gray-500 truncate">{{ $breed->petType->name }}</p>
                                </div>
                                <div class="text-right ml-4">
                                    <p class="font-semibold text-gray-800">{{ $breed->pets_count }} pets</p>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                        <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ round(($breed->pets_count / $totalPets) * 100) }}%"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Recent Activities</h3>
                            <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">View All</button>
                        </div>
                        <div class="space-y-4">
                            @foreach($recentActivities as $activity)
                            <div class="flex items-start p-3 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="flex-shrink-0 mr-3 mt-1">
                                    <div class="w-8 h-8 rounded-full bg-{{ $activity['color'] }}-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-{{ $activity['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $activity['icon'] }}"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-800">{{ $activity['description'] }}</p>
                                    <div class="flex items-center mt-1">
                                        <span class="text-xs text-gray-500">{{ $activity['time'] }}</span>
                                        @if($activity['status'] ?? false)
                                        <span class="ml-2 text-xs px-1.5 py-0.5 rounded bg-{{ $activity['statusColor'] }}-100 text-{{ $activity['statusColor'] }}-800">{{ $activity['status'] }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

          function generateReport() {
            // Show modal
            document.getElementById('reportModal').classList.remove('hidden');
            
            // Set default dates
            const today = new Date();
            const oneMonthAgo = new Date();
            oneMonthAgo.setMonth(oneMonthAgo.getMonth() - 1);
            
            document.getElementById('startDate').valueAsDate = oneMonthAgo;
            document.getElementById('endDate').valueAsDate = today;
        }

        function closeReportModal() {
            document.getElementById('reportModal').classList.add('hidden');
        }

       function confirmReportGeneration() {
    const reportType = document.getElementById('reportType').value;
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    const format = document.querySelector('input[name="format"]:checked').value;
    
    const btn = document.getElementById('generateReportBtn');
    const btnText = document.getElementById('reportBtnText');
    const spinner = document.getElementById('reportSpinner');
    
    btn.disabled = true;
    btnText.textContent = 'Generating...';
    spinner.classList.remove('hidden');
    
    closeReportModal();
    
    // Make API call
    fetch('/generate-report', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/pdf',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            type: reportType,
            start_date: startDate,
            end_date: endDate,
            format: format
        })
    })
    .then(response => {
        if (!response.ok) throw new Error('Report generation failed');
        return response.blob();
    })
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `pet_report_${new Date().toISOString().slice(0,10)}.pdf`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
        
        document.getElementById('reportSuccess').classList.remove('hidden');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to generate report: ' + error.message);
    })
    .finally(() => {
        btn.disabled = false;
        btnText.textContent = 'Generate Report';
        spinner.classList.add('hidden');
    });
}

        function closeSuccessNotification() {
            document.getElementById('reportSuccess').classList.add('hidden');
        }

        // Pet Types Chart
        const petTypesCtx = document.getElementById('petTypesChart').getContext('2d');
        const petTypesChart = new Chart(petTypesCtx, {
            type: 'doughnut',
            data: {
                labels: @json($petTypes->pluck('name')),
                datasets: [{
                    data: @json($petTypes->map(function($type) { return $type->pets_count; })),
                    backgroundColor: [
                        '#3B82F6', // blue
                        '#10B981', // green
                        '#F59E0B', // yellow
                        '#EF4444', // red
                        '#8B5CF6', // purple
                        '#EC4899', // pink
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                family: "'Inter', sans-serif"
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1F2937',
                        titleFont: {
                            family: "'Inter', sans-serif",
                            size: 14
                        },
                        bodyFont: {
                            family: "'Inter', sans-serif",
                            size: 12
                        },
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Adoption Rate Chart
        const adoptionRateCtx = document.getElementById('adoptionRateChart').getContext('2d');
        const adoptionRateChart = new Chart(adoptionRateCtx, {
            type: 'line',
            data: {
                labels: @json($adoptionRate->pluck('date')),
                datasets: [
                    {
                        label: 'Adoptions',
                        data: @json($adoptionRate->pluck('count')),
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.05)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10B981',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: '#1F2937',
                        titleFont: {
                            family: "'Inter', sans-serif",
                            size: 14
                        },
                        bodyFont: {
                            family: "'Inter', sans-serif",
                            size: 12
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>