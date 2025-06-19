<?php

// app/Http/Controllers/DepositController.php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user')->get();
        return view('deposit', compact('deposits'));
    }

   public function admin()
{
    $deposits = Deposit::with('user')->get();
    $products = Product::all(); // ⬅️ Tambahkan ini

    return view('admin', compact('deposits', 'products'));
}

    public function history(){
        $deposits = Deposit::where('user_id', auth()->id())->latest()->get();
        return view('deposit.history', compact('deposits'));
}

     public function store(Request $request) {
        $request->validate([
            'amount' => 'required|integer|min:1000',
            'proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('proof')->store('bukti_deposit', 'public');

        Deposit::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'proof' => $path,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Deposit berhasil dikirim, menunggu konfirmasi admin.');
    }

    public function confirm(Deposit $deposit)
    {
         if ($deposit->status !== 'approved') {
        // Tambahkan ke saldo user
        $user = $deposit->user;
        $user->saldo += $deposit->amount;
        $user->save();

        // Update status deposit
        $deposit->update(['status' => 'approved']);
    }

    return back()->with('success', 'Deposit dikonfirmasi dan saldo ditambahkan.');
 }

    public function reject(Deposit $deposit)
    {
        $deposit->update(['status' => 'rejected']);
        return back()->with('success', 'Deposit ditolak');
    }

    public function destroy(Deposit $deposit)
    {
        $deposit->delete();
        return back()->with('success', 'Deposit dihapus');
    }



}

