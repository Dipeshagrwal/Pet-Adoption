<x-app-layout>
    <div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Sidebar -->
        <aside class="fixed top-0 left-0 h-full z-40">
            @include('admin.sidebar')
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-72 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-6 py-8">
                <!-- Page Header -->
                <div
                    class="flex flex-col space-y-4 md:space-y-0 md:flex-row justify-between items-start md:items-end mb-10">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 font-serif tracking-tight">Adoption Requests</h1>
                        <p class="text-lg text-gray-600 mt-2">Review and manage pet adoption applications</p>
                    </div>
                    <form method="GET" action="{{ route('admin.adoption-requests.index') }}"
                        class="relative w-full md:w-auto">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search requests..."
                            class="pl-10 pr-4 py-3 border-0 rounded-xl bg-white shadow-sm focus:ring-2 focus:ring-amber-400 focus:border-transparent w-full md:w-72 text-gray-700 placeholder-gray-400 transition-all duration-200">
                        @if (request('status'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif
                    </form>
                </div>

                <!-- Search Results Message -->
                @if (request('search'))
                    <div class="mb-6 p-4 bg-white rounded-xl shadow-sm border border-gray-200">
                        <p class="text-gray-700">
                            @if ($adoptionRequests->isEmpty())
                                No adoption requests found matching '{{ request('search') }}'
                                @if (request('status'))
                                    in {{ request('status') }} requests
                                @endif
                            @else
                                Showing {{ $adoptionRequests->count() }} results for '{{ request('search') }}'
                                @if (request('status'))
                                    in {{ request('status') }} requests
                                @endif
                            @endif
                        </p>
                        @if ($adoptionRequests->isEmpty())
                            <a href="{{ route('admin.adoption-requests.index') }}"
                                class="mt-2 inline-block text-amber-600 hover:text-amber-800">
                                Clear search and show all requests
                            </a>
                        @endif
                    </div>
                @endif

                <!-- Status Filter -->
                <div class="flex flex-wrap gap-3 mb-10">
                    <a href="{{ route('admin.adoption-requests.index') }}"
                        class="px-5 py-2.5 rounded-xl {{ !request('status') ? 'bg-amber-100 text-amber-800' : 'bg-white text-gray-700' }} shadow-sm font-medium hover:bg-amber-50 transition-all duration-200 flex items-center space-x-2 border border-gray-100">
                        <span>All Requests</span>
                        <span
                            class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ $counts['all'] ?? 0 }}</span>
                    </a>
                    <a href="{{ route('admin.adoption-requests.index', ['status' => 'Pending', 'search' => request('search')]) }}"
                        class="px-5 py-2.5 rounded-xl {{ request('status') === 'Pending' ? 'bg-amber-200/80' : 'bg-amber-100/80' }} shadow-sm text-amber-800 font-medium hover:bg-amber-200/80 transition-all duration-200 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Pending</span>
                        <span
                            class="bg-amber-200/50 text-amber-800 text-xs px-2 py-1 rounded-full">{{ $counts['pending'] ?? 0 }}</span>
                    </a>
                    <a href="{{ route('admin.adoption-requests.index', ['status' => 'Approved', 'search' => request('search')]) }}"
                        class="px-5 py-2.5 rounded-xl {{ request('status') === 'Approved' ? 'bg-emerald-200/80' : 'bg-emerald-100/80' }} shadow-sm text-emerald-800 font-medium hover:bg-emerald-200/80 transition-all duration-200 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Approved</span>
                        <span
                            class="bg-emerald-200/50 text-emerald-800 text-xs px-2 py-1 rounded-full">{{ $counts['approved'] ?? 0 }}</span>
                    </a>
                    <a href="{{ route('admin.adoption-requests.index', ['status' => 'Rejected', 'search' => request('search')]) }}"
                        class="px-5 py-2.5 rounded-xl {{ request('status') === 'Rejected' ? 'bg-rose-200/80' : 'bg-rose-100/80' }} shadow-sm text-rose-800 font-medium hover:bg-rose-200/80 transition-all duration-200 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Rejected</span>
                        <span
                            class="bg-rose-200/50 text-rose-800 text-xs px-2 py-1 rounded-full">{{ $counts['rejected'] ?? 0 }}</span>
                    </a>
                </div>

                <!-- Requests Grid -->
                @if ($adoptionRequests->isEmpty() && !request('search'))
                    <div class="bg-white rounded-2xl shadow-sm p-12 text-center border border-gray-100">
                        <div
                            class="mx-auto h-40 w-40 flex items-center justify-center rounded-full bg-amber-50 text-amber-400 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-medium text-gray-900">No adoption requests found</h3>
                        <p class="mt-2 text-gray-500 max-w-md mx-auto">There are currently no adoption requests to
                            display. When you receive new requests, they'll appear here.</p>
                    </div>
                @elseif($adoptionRequests->isEmpty())
                    <!-- Empty state handled by search message -->
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($adoptionRequests as $request)
                            <div
                                class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100/50">
                                <!-- Pet Image with Status Badge -->
                                <div class="relative h-60 overflow-hidden group">
                                    <img src="{{ asset('storage/' . $request->pet->image) }}"
                                        alt="{{ $request->pet->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                                    <!-- Status Badge -->
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-md
                        {{ $request->status === 'Approved'
                            ? 'bg-emerald-100 text-emerald-800 border border-emerald-200'
                            : ($request->status === 'Rejected'
                                ? 'bg-rose-100 text-rose-800 border border-rose-200'
                                : 'bg-amber-100 text-amber-800 border border-amber-200') }}">
                                            {{ $request->status }}
                                        </span>
                                    </div>

                                    <!-- Pet Name Overlay -->
                                    <div
                                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                        <h2 class="text-xl font-bold text-white">{{ $request->pet->name }}</h2>
                                    </div>
                                </div>

                                <!-- Request Details -->
                                <div class="p-6">
                                    <!-- Adopter Info -->
                                    <div class="flex items-center mb-4">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-500 mr-3 border border-amber-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-semibold text-gray-500">Adopter</h3>
                                            <p class="text-gray-900 font-medium">{{ $request->adopter_name }}</p>
                                        </div>
                                    </div>

                                    <!-- Contact Info -->
                                    <div class="flex items-center mb-4">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 mr-3 border border-blue-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-semibold text-gray-500">Contact</h3>
                                            <p class="text-gray-900 font-medium">{{ $request->adopter_contact }}</p>
                                        </div>
                                    </div>

                                    <!-- Request Date -->
                                    <div class="flex items-center mb-5">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-50 flex items-center justify-center text-purple-500 mr-3 border border-purple-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-semibold text-gray-500">Request Date</h3>
                                            <p class="text-gray-900 font-medium">
                                                {{ $request->created_at->format('M j, Y') }}</p>
                                        </div>
                                    </div>

                                    <!-- Rejection Reason (if exists) -->
                                    @if ($request->rejection_reason)
                                        <div class="mt-4 p-3 bg-rose-50 rounded-lg border border-rose-100">
                                            <h4
                                                class="text-xs font-semibold text-rose-700 uppercase tracking-wider mb-1">
                                                Rejection Reason</h4>
                                            <p class="text-sm text-rose-700">{{ $request->rejection_reason }}</p>
                                        </div>
                                    @endif

                                    <!-- Action Buttons (for pending requests) -->
                                    @if ($request->status === 'Pending')
                                        <div class="mt-6 flex justify-end space-x-3">
                                            <form action="{{ route('admin.adoption-requests.update', $request) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Approved">
                                                <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Approve
                                                </button>
                                            </form>
                                            <button onclick="openRejectModal('{{ $request->id }}')" type="button"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Reject
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-10 flex justify-center">
                        {{ $adoptionRequests->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50 transition-opacity duration-300">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4 shadow-2xl transform transition-all duration-300 scale-95 opacity-0"
            id="modalContent">
            <div class="absolute top-4 right-4">
                <button onclick="closeRejectModal()" type="button"
                    class="rounded-full p-1 bg-gray-100 text-gray-400 hover:text-gray-500 focus:outline-none hover:bg-gray-200 transition-colors duration-200">
                    <span class="sr-only">Close</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex items-start">
                <div
                    class="flex-shrink-0 h-12 w-12 rounded-full bg-rose-100 flex items-center justify-center text-rose-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Reject Adoption Request</h3>
                    <p class="mt-2 text-gray-600">Please provide a clear reason for rejecting this application.</p>
                </div>
            </div>

            <form id="rejectForm" method="POST" class="mt-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="Rejected">
                <div class="mb-5">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Reason for
                        Rejection</label>
                    <textarea name="rejection_reason" id="rejection_reason" rows="4"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500"
                        placeholder="Explain why this application is being rejected..." required></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeRejectModal()"
                        class="px-5 py-2.5 border border-gray-300 rounded-xl bg-white text-gray-700 font-medium hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 border border-transparent rounded-xl shadow-sm text-white font-medium bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-colors duration-200">
                        Confirm Rejection
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Script -->
    <script>
        function openRejectModal(requestId) {
            document.getElementById('rejectForm').reset();
            document.getElementById('rejectForm').action = `admin/adoption-requests/${requestId}`;
            document.getElementById('rejectModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            // Trigger animation
            setTimeout(() => {
                document.getElementById('modalContent').classList.remove('scale-95', 'opacity-0');
                document.getElementById('modalContent').classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeRejectModal() {
            document.getElementById('modalContent').classList.remove('scale-100', 'opacity-100');
            document.getElementById('modalContent').classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                document.getElementById('rejectModal').classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 200);
        }

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
    </script>
</x-app-layout>
