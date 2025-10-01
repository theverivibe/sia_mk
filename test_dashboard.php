<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Test manual untuk dashboard
$user = User::find(1); // Admin IT
Auth::login($user);

echo "User logged in: " . $user->name . " (Role: " . $user->role . ")\n";
echo "Dashboard should work now.\n";
echo "Try accessing: http://127.0.0.1:8000/dashboard\n";

// Test stats manually
$totalAssets = \App\Models\Asset::count();
echo "Total assets: " . $totalAssets . "\n";

$totalComplaints = \App\Models\Complaint::count();
echo "Total complaints: " . $totalComplaints . "\n";

echo "Test completed successfully!\n";