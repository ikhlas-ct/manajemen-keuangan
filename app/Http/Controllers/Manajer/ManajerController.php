<?php

namespace App\Http\Controllers\Manajer;

use App\Models\User;
use App\Models\Manajer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ManajerController extends Controller
{
    public function index(Request $request)
{
    $manajers = Manajer::with('user')->get();

    if ($request->expectsJson()) {
        return response()->json($manajers);
    }
    return view('pages.manajer.manajer.index', compact('manajers'));
}

//   public function store(Request $request)
//   {
//       // Logic to store manajer data
//   $validatedData = $request->validate([
//     'nama_manajer' => 'required|string|max:255',
//     'alamat' => 'required|string|max:255',
//     'no_telepon' => 'required|string|min:12|max:20',
//     'name' => 'required|string|max:255',
//     'email' => 'required|string|email|max:255|unique:users',
//     'password' => 'required|string|min:8|confirmed',
// ]);

//       // Create the user table
//       $user = User::create([
//           'name' => $validatedData['name'],
//           'email' => $validatedData['email'],
//           'password' => Hash::make($validatedData['password']),
//           'role' => 'manajer',
//       ]);

//         // Create the manajer table
//       $manajer = Manajer::create([
//           'nama_manajer' => $validatedData['nama_manajer'],
//           'alamat' => $validatedData['alamat'],
//           'no_telepon' => $validatedData['no_telepon'],
//           'id_user' => $user->id,
//       ]);

//       // Support JSON untuk API/Postman
//     if ($request->expectsJson()) {
//         return response()->json([
//             'success' => true,
//             'message' => 'Manajer created successfully.',
//             'data' => $manajer->load('user')
//         ], 201);
//     }

//       return redirect()->route('manajer.manajer.index')->with('success', 'Manajer created successfully.');
//   }

// menggunakan DB Trasaction jika salah satu gagal maka data tidak akan tersimpan
public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama_manajer' => 'required|string|max:255',
        'alamat'       => 'required|string|max:255',
        'no_telepon'   => 'required|string|min:12|max:20',
        'name'         => 'required|string|max:255',
        'email'        => 'required|string|email|max:255|unique:users',
        'password'     => 'required|string|min:8|confirmed',
    ]);

    try {
        $manajer = DB::transaction(function () use ($validatedData) {
            $user = User::create([
                'name'     => $validatedData['name'],
                'email'    => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role'     => 'manajer',
            ]);

            return Manajer::create([
                'nama_manajer' => $validatedData['nama_manajer'],
                'alamat'       => $validatedData['alamat'],
                'no_telepon'   => $validatedData['no_telepon'],
                'id_user'      => $user->id,
            ]);
        });

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Manajer created successfully.',
                'data'    => $manajer->load('user')
            ], 201);
        }

        return redirect()->route('manajer.manajer.index')->with('success', 'Manajer created successfully.');
    } catch (\Exception $e) {
        Log::error('Create manajer failed: '.$e->getMessage());

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create manajer.',
                'error'   => $e->getMessage()
            ], 500);
        }

        return back()->withInput()->withErrors('Gagal membuat manajer: ' . $e->getMessage());
    }
}



public function edit($id, Request $request)
{
    $manajers = Manajer::findOrFail($id);
      if ($request->expectsJson()) {
        return response()->json($manajers);
    }
    return view('pages.manajer.manajer.edit', compact('manajers'));
}

  public function update(Request $request, $id)
  {
      $manajer = Manajer::findOrFail($id);

      $validatedData = $request->validate([
          'nama_manajer' => 'required|string|max:255',
          'alamat' => 'required|string|max:255',
          'no_telepon' => 'required|string|min:12|max:20',
      ]);

      $manajer->update($validatedData);
      if ($request->expectsJson()) {
    return response()->json(['success' => true, 'message' => 'Updated', 'data' => $manajer->load('user')]);
}
return redirect()->route('manajer.manajer.index')->with('success', 'Manajer updated successfully.');

  }
public function updatePassword(Request $request, $id)
{
    $validatedData = $request->validate([
        'password' => 'required|string|min:8|confirmed',
    ]);

    $manajer = Manajer::findOrFail($id);
    $user = $manajer->user;

    $user->update([
        'password' => Hash::make($validatedData['password']),
    ]);

    if ($request->expectsJson()) {
        return response()->json(['success' => true, 'message' => 'Password updated successfully.']);
    }
    return redirect()->route('manajer.manajer.index')->with('success', 'Password updated successfully.');
}

public function destroy(Request $request, $id)
{
    $manajer = Manajer::findOrFail($id);
    $user = User::findOrFail($manajer->id_user);

    $manajer->delete();
    $user->delete();

    if ($request->expectsJson()) {
        return response()->json(['success' => true, 'message' => 'Deleted']);
    }
    return redirect()->route('manajer.manajer.index')->with('success', 'Manajer deleted successfully.');
}
}
