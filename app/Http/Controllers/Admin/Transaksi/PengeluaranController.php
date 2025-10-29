<?php

namespace App\Http\Controllers\Admin\Transaksi;

use App\Models\Admin;
use App\Models\Categorie;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PengeluaranController extends Controller
{
    /**
     * Tampilkan halaman index pengeluaran
     */


    public function index(Request $request)
    {
        $admins = Admin::all();
        $categories = Categorie::all();

        if ($request->expectsJson()) {
            return response()->json(['admins' => $admins, 'categories' => $categories]);
        }

        return view('pages.admin.transaksi.pengeluaran.index', compact('admins', 'categories'));
    }

    /**
     * Data untuk DataTables (AJAX)
     */
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $query = Transaction::with(['admin', 'category'])
                ->where('type', 'expense')
                ->select('transactions.*');

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->addColumn('admin_name', function ($m) {
                    return $m->admin->nama_admin ?? '-';
                })
                ->addColumn('category_name', function ($m) {
                    return $m->category->name ?? '-';
                })
                ->addColumn('amount_formatted', function ($m) {
                    return 'Rp ' . number_format($m->amount, 0, ',', '.');
                })
                ->addColumn('action', function ($m) {
                    $editUrl = url('/admin/transaksi/pengeluaran/' . $m->id . '/edit');
                    return '
                        <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                        <button data-id="' . $m->id . '" class="btn btn-sm btn-danger btn-delete">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        abort(400);
    }

    /**
     * Simpan pengeluaran baru
     */
 public function store(Request $request)
{
    $validated = $request->validate([
        'date' => 'required|date',
        'amount' => 'required|numeric|min:0',
        'description' => 'nullable|string|max:1000',
        'category_id' => 'nullable|exists:categories,id',
        'receipt_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
    ]);

    $currentUserId = Auth::id();
    $admin = Admin::where('id_user', $currentUserId)->first();

    if (! $admin) {
        return back()->withInput()->with('error', 'Profil admin tidak ditemukan untuk akun Anda.');
    }

   try {
    DB::beginTransaction();

    $data = [
        'type' => 'expense',
        'date' => $validated['date'],
        'amount' => $validated['amount'],
        'description' => $validated['description'] ?? null,
        'admin_id' => $admin->id,
        'category_id' => $validated['category_id'] ?? null,
    ];

    if ($request->hasFile('receipt_file')) {
        $path = $request->file('receipt_file')->store('receipts', 'public');
        $data['receipt_file'] = $path;
    }

    // Tambahkan ini:
    Log::info('Data sebelum create:', $data);

    $tx = Transaction::create($data);

    DB::commit();

    Log::info('Berhasil simpan transaksi ID: ' . $tx->id);

    return redirect()->route('admin.transaksi.pengeluaran.index')
        ->with('success', 'Pengeluaran berhasil disimpan.');
}
catch (\Exception $e) {
    DB::rollBack();
    Log::error('Error simpan transaksi: ' . $e->getMessage());
    return back()->withInput()->with('error', 'Gagal menyimpan pengeluaran.');
}
}

    /**
     * Edit pengeluaran
     */
    public function edit($id, Request $request)
    {
        $tx = Transaction::with(['admin', 'category'])->findOrFail($id);
        $admins = Admin::all();
        $categories = Categorie::all();

        if ($request->expectsJson()) {
            return response()->json(['data' => $tx, 'admins' => $admins, 'categories' => $categories]);
        }

        return view('pages.admin.transaksi.pengeluaran.edit', compact('tx', 'admins', 'categories'));
    }

    /**
     * Update pengeluaran
     */
    public function update(Request $request, $id)
    {
        $tx = Transaction::findOrFail($id);

        // pastikan admin pemilik sedang login
        $currentUserId = Auth::id();
        $currentAdmin = Admin::where('id_user', $currentUserId)->first();
        if (! $currentAdmin) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Profil admin tidak ditemukan untuk user ini.'], 403);
            }
            return back()->with('error', 'Profil admin tidak ditemukan untuk akun Anda.');
        }

        // optional: hanya pemilik admin yang boleh mengubah transaksi ini
        if ($tx->admin_id !== $currentAdmin->id) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Anda tidak berwenang mengubah data ini.'], 403);
            }
            abort(403, 'Anda tidak berwenang mengubah data ini.');
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'nullable|exists:categories,id',
            'receipt_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        try {
            DB::beginTransaction();

            $tx->date = $validated['date'];
            $tx->amount = $validated['amount'];
            $tx->description = $validated['description'] ?? null;
            // tetap gunakan admin yang login (jika ingin mengizinkan pindah admin, ubah logika ini)
            $tx->admin_id = $currentAdmin->id;
            $tx->category_id = $validated['category_id'] ?? null;

            if ($request->hasFile('receipt_file')) {
                // hapus file lama jika ada
                if ($tx->receipt_file && Storage::disk('public')->exists($tx->receipt_file)) {
                    Storage::disk('public')->delete($tx->receipt_file);
                }
                $path = $request->file('receipt_file')->store('receipts', 'public');
                $tx->receipt_file = $path;
            }

            $tx->save();

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Pengeluaran berhasil diperbarui.', 'data' => $tx]);
            }

            return redirect()->route('admin.transaksi.pengeluaran.index')->with('success', 'Pengeluaran berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Gagal memperbarui pengeluaran.'], 500);
            }
            return back()->withInput()->with('error', 'Gagal memperbarui pengeluaran.');
        }
    }

    /**
     * Hapus pengeluaran
     */
    public function destroy(Request $request, $id)
    {
        $tx = Transaction::findOrFail($id);

        // pastikan admin pemilik sedang login
        $currentUserId = Auth::id();
        $currentAdmin = Admin::where('id_user', $currentUserId)->first();
        if (! $currentAdmin) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Profil admin tidak ditemukan untuk user ini.'], 403);
            }
            return back()->with('error', 'Profil admin tidak ditemukan untuk akun Anda.');
        }

        // hanya pemilik admin yang boleh menghapus
        if ($tx->admin_id !== $currentAdmin->id) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Anda tidak berwenang menghapus data ini.'], 403);
            }
            abort(403, 'Anda tidak berwenang menghapus data ini.');
        }

        try {
            DB::beginTransaction();

            if ($tx->receipt_file && Storage::disk('public')->exists($tx->receipt_file)) {
                Storage::disk('public')->delete($tx->receipt_file);
            }

            $tx->delete();

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Pengeluaran dihapus.']);
            }

            return redirect()->route('admin.transaksi.pengeluaran.index')->with('success', 'Pengeluaran dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus pengeluaran.'], 500);
            }
            return back()->with('error', 'Gagal menghapus pengeluaran.');
        }
    }
}
