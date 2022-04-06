<x-admin-master>

    @if(auth()->user()->userHasRole('Admin'))
    @section('content')
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    @endsection
        @endif

</x-admin-master>
