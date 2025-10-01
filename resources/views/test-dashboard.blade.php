<!DOCTYPE html>
<html>
<head>
    <title>Test Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Test Dashboard</h1>
        
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">User Info</h2>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ $user->role }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-2">Assets</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['total_assets'] }}</p>
                <p class="text-sm text-gray-600">
                    Available: {{ $stats['available_assets'] }} | 
                    In Use: {{ $stats['in_use_assets'] }}
                </p>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-2">Total Complaints</h3>
                <p class="text-3xl font-bold text-orange-600">{{ $stats['total_complaints'] }}</p>
                <p class="text-sm text-gray-600">
                    New: {{ $stats['new_complaints'] }} | 
                    Resolved: {{ $stats['resolved_complaints'] }}
                </p>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-2">Actions</h3>
                <div class="space-y-2">
                    <a href="/dashboard" class="block bg-blue-500 text-white px-4 py-2 rounded text-center hover:bg-blue-600">
                        Go to Real Dashboard
                    </a>
                    <a href="/assets" class="block bg-green-500 text-white px-4 py-2 rounded text-center hover:bg-green-600">
                        View Assets
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>