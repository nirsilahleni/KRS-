<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ResponseFormatter;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Mengambil data user yang sedang login
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Mengambil data user yang sedang login
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('images', $imageName, 'public'); // Store image in storage/app/public/images directory
            $user->image = $path; // Save image path to user's image field
        }

        $user->update();

        return ResponseFormatter::success('Profil berhasil diperbarui');
    }
}