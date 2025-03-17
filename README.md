1. Landing Page (Tidak bisa play lagu kecuali udah login)
   a. Search (Judul lagu, nama artis)
   b. Lagu popular
   c. Artis popular
   d. Pencipta lagu popular
   e. Cover populer

2. Halaman Login -> Done
   a. Input Email -> Done
   b. Input Password -> Done
   d. Button redirect ke halaman register -> Done
   c. Menggunakan gmail

3. Halaman Register -> Done
   a. Input name -> Done
   b. Input email -> Done
   c. Input password -> Done
   d. Input verfikasi password -> Done
   e. Menggunakan gmail

4. Halaman Reset Password -> Done

5. Halaman Verifikasi Email -> Done

6. Dashboard Super Admin
   a. Button redirect ke landing page
   b. Fitur dashboard (terkait statistic user)
   c. Fitur user crud
   d. Fitur user role permission
   e. Fitur global search
   f. Fitur crud ticketing (Claim lagu dan Unclaim)
   g. Fitur crud list lagu (Detail composer, artis dan cover, lagu belum rilis (notifikasi)) -> filter album
   h. Fitur list crud profile user (Update pengajuan verifikasi akun)
   i. List pengajuan jenis akun => cover, artis, composer (notif)
   j. Fitur verifikasi withdraw

7. Dashboard User
   a. Button redirect ke landing page
   b. Fitur widget dashboard (tergantung level user)
   c. Fitur global search
   d. Fitur profile (MyAsset (Filter lagu dibeli, hasil cover, bagi artis(lagu rilis dan belum rilis), bagi composer(upload lagu, rilis dan belum rilis)))
   e. Fitur Follow/Follower (tag username artis pas create lagu (notif))
   f. Fitur notifikasi (Notif followers, Notif Cover(User artis dan composer), Notif pembelian lisensi)
   g. Komen dan like
   h. Fitur level user
      1. Cover creator
         Syaratnya upload ktp:
         - Fitur button 'cover' di setiap lagu otomatis beli lisensi dan masuk cart
         - Fitur cart
         - Fitur pembayaran dengan midtrans
         - Fitur live chat
         - Fitur wishlist
         - Fitur report (terkait statistic view hasil cover)

      2. Artist
         Syaratnya verifikasi admin / pengajuan menjadi artis dari cover creator:
         - Fitur menu released (daftar lagu yang udah rilis)
         - Fitur menu unrelased (daftar lagu yang belum rilis)
         - Fitur report (+ statistik jumlah pengcover, + statistic jumlah play)

      3. Composer
         Syaratnya upload npwp:
         - Fitur upload lagu
         - Fitur album lagu
         - Fitur tiketing untuk pengajuan claim dan unclaim hak cipta
         - Fitur saldo
         - Fitur withdraw
         - Fitur report (+ statistik penjualan)