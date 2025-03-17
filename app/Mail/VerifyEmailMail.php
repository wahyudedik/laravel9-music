<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl;

    /**
     * Buat instance baru dari email verifikasi.
     *
     * @param  \App\Models\User  $user
     * @param  string  $verificationUrl
     */
    public function __construct($user, $verificationUrl)
    {
        $this->user = $user;
        $this->verificationUrl = $verificationUrl;
    }

    /**
     * Mendapatkan envelope email.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Verifikasi Email Anda'
        );
    }

    /**
     * Mendapatkan konten email.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'auth.emails.verify-email',
            with: [
                'user' => $this->user,
                'verificationUrl' => $this->verificationUrl
            ]
        );
    }

    /**
     * Mendapatkan lampiran email (jika ada).
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
