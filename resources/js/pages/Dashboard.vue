<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { onMounted, ref } from 'vue'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const monthlyTargetChart = ref(null)
const monthlySalesChart = ref(null)
const statisticsChart = ref(null)

const recentOrders = [
    { 
        id: 1, 
        product: 'MacBook Pro 13"', 
        category: 'Laptop',
        company: 'Apple Inc',
        price: '2,999.00', 
        status: 'Delivered',
        productIcon: 'M',
        productBg: 'bg-purple-100',
        productText: 'text-purple-600'
    },
    { 
        id: 2, 
        product: 'Surface Laptop Ultra', 
        category: 'Laptop',
        company: 'Microsoft',
        price: '2,879.00', 
        status: 'Pending',
        productIcon: 'S',
        productBg: 'bg-blue-100',
        productText: 'text-blue-600'
    },
    { 
        id: 3, 
        product: 'iPhone 15 Pro Max', 
        category: 'Phone',
        company: 'Apple Inc',
        price: '1,299.00', 
        status: 'Delivered',
        productIcon: 'i',
        productBg: 'bg-gray-100',
        productText: 'text-gray-600'
    },
    { 
        id: 4, 
        product: 'Galaxy S24 Ultra', 
        category: 'Phone',
        company: 'Samsung',
        price: '1,199.00', 
        status: 'Cancelled',
        productIcon: 'G',
        productBg: 'bg-green-100',
        productText: 'text-green-600'
    },
    { 
        id: 5, 
        product: 'AirPods Pro 2nd Gen', 
        category: 'Accessories',
        company: 'Apple Inc',
        price: '249.00', 
        status: 'Delivered',
        productIcon: 'A',
        productBg: 'bg-orange-100',
        productText: 'text-orange-600'
    },
]

const demographics = [
    { country: 'USA', percentage: 70, flagColor: 'bg-blue-500', barColor: 'bg-blue-500' },
    { country: 'France', percentage: 22, flagColor: 'bg-red-500', barColor: 'bg-blue-400' },
    { country: 'Germany', percentage: 18, flagColor: 'bg-yellow-500', barColor: 'bg-blue-300' },
    { country: 'Japan', percentage: 15, flagColor: 'bg-red-600', barColor: 'bg-blue-200' },
]

onMounted(async () => {
    // Dynamic import of Chart.js
    const { Chart, registerables } = await import('chart.js')
    Chart.register(...registerables)


    if (monthlyTargetChart.value) {
        new Chart(monthlyTargetChart.value, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [75.55, 24.45],
                    backgroundColor: ['#3b82f6', '#e5e7eb'],
                    borderWidth: 0,
                    cutout: '85%',
                    circumference: 180,
                    rotation: 270
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                }
            }
        })
    }

    // Monthly Sales Bar Chart
    if (monthlySalesChart.value) {
        const salesData = [50, 0, 400, 40, 700, 45, 30, 40, 35, 50, 40, 35]; // March has high value, others low
        
        new Chart(monthlySalesChart.value, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    data: salesData,
                    backgroundColor: salesData.map((value, index) => index === 2 ? '#3b82f6' : '#e5e7eb'), // March blue, others light gray
                    borderRadius: 4,
                    barThickness: 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 800,
                        ticks: {
                            stepSize: 200,
                            callback: function(value) {
                                return value;
                            }
                        },
                        grid: { 
                            display: true,
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        })
    }

    // Statistics Line Chart
    if (statisticsChart.value) {
        new Chart(statisticsChart.value, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        data: [500, 520, 480, 540, 580, 560, 600, 620, 580, 640, 660, 680],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2
                    },
                    {
                        data: [450, 470, 430, 490, 530, 510, 550, 570, 530, 590, 610, 630],
                        borderColor: '#8b5cf6',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        })
    }
})

// Add these computed properties and data
const countryMarkers = [
    { code: 'US', x: 200, y: 150, percentage: 70 },
    { code: 'FR', x: 480, y: 140, percentage: 22 },
    { code: 'DE', x: 500, y: 130, percentage: 18 },
    { code: 'JP', x: 850, y: 160, percentage: 15 },
    { code: 'AU', x: 820, y: 380, percentage: 11 }
]

const getMarkerColor = (percentage) => {
    if (percentage >= 50) return '#2563eb'
    if (percentage >= 30) return '#3b82f6'
    if (percentage >= 20) return '#60a5fa'
    if (percentage >= 10) return '#93c5fd'
    return '#dbeafe'
}

const getMarkerSize = (percentage) => {
    if (percentage >= 50) return 8
    if (percentage >= 30) return 6
    if (percentage >= 20) return 5
    return 4
}
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-6 p-5">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <!-- Customer and Orders cards row -->
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Customer Card -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-500">Customer</span>
                            </div>
                            <div class="flex items-end justify-between">
                                <p class="text-3xl font-bold text-gray-900">3,782</p>
                                <div class="flex items-center text-sm font-medium text-green-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                    </svg>
                                    1.8%
                                </div>
                            </div>
                        </div>

                        <!-- Orders Card -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-500">Orders</span>
                            </div>
                            <div class="flex items-end justify-between">
                                <p class="text-3xl font-bold text-gray-900">5,359</p>
                                <div class="flex items-center text-sm font-medium text-green-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                    </svg>
                                    4.6%
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Sales Chart - below the two cards -->
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Monthly Sales</h3>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="h-54">
                            <canvas ref="monthlySalesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Right side - Monthly Target (1 column) -->

                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-xl font-semibold text-gray-900">Monthly Target</h3>
                <span class="text-sm text-gray-500">Target you've set for each month</span>
            </div>
            <button class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                </svg>
            </button>
        </div>
        
        <div class="flex items-center justify-center mb-8">
            <div class="relative w-48 h-28">
                <canvas ref="monthlyTargetChart" width="192" height="112"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center mt-4">
                    <span class="text-xl font-bold text-gray-900">75.55%</span>
                    <div class="text-sm font-medium text-green-500 mt-1">
                        +10%
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center text-gray-600 mb-6 px-4">
            <p class="text-sm leading-relaxed">
                You earn $3287 today, its higher than last month.
            </p>
            <p class="text-sm font-medium">
                Keep up your good work!
            </p>
        </div>
    </div>
    
    <div class="border-t border-gray-200">
        <div class="grid grid-cols-3 gap-6 text-center p-6 bg-gray-50">
            <div>
                <p class="text-sm text-gray-500 mb-2">Target</p>
                <div class="flex items-center justify-center">
                    <p class="text-lg font-bold text-gray-900">$20K</p>
                    <svg class="w-4 h-4 ml-1 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Revenue</p>
                <div class="flex items-center justify-center">
                    <p class="text-lg font-bold text-gray-900">$16K</p>
                    <svg class="w-4 h-4 ml-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Today</p>
                <div class="flex items-center justify-center">
                    <p class="text-lg font-bold text-gray-900">$1.5K</p>
                    <svg class="w-4 h-4 ml-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

            </div>

            <!-- Statistics Chart - Full Width -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Statistics</h3>
                        <p class="text-sm text-gray-500">Target you set for each month</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-md">Overview</button>
                        <button class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">Sales</button>
                        <button class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">Revenue</button>
                        <div class="relative">
                            <select class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 border-none focus:ring-2 focus:ring-blue-500 focus:bg-white cursor-pointer">
                                <option value="this-month">This Month</option>
                                <option value="last-month">Last Month</option>
                                <option value="this-quarter">This Quarter</option>
                                <option value="last-quarter">Last Quarter</option>
                                <option value="this-year">This Year</option>
                                <option value="last-year">Last Year</option>
                            </select>
                        </div>                    </div>
                </div>
                <div class="h-64">
                    <canvas ref="statisticsChart"></canvas>
                </div>
            </div>

            <!-- Bottom section with Demographics and Recent Orders -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Customer Demographics</h3>
                            <p class="text-sm text-gray-500">Number of customers based on country</p>
                        </div>
                    </div>
                    
                    <!-- World Map with SVG -->
                    <div class="h-60 bg-gray-50 rounded-lg mb-6 flex items-center justify-center relative overflow-hidden">
                        <svg viewBox="0 0 1000 500" class="w-full h-full">
                            <!-- World Map Background -->
                            <g fill="#e5e7eb" stroke="#d1d5db" stroke-width="0.5">
                                <!-- North America -->
                                <path d="M158 206L180 180L220 160L280 140L320 160L340 180L360 200L380 220L360 240L340 260L320 280L280 300L240 320L200 340L160 320L140 300L120 280L100 260L120 240L140 220Z"/>
                                
                                <!-- South America -->
                                <path d="M280 320L300 340L320 380L340 420L360 460L340 480L320 460L300 440L280 420L260 400L240 380L220 360L240 340L260 320Z"/>
                                
                                <!-- Europe -->
                                <path d="M480 180L520 160L560 140L580 160L600 180L580 200L560 220L540 240L520 220L500 200Z"/>
                                
                                <!-- Africa -->
                                <path d="M520 280L540 300L560 340L580 380L600 420L580 460L560 440L540 420L520 400L500 380L480 360L460 340L480 320L500 300Z"/>
                                
                                <!-- Asia -->
                                <path d="M680 200L720 180L780 160L840 140L880 160L920 180L940 200L920 220L900 240L880 260L860 280L840 300L820 280L800 260L780 240L760 220L740 200Z"/>
                                
                                <!-- Australia -->
                                <path d="M780 380L820 360L860 380L880 400L860 420L820 440L780 420L760 400Z"/>
                                
                                <!-- Additional landmasses for more realistic look -->
                                <path d="M400 120L440 100L480 120L460 140L420 160L400 140Z"/> <!-- Greenland -->
                                <path d="M600 100L640 80L680 100L660 120L620 140L600 120Z"/> <!-- Northern Europe -->
                                <path d="M160 100L200 80L240 100L220 120L180 140L160 120Z"/> <!-- Canada -->
                            </g>
                            
                            <!-- Dynamic Country Markers -->
                            <g>
                                <circle cx="200" cy="150" r="6" fill="#3b82f6" class="cursor-pointer hover:opacity-80 transition-opacity"/>
                                <circle cx="480" cy="140" r="5" fill="#60a5fa" class="cursor-pointer hover:opacity-80 transition-opacity"/>
                                <circle cx="500" cy="130" r="5" fill="#60a5fa" class="cursor-pointer hover:opacity-80 transition-opacity"/>
                                <circle cx="850" cy="160" r="4" fill="#93c5fd" class="cursor-pointer hover:opacity-80 transition-opacity"/>
                                <circle cx="820" cy="380" r="4" fill="#93c5fd" class="cursor-pointer hover:opacity-80 transition-opacity"/>
                            </g>
                        </svg>
                    </div>
                    
                    <!-- Country Statistics -->
                    <div class="space-y-4">
                        <div v-for="demo in demographics" :key="demo.country" class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-6 h-4 rounded overflow-hidden flex-shrink-0">
                                    <div :class="demo.flagColor" class="w-full h-full"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ demo.country }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-20 bg-gray-200 rounded-full h-2">
                                    <div :class="demo.barColor" class="h-2 rounded-full transition-all duration-300" :style="`width: ${demo.percentage}%`"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-900 w-8">{{ demo.percentage }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
    
            <!-- Recent Orders -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
                    <div class="flex space-x-2">
                        <button class="text-sm text-gray-600 hover:text-gray-900">Filter</button>
                        <button class="text-sm text-gray-600 hover:text-gray-900">See all</button>
                    </div>
                </div>
                
                <!-- Table Header -->
                <div class="grid grid-cols-4 gap-4 pb-3 border-b border-gray-100 text-sm font-medium text-gray-500">
                    <span>Product</span>
                    <span>Company</span>
                    <span>Price</span>
                    <span>Status</span>
                </div>
                <!-- Orders List -->
                <div class="space-y-2 mt-2">
                    <div v-for="order in recentOrders" :key="order.id" class="grid grid-cols-4 gap-4 items-center py-3 hover:bg-gray-50 rounded-lg px-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center" :class="order.productBg">
                                <span class="text-xs font-medium" :class="order.productText">{{ order.productIcon }}</span>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-900">{{ order.product }}</p>
                                <p class="text-xs text-gray-500">{{ order.category }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-900">{{ order.company }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-900">${{ order.price }}</p>
                        </div>
                        <div>
                            <span :class="[
                                order.status === 'Delivered' ? 'bg-green-100 text-green-800' : 
                                order.status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                                'bg-red-100 text-red-800',
                                'inline-flex px-2 py-1 text-xs font-medium rounded-full'
                            ]">
                                {{ order.status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        </div>
    </AppLayout>
</template>
