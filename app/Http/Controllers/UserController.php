<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function fetchAndStoreUsers()
    {
        $clientRole = Role::where('name', 'client')->first();

        $client = new Client();
        $response = $client->get('https://reqres.in/api/users');
        $users = json_decode($response->getBody()->getContents(), true)['data'];

        foreach ($users as $userData) {
            $existingUser = User::where('email', $userData['email'])->first();
            if (!$existingUser) {
                $user = User::create([
                    'name' => $userData['first_name'] . ' ' . $userData['last_name'],
                    'email' => $userData['email'],
                    'password' => Hash::make('defaultpassword'),
                ]);

                $user->assignRole($clientRole);
            }
        }

        return response()->json(['message' => 'Users fetched and stored successfully']);
    }
}
