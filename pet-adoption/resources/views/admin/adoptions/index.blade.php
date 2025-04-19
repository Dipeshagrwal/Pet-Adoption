<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <div class="fixed top-0 left-0 h-full z-40 md:z-auto">
            @include('admin.sidebar')
        </div>

        <!-- Page Content -->
        <div class="flex-1 ml-64 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen p-10">
            <div class="mb-10">
                <h1 class="text-4xl font-bold text-gray-800 relative inline-block">
                    Adoption Requests
                    <span class="absolute bottom-0 left-0 w-full h-1 bg-teal-400 rounded-full"></span>
                </h1>
                <p class="text-gray-500 mt-2">Manage all adoption requests in the system</p>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Status Filter -->
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 
                                  {{ !$status ? 'bg-teal-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            All ({{ $counts['all'] }})
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'Pending']) }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 
                                  {{ $status === 'Pending' ? 'bg-yellow-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Pending ({{ $counts['pending'] }})
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'Approved']) }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 
                                  {{ $status === 'Approved' ? 'bg-green-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Approved ({{ $counts['approved'] }})
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'Rejected']) }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 
                                  {{ $status === 'Rejected' ? 'bg-red-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Rejected ({{ $counts['rejected'] }})
                        </a>
                    </div>

                    <!-- Search Form -->
                    <form method="GET" action="" class="flex items-center gap-2">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Search requests..." 
                                   value="{{ $search }}" 
                                   class="pl-10 pr-4 py-2 w-64 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition duration-200 shadow-sm flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Search
                        </button>
                        @if($search || $status)
                            <a href="{{ route('admin.adoptions.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200 flex items-center gap-2">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Requests List -->
            @forelse ($adoptionRequests as $request)
                <div class="bg-white shadow-lg rounded-2xl p-6 mb-6 hover:shadow-xl transition duration-300 border border-gray-100 overflow-hidden relative group">
                    <!-- Decorative elements -->
                    <div class="absolute -right-2 -top-2 w-16 h-16 rounded-full bg-teal-100 opacity-20 group-hover:opacity-30 transition duration-300"></div>
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 rounded-full bg-teal-50 opacity-20 group-hover:opacity-30 transition duration-500"></div>
                    
                    <div class="md:flex items-start gap-6 relative z-10">
                        <!-- Pet Image -->
                        <div class="flex-shrink-0 mb-4 md:mb-0 transform group-hover:scale-105 transition duration-300">
                            <div class="w-40 h-40 rounded-xl overflow-hidden border-2 border-white shadow-md">
                                <img src="{{ asset('storage/' . $request->pet->image) }}" alt="{{ $request->pet->name }}"
                                     class="w-full h-full object-cover hover:scale-110 transition duration-500">
                            </div>
                        </div>

                        <!-- Info Section -->
                        <div class="flex-1 space-y-3">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                <div>
                                    <h2 class="text-2xl font-bold text-teal-700">{{ $request->pet->name }}</h2>
                                    <p class="text-gray-500 text-sm">Requested on: {{ $request->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                        {{
                                            $request->status === 'Approved' ? 'bg-green-100 text-green-700 shadow-sm' :
                                            ($request->status === 'Rejected' ? 'bg-red-100 text-red-700 shadow-sm' :
                                            'bg-yellow-100 text-yellow-700 shadow-sm')
                                        }}">
                                        {{ $request->status }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <!-- Owner Info -->
                                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Owner Information</h3>
                                    <p class="text-gray-700 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $request->pet->user->name }}
                                    </p>
                                    <p class="text-gray-700 flex items-center gap-2 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ $request->pet->whatsapp_no }}
                                    </p>
                                </div>
                                
                                <!-- Adopter Info -->
                                {{-- <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Adopter Information</h3>
                                    <p class="text-gray-700 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $request->adopter_name }}
                                    </p>
                                    <p class="text-gray-700 flex items-center gap-2 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ $request->adopter_contact }}
                                    </p>
                                </div> --}}
                            </div>

                            <!-- Status & Reason -->
                            @if($request->rejection_reason)
                                <div class="mt-4 p-3 bg-red-50 rounded-lg border border-red-100">
                                    <p class="text-sm text-red-600 flex items-start gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <span><span class="font-medium">Reason for rejection:</span> {{ $request->rejection_reason }}</span>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="max-w-md mx-auto">
                        <img src="https://cdn-icons-png.flaticon.com/512/6598/6598516.png" class="w-32 mx-auto mb-6 opacity-80">
                        <h3 class="text-xl font-medium text-gray-700 mb-2">No adoption requests found</h3>
                        <p class="text-gray-500 mb-6">
                            @if($status || $search)
                                Try adjusting your search or filter criteria
                            @else
                                There are no adoption requests to display at this time
                            @endif
                        </p>
                        @if($status || $search)
                            <a href="{{ route('admin.adoptions.index') }}" class="inline-flex items-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition duration-300 shadow-sm">
                                Clear filters
                            </a>
                        @endif
                    </div>
                </div>
            @endforelse
            
            <!-- Pagination -->
            @if($adoptionRequests->hasPages())
                <div class="mt-8 bg-white p-4 rounded-xl shadow-sm">
                    {{ $adoptionRequests->appends([
                        'search' => $search,
                        'status' => $status
                    ])->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>