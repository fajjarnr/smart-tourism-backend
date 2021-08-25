<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $destination_id = $request->input('destination_id');
        $status = $request->input('status');

        if ($id) {
            $transaction = Transaction::with(['destinations', 'user'])->find($id);

            if ($transaction)
                return ResponseFormatter::success(
                    $transaction,
                    'Data transaksi berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data transaksi tidak ada',
                    404
                );
        }

        $transaction = Transaction::with(['destinations', 'user'])->where('user_id', Auth::user()->id);

        if ($destination_id) {
            $transaction->where('destination_id', $destination_id);
        }

        if ($status) {
            $transaction->where('status', $status);
        }

        return ResponseFormatter::success(
            $transaction->orderBy('id', 'DESC')->get(),
            'Data list transaksi berhasil diambil'
        );
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required',
            'total' => 'required',
            'status' => 'required',
        ]);

        $transaction = new Transaction();
        $transaction->id = Uuid::uuid4()->getHex();
        $transaction->destination_id = $request->destination_id;
        $transaction->user_id = $request->user_id;
        $transaction->quantity = $request->quantity;
        $transaction->total = $request->total;
        $transaction->status = $request->status;
        $transaction->payment_url = '';
        $transaction->save();

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $transaction = Transaction::with(['destinations', 'user'])->find($transaction->id);

        $midtrans = [
            'transaction_details' => [
                'order_id' =>  $transaction->id,
                'gross_amount' => (int) $transaction->total,
            ],
            'customer_details' => [
                'first_name'    => $transaction->user->name,
                'email'         => $transaction->user->email
            ],
            'enabled_payments' => [
                'gopay', "shopeepay", 'bank_transfer', "credit_card", "cimb_clicks",
                "bca_klikbca", "bca_klikpay", "bri_epay", "echannel", "permata_va",
                "bca_va", "bni_va", "bri_va", "other_va", "indomaret",
                "danamon_online", "akulaku"
            ],
            'vtweb' => []
        ];

        try {
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();

            return ResponseFormatter::success($transaction, 'Transaksi berhasil');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 'Transaksi Gagal');
        }
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update($request->all());

        return ResponseFormatter::success($transaction, 'Transaksi berhasil diperbarui');
    }
}
