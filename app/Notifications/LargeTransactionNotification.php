<?php

namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class LargeTransactionNotification extends Notification
{
  use Queueable;

    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

   public function toMail($notifiable)
{
    $t = $this->transaction;

    $mail = (new MailMessage)
        ->subject('Transaksi Besar Terdeteksi: Rp '.number_format($t->amount,0,',','.'))
        ->line('Terdapat transaksi dengan jumlah besar.')
        ->line('Tipe: ' . ucfirst($t->type))
        ->line('Jumlah: Rp '. number_format($t->amount,0,',','.'))
        ->line('Deskripsi: ' . ($t->description ?? '-'))
        ->action('Lihat Transaksi', url("/transactions/{$t->id}"))
        ->line('Mohon ditindaklanjuti oleh tim manajer.');

    // lampirkan file jika ada
    if ($t->receipt_file && Storage::disk('public')->exists($t->receipt_file)) {
        $path = Storage::disk('public')->path($t->receipt_file);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $mail->attach($path, [
            'as' => 'receipt_'.$t->id.'.'.$extension,
            'mime' => Storage::disk('public')->mimeType($t->receipt_file) 
        ]);
    }

    return $mail;
}
}
