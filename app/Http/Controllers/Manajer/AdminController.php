<?php

namespace App\Http\Controllers\Manajer;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
   public function index(Request $request)
{
    $admins = Admin::with('user')->get();

    if ($request->expectsJson()) {
        return response()->json($admins);
    }
    return view('pages.manajer.admin.index', compact('admins'));
}

  public function store(Request $request)
  {
      // Logic to store admin data
  $validatedData = $request->validate([
    'nama_admin' => 'required|string|max:255',
    'alamat' => 'required|string|max:255',
    'no_telepon' => 'required|string|min:12|max:20',
    'name' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users',
    'password' => 'required|string|min:8|confirmed',
]);

      // Create the user table
      $user = User::create([
          'name' => $validatedData['name'],
          'email' => $validatedData['email'],
          'password' => Hash::make($validatedData['password']),
          'role' => 'admin',
      ]);

        // Create the admin table
      $admin = Admin::create([
          'nama_admin' => $validatedData['nama_admin'],
          'alamat' => $validatedData['alamat'],
          'no_telepon' => $validatedData['no_telepon'],
          'id_user' => $user->id,
      ]);

      // Support JSON untuk API/Postman
    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Admin created successfully.',
            'data' => $admin->load('user')
        ], 201);
    }

      return redirect()->route('manajer.admin.index')->with('success', 'Admin created successfully.');
  }

public function edit($id, Request $request)
{
    $admins = Admin::findOrFail($id);
      if ($request->expectsJson()) {
        return response()->json($admins);
    }
    return view('pages.manajer.admin.edit', compact('admins'));
}

  public function update(Request $request, $id)
  {
      $admin = Admin::findOrFail($id);

      $validatedData = $request->validate([
          'nama_admin' => 'required|string|max:255',
          'alamat' => 'required|string|max:255',
          'no_telepon' => 'required|string|min:12|max:20',
          'id_user' => 'required|integer|exists:users,id',
      ]);

      $admin->update($validatedData);
      if ($request->expectsJson()) {
    return response()->json(['success' => true, 'message' => 'Updated', 'data' => $admin->load('user')]);
}
return redirect()->route('manajer.admin.index')->with('success', 'Admin updated successfully.');

  }
public function updatePassword(Request $request, $id)
{
    $validatedData = $request->validate([
        'password' => 'required|string|min:8|confirmed',
    ]);

    $admin = Admin::findOrFail($id);
    $user = $admin->user;

    $user->update([
        'password' => Hash::make($validatedData['password']),
    ]);

    if ($request->expectsJson()) {
        return response()->json(['success' => true, 'message' => 'Password updated successfully.']);
    }
    return redirect()->route('manajer.admin.index')->with('success', 'Password updated successfully.');
}

public function destroy(Request $request, $id)
{
    $admin = Admin::findOrFail($id);
    $user = User::findOrFail($admin->id_user);

    $admin->delete();
    $user->delete();

    if ($request->expectsJson()) {
        return response()->json(['success' => true, 'message' => 'Deleted']);
    }
    return redirect()->route('manajer.admin.index')->with('success', 'Admin deleted successfully.');
}



}
