<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

use App\Models\User;

echo "Testing User System:\n";
echo "====================\n";

$users = User::all(['name', 'email', 'role']);

foreach ($users as $user) {
    echo "Name: {$user->name}\n";
    echo "Email: {$user->email}\n";
    echo "Role: {$user->role}\n";
    echo "Is Admin: " . ($user->isAdmin() ? 'Yes' : 'No') . "\n";
    echo "Is Teknisi: " . ($user->isTeknisi() ? 'Yes' : 'No') . "\n";
    echo "Is Owner: " . ($user->isOwner() ? 'Yes' : 'No') . "\n";
    echo "-------------------\n";
}

echo "\nTotal users: " . User::count() . "\n";
