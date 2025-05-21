<p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.</p>

<p>
  <a href="{{ url('reset-password/' . $token) . '?email=' . urlencode($email) }}"
     style="padding:8px 16px; background:#6BAADF; color:#fff; text-decoration:none;">
    Reset Password
  </a>
</p>

<p>Jika Anda tidak meminta reset, abaikan saja email ini.</p>
