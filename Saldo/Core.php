

<?php
   //=====================================================START====================//

   /*

   Core.php
   Edit hanya textnya saja
    */

   //=====================================================START SCRIPT====================//

   date_default_timezone_set('Asia/Jakarta');
   include 'src/FrameBot.php';
   require_once '../config/system.conn.php';
   $mkbot = new FrameBot($token, $usernamebot);
   require_once '../config/system.byte.php';
   require_once '../Api/routeros_api.class.php';

   //Any commands akan di cegah dengan ini jika  perlu silahakan dihapus /* dan  */

   /*
   $mkbot->cmd('*', 'Maaf commands tidak tersedia');
    */

   //Start commands
   $mkbot->cmd('/start|/Start', function () {
      include ('../config/system.conn.php');
      $info         = bot::message();
      $ids          = $info['chat']['id'];
      $msgid        = $info['message_id'];
      $nametelegram = $info['from']['username'];
      $idtelegram   = $info['from']['id'];
      Bot::sendChatAction('typing');

      if (has($idtelegram) == false) {

         $text = "";
         //Ubah text dibawah ini untuk user yang belum terdaftar
        $text = "Selamat datang di Layanan \n";
        $text .= "<b>$namabot</b> \n\n";
        $text .= "<b>$namabot</b> berfungsi untuk\n";
        $text .= "Pembelian Voucher WiFi/Hotspot \n";
        $text .= "Dengan Sistem Otomatis 24 Jam.\n\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/daftar) untuk Pedaftaran Pengguna Baru.\n";
         $options = [
            'parse_mode' => 'html'
         ];
         return Bot::sendMessage($text, $options);
      } else {
         $text = "";

         //ubah text ini untuk user yang sudah terdaftar
        $text  = "Hello <b>@$nametelegram</b>\n";
        $text .= "Ada yang bisa kami bantu?\n\n";
        $text .= "Untuk informasi bantuan\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Saldo Anda.\n";
      }

      $options = [
         'parse_mode' => 'html'
      ];

      return Bot::sendMessage($text, $options);
   });
   //deposit commands
   $mkbot->cmd('/deposit|/Deposit', function ($jumlah) {
      include ('../config/system.conn.php');
      $info         = bot::message();
      $ids          = $info['chat']['id'];
      $msgid        = $info['message_id'];
      $nametelegram = $info['from']['username'];
      $idtelegram   = $info['from']['id'];
      
      $text         = "";

      if (!empty($jumlah)) {
         if (has($idtelegram) == false) {
            //jika user belum terdaftar
                $text = "Maaf Akun Telegram anda belum terdaftar diserver kami silahkan ketik (/daftar) terlebih dahulu sebelum request deposit saldo.\n\n";
                $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
                $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
                $text .= "Klik (/deposit) untuk menambah Saldo Anda.\n";
         } else {
            if (preg_match('/^[0-9]+$/', $jumlah)) {
                //    if (strlen($jumlah) < 7) {
                    if (($jumlah) < 500001) {
                  //jika user belum terdaftar
                  $text .= "Terima kasih @$nametelegram \nPermintaan deposit sebesar " . rupiah($jumlah) . " sudah kami terima, dan akan kami proses.\nSilahkan kirimkan foto bukti pembayaran  disertai dengan Caption :\n #konfirmasi deposit $jumlah \n\nKonfirmasi selambat-lambatnya 2 jam setelah permintaan deposit berhasil.\n\n";
                  $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
                  $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
                  $text .= "Klik (/deposit) untuk menambah Saldo Anda.\n";
                  $textsend = "";
                  $textsend .= "<code>User :  </code>@$nametelegram \n";
                  $textsend .= "<code>ID   : </code> <code>$idtelegram </code>\n";
                  $textsend .= "<code>Request pengisian saldo </code>\n";
                  $textsend .= "<code>Nominal :" . rupiah($jumlah) . "</code>\n";
                  $textsend .= "<code>Silahkan tindak lanjuti \nAtau Hubungi user </code> @$nametelegram \n\n";
                  $textsend .= "Dengan Menekan tombol dibawah ini saldo user otomatis terisi  ";

                  //-===================rubah texnya saja ya
                  $kirimpelangan = [
                     'chat_id' => $id_own,
                     'reply_markup' => json_encode([
                        'inline_keyboard' => [
                        //   [
                        //      ['text' => 'QUICK TOP UP', 'callback_data' => '12'],
                        //   ],
                           [
                              ['text' => '' . rupiah($jumlah) . '', 'callback_data' => 'tp|' . $jumlah . '|' . $idtelegram . '|' . $nametelegram . ''],
                           ],
                        //   [
                        //      ['text' => 'OR COSTUM', 'callback_data' => '12'],
                        //   ],
                           [
                              ['text' => 'Rp.10.000', 'callback_data' => 'tp|10000|' . $idtelegram . '|' . $nametelegram . ''],
                              ['text' => 'Rp.15.000', 'callback_data' => 'tp|15000|' . $idtelegram . '|' . $nametelegram . ''],
                              ['text' => 'Rp.20.000', 'callback_data' => 'tp|20000|' . $idtelegram . '|' . $nametelegram . ''],
                           ],
                           [

                              ['text' => 'Rp.25.000', 'callback_data' => 'tp|25000|' . $idtelegram . '|' . $nametelegram . ''],
                              ['text' => 'Rp.30.000', 'callback_data' => 'tp|30000|' . $idtelegram . '|' . $nametelegram . ''],
                              ['text' => 'Rp.50.000', 'callback_data' => 'tp|50000|' . $idtelegram . '|' . $nametelegram . ''],
                           ],
                           [

                              ['text' => 'Rp.100.000', 'callback_data' => 'tp|100000|' . $idtelegram . '|' . $nametelegram . ''],
                              ['text' => 'Rp.150.000', 'callback_data' => 'tp|150000|' . $idtelegram . '|' . $nametelegram . ''],
                              ['text' => 'Rp.200.000', 'callback_data' => 'tp|200000|' . $idtelegram . '|' . $nametelegram . ''],
                           ],

                        ]]),
                     'parse_mode' => 'html'

                  ];

                  Bot::sendMessage($textsend, $kirimpelangan);
               } else {
                  $text = 'Maaf Maksimal Deposit Rp 500.000,-';
               }
            } else {
               $text = 'Maaf input Nominal saldo hanya berupa angka saja';
            }
         }
      } else {
         $text .= "Perintah ini di gunakan untuk Request Deposit Saldo kepada Adminstator \n";
         $text .= "Anda dapat  Custom Request Deposit dengan cara \n";
         $text .= "/deposit (nominal)\n";
         $text .= "Contoh\n";
         $text .= "/deposit 10000 \n";
         $text .= "Atau menekan tombol dibawah ini \n";
         $options = [
            'reply_markup' => json_encode([
               'inline_keyboard' => [
                //  [
                //     ['text' => '⬇ REQUEST ⬇', 'callback_data' => '12'],
                //  ],
                  [
                     ['text' => 'Rp.10.000', 'callback_data' => 'tps|10000'],
                     ['text' => 'Rp.15.000', 'callback_data' => 'tps|15000'],
                     ['text' => 'Rp.20.000', 'callback_data' => 'tps|20000'],
                  ],
                  [

                     ['text' => 'Rp.25.000', 'callback_data' => 'tps|25000'],
                     ['text' => 'Rp.30.000', 'callback_data' => 'tps|30000'],
                     ['text' => 'Rp.50.000', 'callback_data' => 'tps|50000'],
                  ],
                  [

                     ['text' => 'Rp.100.000', 'callback_data' => 'tps|100000'],
                     ['text' => 'Rp.150.000', 'callback_data' => 'tps|150000'],
                     ['text' => 'Rp.200.000', 'callback_data' => 'tps|200000'],
                  ],

               ]]),
            'parse_mode' => 'html'

         ];
      }

      return Bot::sendMessage($text, $options);
   });
   //cekid commands
   $mkbot->cmd('/cekid|/Cekid', function ($jumlah) {
      include ('../config/system.conn.php');
      $info   = bot::message();
      $iduser = $info['from']['id'];
      $msgid  = $info['message_id'];
      $name   = $info['from']['username'];
      $id     = $info['from']['id'];

      if (has($id) == false) {
         $text = "<code>    Informasi ID Anda</code>\n";
         $text .= "<code>========================</code>\n";
         $text .= "<code>  ID User  :</code> <code>$id</code>\n";
         $text .= "<code>  Username :</code> @$name\n";
         $text .= "<code>  Status   : - </code>\n";
         $text .= "<code>========================</code>\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
      } else {
         $text = "<code>    Informasi ID Anda</code>\n";
         $text .= "<code>========================</code>\n";
         $text .= "<code>  ID User  : </code> <code>$id</code>\n";
         $text .= "<code>  Username : </code> @$name\n";
         $text .= "<code>  Status   : Terdaftar </code>\n";
         $text .= "<code>========================</code>\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
      }

      $options = [
         'parse_mode' => 'html'
      ];
      return Bot::sendMessage($text, $options);
   });
   //daftar commands
   $mkbot->cmd('/daftar', function () {
      include ('../config/system.conn.php');
      $info         = bot::message();
      $msgid        = $info['message_id'];
      $nametelegram = $info['from']['username'];
      $idtelegram   = $info['from']['id'];

      Bot::sendChatAction('typing');
      $ids = $info['chat']['id'];

      if (empty($nametelegram)) {
        $text  = "Maaf Akun Telegram anda belum terdaftar diserver kami silahkan ketik (/daftar) terlebih dahulu.\n\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
      } else {

         if (has($idtelegram) == false) {
            $cek = daftar($idtelegram, $nametelegram);

            if (empty($cek)) {
                $text .= "Mohon Maaf system kami mengalami gangguan silahkan hubungi Adminstator untuk reservasi layanan ini\n\n";
                $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
                $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
                $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
            } else {
               $text .= "<code>  PENDAFTARAN BERHASIL   </code>\n";
               $text .= "<code>========================</code>\n";
               $text .= "<code>  ID User  :</code> <code>$idtelegram</code>\n";
               $text .= "<code>  Username :</code> @$nametelegram\n";
               $text .= "<code>  Status   : Terdaftar </code>\n";
                $text .= "<code> Saldo    : " . rupiah($angka) . "</code>\n";
               $text .= "<code>========================</code>\n";
               $text .= "Silahkan Isi saldo anda Di outlet kami 😊 \n\n";
               $text .= "Terima kasih atas kepercayaan anda mengunakan layanan kami\n\n";
                $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
                $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
                $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
            }
         } else {
            $text .= "Maaf Anda sudah terdaftar dalam server kami\n\n";
            $text .= "<code>   Informasi ID Anda</code>\n";
            $text .= "<code>========================</code>\n";
            $text .= "<code> ID User  : </code> <code>$idtelegram</code>\n";
            $text .= "<code> Username : </code> @$nametelegram\n";
            $text .= "<code> Status   : Terdaftar </code>\n";
            $text .= "<code> Saldo    : " . rupiah($angka) . "</code>\n";
            $text .= "<code>========================</code>\n\n";
            $text .= "Silahkan Isi saldo anda Di Outlet kami ðŸ˜Š \n\n";
            $text .= "Terima kasih atas kepercayaan anda mengunakan layanan kami\n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
         }
      }

      $options = [
         'parse_mode' => 'html'
      ];
      return Bot::sendMessage($text, $options);
   });
   //help commands
   $mkbot->cmd('/help|!Help', function ($id, $name, $notlp, $saldo) {
      include ('../config/system.conn.php');
      $info         = bot::message();
      $msgid        = $info['message_id'];
      $nametelegram = $info['from']['username'];
      $idtelegram   = $info['from']['id'];
      Bot::sendChatAction('typing');

      if ($idtelegram == $id_own) {
     $text .= "======= User Commands =======\n";
     $text .= "[/menu] - Menu Layanan\n";
     $text .= "[/daftar] - Pendaftaran User Baru\n";
     $text .= "[/ceksaldo] - Cek Saldo Anda\n";
     $text .= "[/deposit] - Permintaan Deposit Saldo\n";
     $text .= "[/cekid] - Status user\n";
     $text .= "[/qrcode] - Terjemahkan QRCODE\n\n";
     $text .= "======= Admin Commands =======\n\n";
     $text .= "[/dbg] - Debug Message\n";
     $text .= "[/topdown id nominal] - Mengurangi Jumlah Saldo User\n";
     $text .= "[/topup id nominal] - TOPUP SALDO USER\n";
     $text .= "[/hotspot] - Hotspot Monitor\n";
     $text .= "[/resource] - Resource Router\n";
     $text .= "[/netwatch] - Netwatch Router\n";
     $text .= "[/report] - Report Pendapatan\n";
     $text .= "[/user id] - Melihat Detail User Hotspot\n";
     $text .= "[/daftarid noid username notlpn saldo] - Daftar User Manual\n";
      } else {
     $text .= "[/menu] - Menu Layanan\n";
     $text .= "[/daftar] - Pendaftaran User Baru\n";
     $text .= "[/ceksaldo] - Cek Saldo Anda\n";
     $text .= "[/deposit] - Permintaan Deposit Saldo\n";
     $text .= "[/cekid] - Status User\n";
     $text .= "[/qrcode] - Terjemahkan QRCODE\n";
      }

      $optionss = ['parse_mode' => 'html', ];
      Bot::sendMessage($text, $optionss);
   });
   //daftar manual khusus Administator
   $mkbot->cmd('/daftarid', function ($id, $name, $notlp, $saldo) {
      include ('../config/system.conn.php');
      $info         = bot::message();
      $msgid        = $info['message_id'];
      $nametelegram = $info['from']['username'];
      $idtelegram   = $info['from']['id'];
      Bot::sendChatAction('typing');

      if ($idtelegram == $id_own) {
         if (empty($id) && empty($name) && empty($notlp) && empty($saldo)) {
            $text = "Maaf Format anda salah \n\nMohon masukan format dengan benar \n\nFormat : \n[/daftar noid namauser notlpn saldo]\n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
         } else {

            $lihat = lihatuser($id);

            if (empty($lihat)) {
               $text = daftarid($id, $name, $notlp, $saldo);
            } else {
               $text = "User sudah terdaftar periksa kembali \n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
            }
         }
      } else {

         $text = "Maaf..! Aksess Hanya untuk Administator\n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
      }

      $options = [
         'parse_mode' => 'html'
      ];
      return Bot::sendMessage($text, $options);
   });
   //topdown khusus Administator
   $mkbot->cmd('/topdown', function ($id, $jumlahan) {
      $info       = bot::message();
      $msgid      = $info['message_id'];
      $name       = $info['from']['username'];
      $idtelegram = $info['from']['id'];
      include ('../config/system.conn.php');

      if ($idtelegram == $id_own) {
         if (!empty($id) && !empty($jumlahan)) {
            if (has($id) == false) {
               $text = "Data id tidak terdaftar silahkan periksa kembali\n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
            } else {

               if (preg_match('/^[0-9]+$/', $jumlahan)) {
                //    if (strlen($jumlah) < 7) {
                    if (($jumlah) < 500001) {
                     $topdown = topdown($id, $jumlahan);
                     $text    = "<code>     Informasi Refund</code>\n";
                     $text .= "<code>========================</code>\n";
                     $text .= "<code>  ID User     : $id</code>\n";
                     $text .= "<code>  Saldo akhir : " . lihatsaldo($id) . "</code>\n";
                     $text .= "<code>Penarikan saldo berhasil</code>\n";
                  } else {
                     $text = "Maaf Maksimal Refund Rp 500.000,-\n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
                  }
               } else {
                  $text = "Maaf input saldo hanya berupa angka saja\n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
               }
            }
         } else {
            $text = "Maaf format anda salah /topdown (id) (jumlah)\n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
         }
      } else {
         $text = "Maaf..! Aksess Hanya untuk Administator\n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
      }

      $optionss = ['parse_mode' => 'html', ];
      Bot::sendMessage($text, $optionss);
   });
   //topup khusus Administator
   $mkbot->cmd('/topup', function ($id, $jumlah) {

      $info       = bot::message();
      $msgid      = $info['message_id'];
      $name       = $info['from']['username'];
      $idtelegram = $info['from']['id'];
      Bot::sendChatAction('typing');
      include ('../config/system.conn.php');

      if ($idtelegram == $id_own) {
         if (!empty($id) && !empty($jumlah)) {
            if (has($id) == false) {
               $text = 'Data id tidak terdaftar silahkan periksa kembali';
            } else {

               if (preg_match('/^[0-9]+$/', $jumlah)) {
                //    if (strlen($jumlah) < 7) {
                    if (($jumlah) < 500001) {
                     $text = topupresseller($id, $name, $jumlah, $id_own);

                     $kirimpelangan = [
                        'chat_id' => $id,
                        'reply_markup' => json_encode([
                           'inline_keyboard' => [
                              [
                                 ['text' => '🔎 Beli Voucher', 'callback_data' => 'Menu'],
                                 ['text' => '📛 Promo Hot', 'callback_data' => 'informasi'],
                              ], ]]),
                        'parse_mode' => 'html'

                     ];
                     Bot::sendMessage($text, $kirimpelangan);
                  } else {
                     $text = "Maaf Maksimal Deposit Rp 500.000,-\n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
                  }
               } else {
                  $text = "Maaf input saldo hanya berupa angka saja\n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
               }
            }
         } else {
            $text = "Maaf format anda salah /topup (id) (jumlah)\n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
         }
      } else {
         $text = "Maaf..! Aksess Hanya untuk Administator\n\n";
            $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
            $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
            $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
      }

      $options = [
         'parse_mode' => 'html'
      ];
      return Bot::sendMessage($text, $options);
   });
   //lihatsaldo commands
   $mkbot->cmd('/lihatsaldo|/ceksaldo', function ($jumlah) {
      include ('../config/system.conn.php');
      $info   = bot::message();
      $iduser = $info['from']['id'];
      $msgid  = $info['message_id'];
      $name   = $info['from']['username'];
      $id     = $info['from']['id'];
      $lihat  = lihatuser($id);
      $ids    = $info['chat']['id'];

      if (empty($lihat)) {
        $text  = "Maaf Akun Telegram anda belum terdaftar diserver kami silahkan ketik (/daftar) terlebih dahulu.\n\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
      } else {
         $angka = lihatsaldo($id);
         $text  = "<code>      Informasi Saldo</code>\n";
         $text .= "<code>========================</code>\n";
         $text .= "<code>  ID User : $id</code>\n";
         $text .= "<code>  Name    : $name</code>\n";
         $text .= "<code>  Saldo   : " . rupiah($angka) . "</code>\n";
         $text .= "<code>========================</code>\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
      }

      $options = [
         'parse_mode' => 'html'
      ];
      return Bot::sendMessage($text, $options);
   });
   //resource commands
   $mkbot->cmd('/resource|/Resource', function () {

      $info         = bot::message();
      $msgid        = $info['message_id'];
      $nametelegram = $info['from']['username'];
      $idtelegram   = $info['from']['id'];
      Bot::sendChatAction('typing');

      include ('../config/system.conn.php');

      if ($idtelegram == $id_own) {
         $API = new routeros_api();

         if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $jambu         = $API->comm("/system/health/print");
            $dhealth       = $jambu['0'];
            $ARRAY         = $API->comm("/system/resource/print");
            $jeruk         = $ARRAY['0'];
            $memperc       = ($jeruk['free-memory'] / $jeruk['total-memory']);
            $hddperc       = ($jeruk['free-hdd-space'] / $jeruk['total-hdd-space']);
            $mem           = ($memperc * 100);
            $hdd           = ($hddperc * 100);
            $sehat         = $dhealth['temperature'];
            $platform      = $jeruk['platform'];
            $board         = $jeruk['board-name'];
            $version       = $jeruk['version'];
            $architecture  = $jeruk['architecture-name'];
            $cpu           = $jeruk['cpu'];
            $cpuload       = $jeruk['cpu-load'];
            $uptime        = $jeruk['uptime'];
            $cpufreq       = $jeruk['cpu-frequency'];
            $cpucount      = $jeruk['cpu-count'];
            $memory        = formatBytes($jeruk['total-memory']);
            $fremem        = formatBytes($jeruk['free-memory']);
            $mempersen     = number_format($mem, 3);
            $hdd           = formatBytes($jeruk['total-hdd-space']);
            $frehdd        = formatBytes($jeruk['free-hdd-space']);
            $hddpersen     = number_format($hdd, 3);
            $sector        = $jeruk['write-sect-total'];
            $setelahreboot = $jeruk['write-sect-since-reboot'];
            $kerusakan     = $jeruk['bad-blocks'];
            $text .= "";
            $text .= "📡<b> Resource</b>  $sehat C\n";
            $text .= "<code>Boardname: $board</code>\n";
            $text .= "<code>Platform : $platform</code>\n";
            $text .= "<code>Uptime is: " . formatDTM($uptime) . "</code>\n";
            $text .= "<code>Cpu Load : $cpuload%</code>\n";
            $text .= "<code>Cpu type : $cpu</code>\n";
            $text .= "<code>Cpu Hz   : $cpufreq Mhz/$cpucount core</code>\n==========================\n";
            $text .= "<code>Free memory and memory \n$memory-$fremem/$mempersen %</code>\n==========================\n";
            $text .= "<code>Free disk and disk      \n$hdd-$frehdd/$hddpersen %</code>\n==========================\n";
            $text .= "<code>Since reboot, bad blocks \n$sector-$setelahreboot/$kerusakan%</code>\n==========================\n";
         }
      } else {
         $text = "Maaf..! Aksess Hanya untuk Adminstator\n\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
      }

      $options = ['parse_mode' => 'html', ];
      Bot::sendMessage($text, $options);
   });
   //Hotspot commands khusus Adminstator
   $mkbot->cmd('!Hotspot|?hotspot|/hotspot|/Hotspot|!Hotspot', function ($user, $telo) {

      $info         = bot::message();
      $msgid        = $info['message_id'];
      $nametelegram = $info['from']['username'];
      $idtelegram   = $info['from']['id'];
      Bot::sendChatAction('typing');

      include ('../config/system.conn.php');

      if ($idtelegram == $id_own) {
         $API = new routeros_api();

         if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            if ($user == 'aktif') {
               if ($telo != "") {
                  $pepaya = $API->comm("/ip/hotspot/active/print", ["?server" => "" . $telo . ""]);
                  $anggur = count($pepaya);
                  $apel   = $API->comm("/ip/hotspot/active/print", ["count-only" => "", "?server" => "" . $telo . ""]);
               } else {
                  $pepaya = $API->comm("/ip/hotspot/active/print");
                  $anggur = count($pepaya);
                  $apel   = $API->comm("/ip/hotspot/active/print", ["count-only" => "", ]);
               }

               $text .= "User Aktif $apel item\n\n";

               for ($i = 0; $i < $anggur; $i++) {
                  $mangga    = $pepaya[$i];
                  $id        = $mangga['.id'];
                  $server    = $mangga['server'];
                  $user      = $mangga['user'];
                  $address   = $mangga['address'];
                  $mac       = $mangga['mac-address'];
                  $uptime    = $mangga['uptime'];
                  $usesstime = $mangga['session-time-left'];
                  $bytesi    = formatBytes($mangga['bytes-in'], 2);
                  $byteso    = formatBytes($mangga['bytes-out'], 2);
                  $loginby   = $mangga['login-by'];
                  $comment   = $mangga['comment'];
                  $text .= "";
                  $text .= "👤 User aktif\n";
                  $text .= "┠ ID :$id\n";
                  $text .= "┠ User  : $user\n";
                  $text .= "┠ IP    : $address\n";
                  $text .= "┠ Uptime : $uptime\n";
                  $text .= "┠ Byte IN      : $bytesi\n";
                  $text .= "┠ Byte OUT   : $byteso\n";
                  $text .= "┠ Sesion  : $usesstime\n";
                  $text .= "┗ Login    : $loginby\n \n";
                  $text .= "/see_$server\n \n";
               }

               $arr2       = str_split($text, 4000);
               $amount_gen = count($arr2);

               for ($i = 0; $i < $amount_gen; $i++) {
                  $texta = $arr2[$i];
                  Bot::sendMessage($texta);
               }
            } elseif ($user == 'user') {
               $ARRAY = $API->comm("/ip/hotspot/user/print");
               $num   = count($ARRAY);
               $text  = "Total $num User\n\n";

               for ($i = 0; $i < $num; $i++) {
                  $no     = $i;
                  $data   = $ARRAY[$i]['.id'];
                  $dataid = str_replace('*', 'id', $data);
                  $server = $ARRAY[$i]['server'];
                  $name   = $ARRAY[$i]['name'];
                  $data3  = $ARRAY[$i]['password'];
                  $data4  = $ARRAY[$i]['mac-address'];
                  $data5  = $ARRAY[$i]['profile'];
                  $data6  = $ARRAY[$i]['limit-uptime'];
                  $text .= "";
                  $text .= "👥  ($dataid)\n";
                  $text .= "┣Nama : $name\n";
                  $text .= "┣password : $data3 \n";
                  $text .= "┣mac : $data4\n";
                  $text .= "┣Profil : $data5\n\n";
                  $text .= "┗RemoveNow User /rEm0v$dataid\n\n";
               }

               $arr2       = str_split($text, 4000);
               $amount_gen = count($arr2);

               for ($i = 0; $i < $amount_gen; $i++) {
                  $texta = $arr2[$i];

                  Bot::sendMessage($texta);
               }
            } else {
               $text .= "";
               $text = "User list or aktif\n";
               $text .= "Filter by server\n";
               $serverhot = $API->comm('/ip/hotspot/print');

               foreach ($serverhot as $index => $jambu) {
                  $sapubasah      = str_replace('-', '0', $jambu['name']);
                  $sapubasahbasah = str_replace(' ', '11', $sapubasah);

                  $text .= "/see_" . $sapubasahbasah . "\n";
               }

               $keyboard    = [['!Hotspot user', '!Hotspot aktif'], ['!Menu', '!Help'], ['!Hide'], ];
               $replyMarkup = ['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true];
               $options     = [
                  'reply' => true,
                  'reply_markup' => json_encode($replyMarkup),
               ];
               Bot::sendMessage($text, $options);
            }
         } else {
            $text    = "Tidak dapat Terhubung dengan Mikrotik Coba Kembali\n\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
            $options = [
               'reply' => true,
            ];
            Bot::sendMessage($text, $options);
         }
      } else {
         $denid = "Maaf..! Aksess Hanya untuk Administator\n\n";
        $denid .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $denid .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $denid .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
         Bot::sendMessage($denid);
      }
   });
   //User commands khusus Administator
   $mkbot->cmd('?hs|!User|?user|!user|', function ($name) {

      $info         = bot::message();
      $msgid        = $info['message_id'];
      $nametelegram = $info['from']['username'];
      $idtelegram   = $info['from']['id'];
      Bot::sendChatAction('typing');

      include ('../config/system.conn.php');

      if ($idtelegram == $id_own) {
         $API = new routeros_api();

         if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $ARRAY = $API->comm("/ip/hotspot/user/print", ["?name" => $name, ]);
            $get   = $API->comm("/system/scheduler/print", ["?name" => $name, ]);

            if (empty($ARRAY)) {
               $texta = "User tidak ditemukan...\n\n";
        $texta .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $texta .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $texta .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
            } else {

               foreach ($ARRAY as $index => $baris) {
                  $text = "";
                  $text .= "Hotspot Client";
                  $text .= "\n=======================\n";
                  $text .= "Nama     :" . $baris['name'] . "\n";
                  $text .= "Password :" . $baris['password'] . "\n";
                  $text .= "Limit    :" . $baris['limit-uptime'] . "\n";
                  $text .= "Uptime   :" . formatDTM($baris['uptime']) . "\n";
                  $text .= "Upload   :" . formatBytes($baris['bytes-in']) . "\n";
                  $text .= "Downlaod :" . formatBytes($baris['bytes-out']) . "\n";
                  $text .= "Profil   :" . $baris['profile'] . "\n";
                  $data   = $baris['.id'];
                  $dataid = str_replace('*', 'id', $data);
               }

               foreach ($get as $index => $baris) {
                  $experid = "";
                  $experid .= "Start-time : <b>" . $baris['start-date'] . " " . $baris['start-time'] . "</b>\n";
                  $experid .= "Interval   : <b>" . $baris['interval'] . "</b>\n";
                  $experid .= "expired    : <b>" . $baris['next-run'] . "</b>\n<code>=======================</code>\n";
               }

               $texta = "<code>" . $text . "</code>$experid\nRemove User /rEm0v$dataid\n\n";
            }
         }

         $options = ['parse_mode' => 'html', ];
         Bot::sendMessage($texta, $options);
      } else {
         $denid = "Maaf..! Aksess Hanya untuk Administator\n\n";
        $denid .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $denid .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $denid .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
         Bot::sendMessage($denid);
      }
   });
   //report commands khusus Administator
   $mkbot->cmd('/report', function ($name) {
      $info   = bot::message();
      $id     = $info['chat']['id'];
      $iduser = $info['from']['id'];
      $msgid  = $info['message_id'];
      Bot::sendChatAction('typing');

      if ($idtelegram == $id_own) {
         $text .= "<code>      " . date('d-m-Y') . "</code>\n";
         $text .= "=========================\n";
         $text .= "Total Voucher Bulan ini\n";
         $text .= "" . countvoucher() . " Voucher\n";
         $text .= "=========================\n";
         $text .= "Top up Debit Bulan ini\n";
         $text .= "" . rupiah(getcounttopup()) . "\n";
         $text .= "=========================\n";
         $text .= "Mutasi Voucher Bulan ini\n";
         $text .= "" . rupiah(estimasidata()) . "\n";
         $text .= "=========================\n";
         $text .= "User + Bulan ini\n";
         $text .= "+ " . countuser() . " User\n";
         $text .= "=========================\n";
      } else {
         $text = "Maaf..! Aksess Hanya untuk Administator\n\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
      }

      $options = [
         'parse_mode' => 'html',
      ];
      Bot::sendMessage($text, $options);
   });
   //netwatch commands khusus Administator
   $mkbot->cmd('/netwatch|/Netwatch', function () {
      $info         = bot::message();
      $msgid        = $info['message_id'];
      $nametelegram = $info['from']['username'];
      $idtelegram   = $info['from']['id'];
      Bot::sendChatAction('typing');

      include ('../config/system.conn.php');

      if ($idtelegram == $id_own) {
         $API = new routeros_api();

         if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $ARRAY = $API->comm("/tool/netwatch/print");
            $num   = count($ARRAY);
            $text .= "Daftar Host Netwatch $num\n\n";

            for ($i = 0; $i < $num; $i++) {
               $no       = $i + 1;
               $host     = $ARRAY[$i]['host'];
               $interval = $ARRAY[$i]['interval'];
               $timeout  = $ARRAY[$i]['timeout'];
               $status   = $ARRAY[$i]['status'];
               $since    = $ARRAY[$i]['since'];
               $text .= "📝 Netwatch$no\n";
               $text .= "┠ Host : $host \n";

               if ($status == "up") {
                  $text .= "┠ Status : ✔ UP \n";
               } else {
                  $text .= "┠ Status : ⚠ Down \n";
               }

               $text .= "┗ Since : $since \n\n";
            }
         } else {
            $text = "Tidak dapat Terhubung dengan Mikrotik Coba Kembali\n\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
         }

         $arr2       = str_split($text, 4000);
         $amount_gen = count($arr2);

         for ($i = 0; $i < $amount_gen; $i++) {
            $texta   = $arr2[$i];
            $options = ['parse_mode' => 'html'];
            Bot::sendMessage($arr2[$i], $options);
         }
      } else {
         $text = "Maaf..! Aksess Hanya untuk Administator\n\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
         Bot::sendMessage($text);
      }
   });
   //debug message semua
   $mkbot->cmd('/dbg', function ($pesan) {
      $info    = bot::message();
      $id      = $info['chat']['id'];
      $text    = "<code>" . json_encode($info, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</code>";
      $options = ['parse_mode' => 'html', ];
      return Bot::sendMessage($text, $options);
   });
   //qrcode terjemah qrcode
   $mkbot->cmd('/qrcode', function () {
      include ('../config/system.conn.php');
      $info        = bot::message();
      $ambilgambar = $info['reply_to_message']['photo'][0]['file_id'];

      if (empty($ambilgambar)) {
         $text = "Balas Gambar/foto QRcode";
         Bot::sendMessage($text);
      } else {
         $cek           = Bot::getFile($ambilgambar);
         $hasilkirimaaa = json_decode($cek, true);
         $hasilurl      = $hasilkirimaaa['result']['file_path'];
         $urlkirim      = 'http://api.qrserver.com/v1/read-qr-code/?fileurl=https://api.telegram.org/file/bot' . $token . '/' . $hasilurl;
         $hasilurla     = file_get_contents($urlkirim);
         $hasilkirim    = json_decode($hasilurla, true);
         $terjemah      = "Hasil Scan QRCODE \n " . $hasilkirim[0]['symbol'][0]['data'];
         return Bot::sendMessage($terjemah);
      }
   });
   //see_ melihat user aktif
   $mkbot->regex('/^\/see_/', function ($matches) {
      $info         = bot::message();
      $msgid        = $info['message_id'];
      $nametelegram = $info['from']['username'];
      $idtelegram   = $info['from']['id'];
      $isipesan     = $info['text'];
      Bot::sendChatAction('typing');
      include ('../config/system.conn.php');

      if ($idtelegram == $id_own) {
         if ($isi == '/see_') {
            $text .= "⛔  Periksa \n\n<b>KETERANGAN   :</b>\nTidak Ditemukan ";
         } else {
            $sapubasah  = str_replace('/see_', '', $isipesan);
            $sapulantai = str_replace('0', '-', $sapubasah);
            $sapuujuk   = str_replace('11', ' ', $sapulantai);
            $sapulidi   = str_replace('@' . $usernamebot . '', '', $sapuujuk);
            $API        = new routeros_api();

            if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
               $pepaya = $API->comm("/ip/hotspot/active/print", ["?server" => $sapulidi]);

               if (empty($pepaya)) {
                  $texta = "Tidak ada user aktif server $sapulidi\n\n";
        $texta .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $texta .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $texta .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
                  Bot::sendMessage($texta);
               }

               for ($i = 0; $i < count($pepaya); $i++) {
                  $mangga    = $pepaya[$i];
                  $id        = $mangga['.id'];
                  $server    = $mangga['server'];
                  $user      = $mangga['user'];
                  $address   = $mangga['address'];
                  $mac       = $mangga['mac-address'];
                  $uptime    = $mangga['uptime'];
                  $usesstime = $mangga['session-time-left'];
                  $bytesi    = formatBytes($mangga['bytes-in'], 2);
                  $byteso    = formatBytes($mangga['bytes-out'], 2);
                  $loginby   = $mangga['login-by'];
                  $comment   = $mangga['comment'];
                  $text .= "";
                  $text .= "👤 User aktif $server\n";
                  $text .= "┠ ID :$id\n";
                  $text .= "┠ User  : $user\n";
                  $text .= "┠ IP    : $address\n";
                  $text .= "┠ Uptime : $uptime\n";
                  $text .= "┠ Byte IN      : $bytesi\n";
                  $text .= "┠ Byte OUT   : $byteso\n";
                  $text .= "┠ Sesion  : $usesstime\n";
                  $text .= "┗ Login    : $loginby\n \n";

                  Bot::sendMessage($text);
                  $total = "Total login $server " . count($pepaya);
                  Bot::sendMessage($total);
               }
            }
         }
      } else {
         $denid = "Maaf..! Aksess Hanya untuk Administator\n\n";
        $denid .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $denid .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $denid .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
         Bot::sendMessage($denid);
      }
   });
   $mkbot->regex('/^\/rEm0vid/', function ($matches) {
      $info         = bot::message();
      $msgid        = $info['message_id'];
      $nametelegram = $info['from']['username'];
      $idtelegram   = $info['from']['id'];
      $isipesan     = $info['text'];
      Bot::sendChatAction('typing');
      $text = "";
      include ('../config/system.conn.php');

      if ($idtelegram == $id_own) {
         if ($isipesan == '/rEm0vid') {
            $text .= "⛔ Gagal dihapus \n\n<b>KETERANGAN   :</b>\nTidak Ditemukan Id User";
         } else {
            $id  = str_replace('/rEm0vid', '*', $isipesan);
            $ids = str_replace('@' . $usernamebot, '', $id);
            $API = new routeros_api();

            if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
               $ARRAY  = $API->comm("/ip/hotspot/user/print", ["?.id" => $ids, ]);
               $data1  = $ARRAY[0]['.id'];
               $data2  = $ARRAY[0]['name'];
               $data3  = $ARRAY[0]['password'];
               $data5  = $ARRAY[0]['profile'];
               $ARRAY2 = $API->comm("/ip/hotspot/user/remove", ["numbers" => $ids, ]);
               $texta  = json_encode($ARRAY2);

               if (strpos(strtolower($texta), 'no such item') !== false) {
                  $gagal = $ARRAY2['!trap'][0]['message'];
                  $text .= "⛔ Gagal dihapus \n\n<b>KETERANGAN   :</b>\n$gagal";
               } elseif (strpos(strtolower($texta), 'invalid internal item number') !== false) {
                  $gagal = $ARRAY2['!trap'][0]['message'];
                  $text .= "⛔ Gagal dihapus \n\n<b>KETERANGAN   :</b>\n$gagal";
               } elseif (strpos(strtolower($texta), 'default trial user can not be removed') !== false) {
                  $gagal = $ARRAY2['!trap'][0]['message'];
                  $text .= "⛔ Gagal dihapus \n\n<b>KETERANGAN   :</b>\n$gagal";
               } else {
                  $text .= "Berhasil Dihapus\n\n";
                  $text .= "<code>ID         : $ids</code>\n";
                  $text .= "<code>Server     : $data1</code>\n";
                  $text .= "<code>Name       : $data2</code>\n";
                  $text .= "<code>Password   : $data3</code>\n";
                  $text .= "<code>Profile    : $data5</code>\n";
                  sleep(2);
                  $ARRAY3 = $API->comm("/ip/hotspot/user/print");
                  $jumlah = count($ARRAY3);
                  $text .= "Jumlah user saat ini : $jumlah user\n\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
               }
            } else {
               $text = "Gagal Periksa sambungan Kerouter\n\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
            }
         }

         $options = ['parse_mode' => 'html', ];
         $texta   = json_encode($ARRAY2);
         return Bot::sendMessage($text, $options);
      } else {
         $denid = "Maaf..! Aksess Hanya untuk Administator\n\n";
        $denid .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $denid .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $denid .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
         Bot::sendMessage($denid);
      }
   });
   $mkbot->cmd('!Menu|/Menu|/menu', function () {
   	$info         = bot::message();
      $ids          = $info['chat']['id'];
      $msgid        = $info['message_id'];
      $nametelegram = $info['from']['username'];
      $idtelegram   = $info['from']['id'];
      
      $text         = "";
   	      if (has($idtelegram)) {
      include ('../config/system.conn.php');
      $data = json_decode($voucher_1, true);
      if (!empty($data)) {
      $text .= "<i>Silahkan Pilih voucher dibawah ini</i>\n\n";
      $text .= "<code>Daftar Harga Voucher :</code>\n";

      foreach ($data as $hargas) {
         $textlist = $hargas['Text_List'];

         $text .= "<code>$textlist  </code>\n";
      }

      for ($i = 0; $i < count($data); $i++) {
         ${'database' . $i}

         = ['text' => $data[$i]['Voucher'] . '', 'callback_data' => 'Vcr' . $data[$i]['id'] . ''];
      }

      $vouchernamea0 = array_filter(
         [
            $database0,
            $database1

         ]);

      $vouchernameb1 = array_filter(
         [
            $database2,
            $database3

         ]);

      $vouchernamec2 = array_filter(
         [
            $database4,
            $database5

         ]);
      $menu_idakhir = [
         ['text' => '💰 Cek Saldo', 'callback_data' => 'ceksaldo'],
         ['text' => '🔖 iNFORMASI', 'callback_data' => 'informasi'],
      ];

      $send = [];
      array_push($send, $vouchernamea0);
      array_push($send, $vouchernameb1);
      array_push($send, $vouchernamec2);
      array_push($send, $menu_idakhir);

      $options = [
         'reply_markup' => json_encode(['inline_keyboard' => $send]),
         'parse_mode' => 'html'
      ];

      Bot::sendMessage($text, $options);
      unset($data, $voucher_1);
      } else {
      	
      Bot::sendMessage('Maaf system tidak terdapat voucher');
      }
   }else{
   	Bot::sendMessage('Anda tidak terdaftar silahkan daftar terlebih dahulu ke admin atau klik /daftar');
   	 }
   });
   $mkbot->on('callback', function ($command) {

      $message           = Bot::message();
      $id                = $message['from']['id'];
      $usernamepelanggan = $message['from']['username'];
      $namatele          = $message['from']['first_name'];
      $chatidtele        = $message["message"]['chat']['id'];
      $message_idtele    = $message["message"]["message_id"];

      include ('../config/system.conn.php');

      if (has($id)) {
      	
         if (strpos($command, 'Vcr') !== false) {
            $data  = json_decode($voucher_1, true);
            $cekid = "Vcr" . $data[0]['id'] . ",Vcr" . $data[1]['id'] . ",Vcr" . $data[2]['id'] . ",Vcr" . $data[3]['id'] . ",Vcr" . $data[4]['id'] . ",Vcr" . $data[5]['id'];

            if (preg_match('/' . $command . '/i', $cekid)) {
               $API = new routeros_api();

               foreach ($data as $datas => $getdata) {
                  $getid2         = $getdata['id'];
                  $princevoc      = $getdata['price'];
                  $profile        = $getdata['profile'];
                  $length         = $getdata['length'];
                  $vouchername    = $getdata['Voucher'];
                  $markup         = $getdata['markup'];
                  $server         = $getdata['server'];
                  $type           = $getdata['type'];
                  $typechar       = $getdata['typechar'];
                  $prefix         = $getdata['prefix'];
                  $Color          = $getdata['Color'];
                  $limituptime    = $getdata['Limit'];
                  $limit_download = toBytes($getdata['limit_download']);
                  $limit_upload   = toBytes($getdata['limit_upload']);
                  $limit_total    = toBytes($getdata['limit_total']);

                  if ($command == 'Vcr' . $getid2) {
                     if (sisasaldo($id, $princevoc) == true) {
                        $limitsaldo .= "Maaf saldo anda tidak mencukupi untuk melakukan pembelian voucher <b>$vouchername</b>\nSilakan lakukan Deposit Saldo sebelum melakukan Pembelian Voucher ini. \n\n";
        $limitsaldo .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $limitsaldo .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $limitsaldo .= "Klik (/deposit) untuk menambah Menu Layanan.\n";

                        $options = [
                           'chat_id' => $chatidtele,
                           'message_id' => (int) $message['message']['message_id'],
                           'text' => $limitsaldo,
                           'reply_markup' => json_encode([
                              'inline_keyboard' => [
                                 [
                                    ['text' => '🔙 Back', 'callback_data' => 'Menu'],
                                 ], ]]),
                           'parse_mode' => 'html'

                        ];

                        Bot::editMessageText($options);
                     } else {
                        $sendupdate = "";
                        $sendupdate .= "<code>  Pembelian Voucher " . $profile . "   </code>\n";
                        $sendupdate .= "<code>========================</code>\n";
                        $sendupdate .= "<code>  ID User  :</code> <code>$id</code>\n";
                        $sendupdate .= "<code>  Username :</code> @$usernamepelanggan\n";
                        $sendupdate .= "<code>  Status   : Sedang di Proses </code>\n";
                        $sendupdate .= "<code>========================</code>\n";
                        $sendupdate .= "Mohon ditunggu, Pembuatan Voucher kurang lebih 5 - 10 detik.\n";

                        $options = [
                           'chat_id' => $chatidtele,
                           'message_id' => (int) $message['message']['message_id'],
                           'text' => $sendupdate,
                           'parse_mode' => 'html'

                        ];

                        Bot::editMessageText($options);

                        $delete = [
                           'chat_id' => $chatidtele,
                           'message_id' => (int) $message['message']['message_id'],
                        ];
								sleep(1);
                        Bot::deleteMessage($delete);

                        if ($type == 'up') {
                           $usernamereal = make_string($length, $typechar);
                           $passwordreal = make_string($length, $typechar);
                        } else {
                           $usernamereal = make_string($length, $typechar);
                           $passwordreal = $usernamereal;
                        }

                        switch ($limituptime) {
                           case null:
                              $limituptimereal = '00:00:00';
                              break;
                           case '00:00:00':
                              $limituptimereal = '00:00:00';
                              break;
                           default:
                              $limituptimereal = $limituptime;

                              if (strpos(strtolower($limituptimereal), 'h') !== false) {
                                 $uptime = str_replace('h', ' Jam', $limituptime);
                              } elseif (strpos(strtolower($limituptime), 'd') !== false) {
                                 $uptime = str_replace('d', ' Hari', $limituptime);
                              }

                              $echoexperid .= "<code>  Experid    :</code> <code>{$uptime}</code>\n";
                              break;
                        }

                        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                           $add_user_api = $API->comm("/ip/hotspot/user/add", [
                              "server"              => $server,
                              "profile"             => $profile,
                      //        "prefix"              => $prefix,
                              "name"                => "$prefix$usernamereal",
                              "password"            => "$prefix$passwordreal",
                              "limit-uptime"        => $limituptimereal,
                              "limit-bytes-out"     => $limit_upload,
                              "limit-bytes-in"      => $limit_download,
                              "limit-bytes-total"   => $limit_total,
                              "comment"             => "M-Tik Voucher",
                           ]);

                           if ($type == 'up') {
                              $caption = "";
                              $caption .= "<code>=========================</code>\n";
                                $caption .= "<code> Order ID      : $add_user_api</code>\n";
                                $caption .= "<code> Username      :</code> <code>$prefix$usernamereal</code>\n";
                                $caption .= "<code> Password      :</code> <code>$prefix$passwordreal</code>\n";
                                $caption .= "<code> Paket Voucher :</code> <code>$profile</code>\n";
                                $caption .= "<code> Harga Voucher :" . rupiah($princevoc) . ",- </code>\n";
                              $caption .= $echoexperid;
                              $caption .= "<code>=========================</code>\n";
                              $caption .= "<code>GUNAKAN INTERNET DGN BIJAK</code>\n";
                              $caption .= "<code>=========================</code>\n";
                           } else {
                              $caption = "";
                              $caption .= "<code>=========================</code>\n";
                                $caption .= "<code> Order ID      : $add_user_api</code>\n";
                                $caption .= "<code> KODE Voucher  :</code> <code>$prefix$usernamereal</code>\n";
                                $caption .= "<code> Paket Voucher :</code> <code>$profile</code>\n";
                                $caption .= "<code> Harga Voucher :" . rupiah($princevoc) . ",- </code>\n";
                              $caption .= $echoexperid;
                              $caption .= "<code>=========================</code>\n";
                              $caption .= "<code>GUNAKAN INTERNET DGN BIJAK</code>\n";
                              $caption .= "<code>=========================</code>\n";
                           }

                           //cek apakah ada kesalahan pada setting voucher.
                           $cekvalidasiadd = json_encode($add_user_api);

                           if (strpos(strtolower($cekvalidasiadd), '!trap')) {
                              //salah maka bot akan dianggap salah
                              $ganguan = true;
                           } else {

                        //benar maka bot akan send voucher

                          //cek dnsname sudah ada http belum?
                              if (strpos($dnsname, 'http://') !== false) {
                                 $url = "$dnsname/login?username=$prefix$usernamereal&password=$prefix$passwordreal";
                              } else {
                                 $url = "http://$dnsname/login?username=$prefix$usernamereal&password=$prefix$passwordreal";}

                              $qrcode     = 'http://qrickit.com/api/qr.php?d=' . urlencode($url) . '&addtext=' . urlencode($Name_router) . '&txtcolor=000000&fgdcolor=' . $Color . '&bgdcolor=FFFFFF&qrsize=500';
                              $keyboard[] = [
                                 ['text' => 'Go to Login', 'url' => $url],
                              ];

                              $options = [
                                 'chat_id' => $chatidtele,
                                 'caption' => $caption,
                                 'reply_markup' => ['inline_keyboard' => $keyboard],
                                 'parse_mode' => 'html'
                              ];
                            //  $succes = Bot::sendPhoto($qrcode, $options);
                              $succes = Bot::sendPhoto("https://pusat.me/images/terimakasih.jpg", $options);
                           }

                           $success = json_decode($succes, true);
                           if ($success['ok'] !== true) {
                              $errorprint = true;
                           }
                        } else {
                           $ganguan = true;
                        }

                        break;
                     }
                  }
               }

               if (!empty($ganguan)) {
                 //remove User jika terjadi error
                  if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                     $ARRAY2 = $API->comm("/ip/hotspot/user/remove", ["numbers" => $add_user_api, ]);
                  }

                  $gagal .= "<code>  Pembelian Voucher " . $profile . "   </code>\n";
                  $gagal .= "<code>========================</code>\n";
                  $gagal .= "<code>  ID User  :</code> <code>$id</code>\n";
                  $gagalt .= "<code> Username :</code> @$usernamepelanggan\n";
                  $gagal .= "<code>  Status   : Server Sedang Gangguan </code>\n";
                  $gagal .= "<code>========================</code>\n";
                  $gagal .= "Maaf server mengalami gangguan silahkan coba lagi nanti, atau hubungi admin.\n\n";
                  $gagal .= "Klik (/menu) untuk melihat Menu Layanan.\n";
                  $gagal .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
                  $gagal .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
                  $options = [
                     'chat_id' => $chatidtele,
                     'parse_mode' => 'html'

                  ];
                  $keterangan = 'gagal';
                  Bot::sendMessage($gagal, $options);

                  $set = belivoucher($id, $usernamepelanggan, '0', '0', $usernamereal, $passwordreal, $profile, $keterangan);
               } elseif (!empty($errorprint)) {

                 //remove User jika terjadi error
                  if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                     $ARRAY2 = $API->comm("/ip/hotspot/user/remove", ["numbers" => $add_user_api, ]);
                  }

                  $gagalprint .= "";
                  $gagalprint .= "<code>   Pembelian Voucher " . $profile . "  </code>\n";
                  $gagalprint .= "<code>========================</code>\n";
                  $gagalprint .= "<code>  ID User  :</code> <code>$id</code>\n";
                  $gagalprint .= "<code>  Username :</code> @$usernamepelanggan\n";
                  $gagalprint .= "<code>  Status   : Voucher Gagal di Print</code>\n";
                  $gagalprint .= "<code>========================</code>\n";
                  $gagalprint .= "Maaf server mengalami gangguan silahkan coba lagi nanti, atau hubungi admin.\n\n";
                  $gagalprint .= "Klik (/menu) untuk melihat Menu Layanan.\n";
                  $gagalprint .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
                  $gagalprint .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
                  $options    = ['chat_id' => $chatidtele, 'parse_mode' => 'html'];
                  $keterangan = 'gagalprint';
                  Bot::sendMessage($gagalprint, $options);

                  $set = belivoucher($id, $usernamepelanggan, '0', '0', $usernamereal, $passwordreal, $profile, $keterangan);
               } else if (!empty($succes)) {
               	
                  $Success = "";
                    $Success = "<code>    PEMBELIAN BERHASIL</code>\n";
                    $Success .= "<code>========================</code>\n";
                    $Success .= "<code>  Nama Paket  :</code> <code>$profile</code>\n";
                    $Success .= "<code>  Harga Paket : " . rupiah($princevoc) . ",-   </code>\n\n";
                    $Success .= "<code>  ID User  :</code> <code>$id</code>\n";
                    $Success .= "<code>  Username :</code> @$usernamepelanggan\n";
                    $Success .= "<code>========================</code>\n";

                  if (isset($Success)) {
                     $saldoawal   = lihatsaldo($id);
                     $keterangan  = 'Success';
                     $markupakhir = minus($princevoc, $markup);
                     $set         = belivoucher($id, $usernamepelanggan, $markupakhir, $markup, $usernamereal, $passwordreal, $profile, $keterangan);
                     $angka       = lihatsaldo($id);
                     $options     = [
                        'chat_id' => $chatidtele,
                        'reply_markup' => json_encode([
                           'inline_keyboard' => [
                              [
                                 ['text' => '⏱ History', 'callback_data' => 'VMarkup|' . $princevoc . '|' . $markup . '|' . $markupakhir . '|' . $saldoawal . '|' . $angka . ''],
                                 ['text' => '🔙 Back', 'callback_data' => 'Menu'],
                              ], [
                                 ['text' => '💰 Cek Saldo', 'callback_data' => 'notifsaldo'],
                              ]
                           ]]),
                        'parse_mode' => 'html'

                     ];

                     Bot::sendMessage($Success, $options);
                  }
               }
            } else {
               $Success = "";
               $Success = "Maaf voucher ini tidak lagi tersedia \n";

               $options = [
                  'chat_id' => $chatidtele,
                  'parse_mode' => 'html'

               ];

               Bot::sendMessage($Success, $options);
            }
         } elseif ($command == 'Menu') {
            $text = "";
            $data = json_decode($voucher_1, true);
            $text .= "<i>Silahkan Pilih voucher dibawah ini</i>\n\n";
            $text .= "<code>Daftar Harga Voucher :</code>\n";
            foreach ($data as $hargas) {
               $textlist = $hargas['Text_List'];
               $text .= "<code>$textlist </code>\n";
            }

            $datavoc = json_decode($voucher_1, true);
            for ($i = 0; $i < count($datavoc); $i++) {
               ${
                  'database' . $i
               }

               = ['text' => $datavoc[$i]['Voucher'] . '', 'callback_data' => 'Vcr' . $datavoc[$i]['id'] . ''];
            }

            $vouchernamea0 = array_filter(
               [
                  $database0,
                  $database1

               ]);

            $vouchernameb1 = array_filter(
               [
                  $database2,
                  $database3

               ]);

            $vouchernamec2 = array_filter(
               [
                  $database4,
                  $database5

               ]);

            $menu_idakhir = [
               ['text' => '💰 CEK SALDO', 'callback_data' => 'ceksaldo'],
               ['text' => '🔖 INFORMASI', 'callback_data' => 'informasi'],
            ];
            $send = [];
            array_push($send, $vouchernamea0);
            array_push($send, $vouchernameb1);
            array_push($send, $vouchernamec2);
            array_push($send, $menu_idakhir);

            $options = [
               'chat_id' => $chatidtele,
               'message_id' => (int) $message['message']['message_id'],
               'text' => $text,
               'reply_markup' => json_encode(['inline_keyboard' => $send]),
               'parse_mode' => 'html'

            ];

            Bot::editMessageText($options);
         } elseif ($command == 'ceksaldo') {

            if (has($id) == false) {
        $text  = "Maaf Akun Telegram anda belum terdaftar diserver kami silahkan ketik (/daftar) terlebih dahulu.\n\n";
        $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
        $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
        $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
            } else {
               $angka = lihatsaldo($id);
               $text  = "<code>      Informasi Saldo</code>\n";
               $text .= "<code>========================</code>\n";
               $text .= "<code>  ID User : $id</code>\n";
               $text .= "<code>  Name    : @$usernamepelanggan</code>\n";
               $text .= "<code>  Saldo   : " . rupiah($angka) . "</code>\n";
               $text .= "<code>========================</code>\n\n";
               $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
               $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
               $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
            }

            $options = [
               'chat_id' => $chatidtele,
               'message_id' => (int) $message['message']['message_id'],
               'text' => $text,
               'reply_markup' => json_encode([
                  'inline_keyboard' => [
                     [
                        ['text' => '🔙 Back', 'callback_data' => 'Menu'],
                     ], ]]),
               'parse_mode' => 'html'

            ];

            Bot::editMessageText($options);
         } elseif ($command == 'informasi') {
            $text    = 'Tidak ada informasi terkini';
            $options = [
               'chat_id' => $chatidtele,
               'message_id' => (int) $message['message']['message_id'],
               'text' => $text,
               'reply_markup' => json_encode([
                  'inline_keyboard' => [
                     [
                        ['text' => 'Back', 'callback_data' => 'Menu'],
                     ], ]]),
               'parse_mode' => 'html'

            ];

            Bot::editMessageText($options);
         } elseif (strpos($command, 'tps') !== false) {
            if (preg_match('/^tps/', $command)) {
               $cekdata  = explode('|', $command);
               $cek      = $cekdata[1];
               $text .= "Terima kasih @$usernamepelanggan \nPermintaan deposit sebesar " . rupiah($cek) . " sudah kami terima, dan akan kami proses. \nSilahkan kirimkan foto bukti pembayaran disertai dengan Caption : \n#konfirmasi deposit $cek\n\nKonfirmasi selambat-lambatnya 2 jam setelah permintaan deposit berhasil.\n\n";
               $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
               $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
               $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
               $options = [
                  'chat_id' => $chatidtele,
                  'message_id' => (int) $message['message']['message_id'],
                  'text' => $text,
                  'parse_mode' => 'html'

               ];

               Bot::editMessageText($options);

               $textsend = "";
               $textsend .= "<code>User :  </code>@$usernamepelanggan \n";
               $textsend .= "<code>ID   : </code> <code>$id </code>\n";
               $textsend .= "<code>Request pengisian saldo </code>\n";
               $textsend .= "<code>Nominal :" . rupiah($cek) . "</code>\n";
               $textsend .= "<code>Silahkan tindak lanjuti \nAtau Hubungi user </code> @$usernamepelanggan \n\n";
               $textsend .= "Dengan Menekan tombol dibawah ini saldo user otomatis terisi  ";

               $kirimpelangan = [
                  'chat_id' => $id_own,
                  'reply_markup' => json_encode([
                     'inline_keyboard' => [
                    //    [
                    //       ['text' => 'QUICK TOP UP', 'callback_data' => '12'],
                    //    ],
                        [
                           ['text' => '' . rupiah($cek) . '', 'callback_data' => 'tp|' . $cek . '|' . $id . '|' . $usernamepelanggan . ''],
                        ],
                    //    [
                    //       ['text' => 'OR COSTUM', 'callback_data' => '12'],
                    //    ],
                        [
                           ['text' => 'Rp.10.000', 'callback_data' => 'tp|10000|' . $id . '|' . $usernamepelanggan . ''],
                           ['text' => 'Rp.15.000', 'callback_data' => 'tp|15000|' . $id . '|' . $usernamepelanggan . ''],
                           ['text' => 'Rp.20.000', 'callback_data' => 'tp|20000|' . $id . '|' . $usernamepelanggan . ''],
                        ],
                        [

                           ['text' => 'Rp.25.000', 'callback_data' => 'tp|25000|' . $id . '|' . $usernamepelanggan . ''],
                           ['text' => 'Rp.30.000', 'callback_data' => 'tp|30000|' . $id . '|' . $usernamepelanggan . ''],
                           ['text' => 'Rp.50.000', 'callback_data' => 'tp|50000|' . $id . '|' . $usernamepelanggan . ''],
                        ],
                        [

                           ['text' => 'Rp.100.000', 'callback_data' => 'tp|100000|' . $id . '|' . $usernamepelanggan . ''],
                           ['text' => 'Rp.150.000', 'callback_data' => 'tp|150000|' . $id . '|' . $usernamepelanggan . ''],
                           ['text' => 'Rp.200.000', 'callback_data' => 'tp|200000|' . $id . '|' . $usernamepelanggan . ''],
                        ],
                        [

                           ['text' => 'Reject Request', 'callback_data' => 'tp|reject|' . $id . '|reject']
                        ],

                     ]]),
                  'parse_mode' => 'html'

               ];

               Bot::sendMessage($textsend, $kirimpelangan);
            }
         } elseif (strpos($command, 'tp') !== false) {

            if (preg_match('/^tp/', $command)) {
               $cekdata     = explode('|', $command);
               $cekkodeunik = $cekdata[0];
               $jumlah      = $cekdata[1];
               $iduser      = $cekdata[2];
               $namauser    = $cekdata[3];
               $text        = "";
               if ($jumlah == 'reject') {
               	
                  $text = "Masa tunggu konfirmasi deposit telah habis permintaan deposit telah kadaluarsa.\nSilahkan konfirmasi deposit selambat-lambatnya 2 jam setelah Request Deposit.\n\nTerima kasih.\n\n";
               $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
               $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
               $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
                  //kirim ke user
                  $kirimpelangan = [
                     'chat_id' => $iduser,
                     'parse_mode' => 'html'

                  ];
                  Bot::sendMessage($text, $kirimpelangan);
                  
                  $options = [
                     'chat_id' => $chatidtele,
                     'message_id' => (int) $message['message']['message_id'],
                     'text' => 'Reject Deposit berhasil',
                     'parse_mode' => 'html'
                  ];
                  Bot::editMessageText($options);
                  
                  
               } else {

                  if ($id == $id_own) {
                     if (!empty($iduser) && !empty($jumlah)) {
                        if (has($iduser) == false) {
                           $text = 'Data id ' . $iduser . 'tidak terdaftar silahkan periksa kembali';
                        } else {

                           if (preg_match('/^[0-9]+$/', $jumlah)) {
                            //  if (strlen($jumlah) < 7) {
                              if (($jumlah) < 500001) {
                                 $text = topupresseller($iduser, $namauser, $jumlah, $id_own);

                                 //kirim ke user
                                 $kirimpelangan = [
                                    'chat_id' => $iduser,
                                    'reply_markup' => json_encode([
                                       'inline_keyboard' => [
                                          [
                                             ['text' => '🔎 Beli Voucher', 'callback_data' => 'Menu'],
                                             ['text' => '📛 Promo Hot', 'callback_data' => 'informasi'],
                                          ], ]]),
                                    'parse_mode' => 'html'
                                 ];
                                 Bot::sendMessage($text, $kirimpelangan);
                                 //
                              } else {
                                 $text = "Maaf Maksimal Top Up Rp 500.000,-\n\n";
               $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
               $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
               $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
                              }
                           } else {
                              $text = "Maaf nominal tidak berupa angka \n\n";
               $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
               $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
               $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
                           }
                        }
                     } else {
                        $text = "Maaf format data salah \n\n";
               $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
               $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
               $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
                     }
                  } else {
                     $text = "Maaf..! Aksess Hanya untuk Administator\n\n";
               $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
               $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
               $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
                  }
                  $options = [
                     'chat_id' => $chatidtele,
                     'message_id' => (int) $message['message']['message_id'],
                     'text' => $text,
                     'parse_mode' => 'html'
                  ];
                  Bot::editMessageText($options);
               }
            }
         } elseif (strpos($command, 'VMarkup') !== false) {
            $cekdata     = explode('|', $command);
            $cekkodeunik = $cekdata[0];
            $princevoc   = $cekdata[1];
            $markup      = $cekdata[2];
            $markupakhir = $cekdata[3];
            $saldoawal   = $cekdata[4];
            $saldo       = $cekdata[5];
            $text        = "";

            if (!empty($princevoc)) {
               $text .= "<code>Saldo Awal    = </code>" . rupiah($saldoawal) . " \n";
               $text .= "<code>Voucher Price = </code>" . rupiah($princevoc) . " \n";
               $text .= "<code>Total Markup  = </code>" . rupiah($markup) . " \n";
               $text .= "#  Voucher-Markup \n";
               $text .= "# " . rupiah($princevoc) . " - " . rupiah($markup) . " = " . rupiah($markupakhir) . " \n";
               $text .= "# Saldoawal-Markup Akhir \n";
               $text .= "# " . rupiah($saldoawal) . " - " . rupiah($markupakhir) . " = " . rupiah($saldo) . " \n";
               $text .= "<b>Sisa saldo </b> : " . rupiah($saldo) . " \n";
            } else {
               $text = "Maaf format data salah \n\n";
               $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
               $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
               $text .= "Klik (/deposit) untuk menambah Menu Layanan.\n";
            }

            $options = [
               'chat_id' => $chatidtele,
               'message_id' => (int) $message['message']['message_id'],
               'text' => $text,
               'reply_markup' => json_encode([
                  'inline_keyboard' => [
                     [
                        ['text' => '🔙 Back', 'callback_data' => 'Menu'],
                     ], ]]),
               'parse_mode' => 'html'

            ];

            Bot::editMessageText($options);
         } elseif (strpos($command, 'notifsaldo') !== false) {

            if (has($id) == false) {
                $text = "Maaf Akun Telegram anda belum terdaftar diserver kami silahkan ketik (/daftar) terlebih dahulu sebelum request deposit saldo.\n\n";
                $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
                $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
                $text .= "Klik (/deposit) untuk menambah Saldo Anda.\n";
            } else {
               $angka = lihatsaldo($id);
               if ($angka < 2000) {
                  $text = "ID anda  : $id \nSisa saldo anda  : " . rupiah($angka) . "\n⚠ Segera isi ulang saldo anda";
               } else {
                  $text = "ID anda  : $id \nSisa saldo anda  : " . rupiah($angka);
               }
            }
            Bot::answerCallbackQuery($text, $options = ['show_alert' => true]);
         }
         } else {
                $text = "Maaf Akun Telegram anda belum terdaftar diserver kami silahkan ketik (/daftar) terlebih dahulu sebelum request deposit saldo.\n\n";
                $text .= "Klik (/menu) untuk melihat Menu Layanan.\n";
                $text .= "Klik (/ceksaldo) untuk melihat Saldo Anda.\n";
                $text .= "Klik (/deposit) untuk menambah Saldo Anda.\n";
         $options = [
            'chat_id' => $chatidtele,
            'message_id' => (int) $message['message']['message_id'],
            'text' => $text,
         ];
         Bot::editMessageText($options);
      }
   });
   $mkbot->on('photo', function () {
      $info           = bot::message();
      $nametelegram   = $info['from']['username'];
      $idtelegram     = $info['from']['id'];
      $caption        = strtolower($info['caption']);
      $explode        = explode(' ', $caption);
      $konfirmasitext = $explode['0'];
      $deposittext    = $explode['1'];
      $jumlahtext     = $explode['2'];

      if (!empty($caption)) {
         include ('../config/system.conn.php');
         if (has($idtelegram)) {
         	//cek kandungan
         	  if (preg_match('/^#konfirmasi/', $konfirmasitext)) {
         	  	//cek lagi sesuai format
            if ($konfirmasitext == '#konfirmasi' && $deposittext == 'deposit' && !empty($jumlahtext)) {
               if (preg_match('/^[0-9]+$/', $jumlahtext)) {
                  $fototerbaik = $info['photo'][3]['file_id'];
                  $fotomedium  = $info['photo'][2]['file_id'];
                  $fotorendah  = $info['photo'][1]['file_id'];
                  $fotojelek   = $info['photo'][0]['file_id'];
                  $caption     = "Lapor ! konfirmasi deposit dari @$nametelegram Jumlah " . rupiah($jumlahtext) . " Silahkan di periksa dan ditindak lanjut";
                  if (!empty($fototerbaik)) {
                     Bot::sendPhoto($fototerbaik, $options = ['chat_id' => $id_own, 'caption' => $caption, 'parse_mode' => 'html']);
                     Bot::sendMessage("konfirmasi deposit sudah kami dan akan segera kami prosses mohon tunggu\n\nTerima kasih");
                  } elseif (!empty($fotomedium)) {
                     Bot::sendPhoto($fotomedium, $options = ['chat_id' => $id_own, 'caption' => $caption, 'parse_mode' => 'html']);
                     Bot::sendMessage("konfirmasi deposit sudah kami terima, akan segera kami prosses mohon tunggu\n\nTerima kasih");
                  } elseif (!empty($fotorendah)) {
                     Bot::sendMessage("Maaf foto anda tidak jelas system kami tidak dapat membaca foto anda 😅 \n");
                  } else {
                     Bot::sendMessage("Maaf foto anda tidak jelas system kami tidak dapat membaca foto anda 😅 \n");
                  }
               } else {
                  Bot::sendMessage("Maaf Jumlah deposit hanya berupa angka saja  😅 \n");
               }
            } else {
               Bot::sendMessage("Silahkan konfirmasi deposit disertai dengan keterangan di foto Contoh format keterangan : konfirmasi deposit 20000 ");
            }
         	  }
         } else {
            Bot::editMessageText('Maaf anda tidak terdaftar silahkan daftar terlebih dahulu ke admin atau klik /daftar');
         }
      }
   });
   $mkbot->run();

   /*Please contact @Bangachil for bugs
   history
   1 Maret 2019
   -Make ceksaldo command
   -Make cekid
   2 Maret 2019
   -Make callback data
   -Make menu command
   -Make array menu
   -Make callback answer
   3 Maret 2019
   -Make database Saldo
   -bugs fix daftar
   -bugs fix menu
   -bugs fix saldo minus
   -bugs fix topup
   -Make topup send to ID
   -Make button menu
   10 Maret 2019
   -make emoticon button menu
   -make cek id calbback
   -make voucher defalut disable
   -make voucher null
   19 Maret 2019
   -bugs fix menu command
   -bugs fix callback answer
   -bugs fix list Voucher array
   -bugs fix database
   Version update 1.2.3
   20 maret 2019
   -Make User id callback
   -remove emotion calbback
   -remove array_filter
   -move data callback
   -move ceksaldo
   -Make ceksaldo cek id
   Version update 1.2.11

   2 april 2019
   -remove start auto join
   -make hitspot view
   -make remove user hotspot cmd
   -make help cmd
   -Make hass user
   Version update 1.2.13

   3 april 2019
   -edited vcr callback data

   Version update 1.2.14
   8 april 2019
   -Penambahan type char
   -color qrcode
   -bugs fix saldo minus
   Version update 1.3.00

   -10 april 2019
   -Perispan nonsaldo
   -edit text
   -Version update 1.4.00
   11 april 2019

   -Version update 1.5.00

   Thanks to topupGroup an member , SengkuniCode, and to all user support mini project
   Thanks to SengkuniCode for web ui,

    */
