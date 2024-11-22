<!DOCTYPE html>
<?php
$background_url = 'https://wallpaperaccess.com/full/8774781.jpg';
$background_url2 = 'bg_nahida.jpg';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengatur Rutinitas Sehari-Hari</title>
    <style> /* Modul 8 GUI: CSS digunakan untuk mengatur tampilan antarmuka */
        body {
            font-family: 'Arial', sans-serif;
            background-color: greenyellow;
            color: #333;
            margin: 1;
            padding: 2;
            background-image: url('<?php echo $background_url; ?>');
            
        }

        .container {
            width: 70%;
            margin: 0 auto;
            padding: 20px;
            background-color: greenyellow;
            box-shadow: 2px 4px 8px rgba(10, 10, 10, 10);
            border-radius: 8px;  
            
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: white; /* Warna teks utama */
            -webkit-text-stroke: 1px black; /* Outline */
            -webkit-text-fill-color: greenyellow; /* Warna isi teks */
        }

        .menu {
            text-align: center;
            margin-bottom: 30px;
        }

        .menu a {
            font-size: 18px;
            color: #4CAF50;
            text-decoration: none;
            margin: 0 15px;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .menu a:hover {
            background-color: #4CAF50;
            color: white;
        }

        .form-section {
            margin-top: 30px;
        }

        input[type="text"],
        input[type="time"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="time"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: greenyellow;
        }

        tr:hover {
            background-color: greenyellow;
        }

        .action-btn {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .action-btn:hover {
            background-color: #d32f2f;
        }

        .notification {
            background-color: #4CAF50;
            color: greenyellow;
            padding: 15px;
            text-align: center;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Aplikasi Pengatur Rutinitas Sehari-Hari</h1>
        <div class="menu">
            <a href="?modul=home">Home</a> |
            <a href="?modul=tugas">Daftar Tugas</a> |
            <a href="?modul=pengingat">Pengingat Waktu</a>
        </div>

        <div class="form-section">
            <?php
            session_start();
            // Function Modul 4
            // class untuk manajemen data JSON 
            class ManajemenData {
                public static function simpan($data, $filename) {
                    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
                }

                public static function muat($filename) {
                    if (file_exists($filename)) {
                        return json_decode(file_get_contents($filename), true);
                    }
                    return [];
                }
            }

            // class Tugas // Modul 5 OOP 1: class Tugas dengan konstruktor dan metode toArray
            class Tugas {
                public $tugas;
                public $waktu;

                public function __construct($tugas, $waktu) {
                    $this->tugas = $tugas;
                    $this->waktu = $waktu;
                }

                
                public function toArray() {
                    return ['tugas' => $this->tugas, 'waktu' => $this->waktu];
                }
            }

            // class Pengingat // Modul OOP 1: Kelas Pengingat dengan konstruktor dan metode toArray
            class Pengingat {
                public $waktu;
                public $pesan;

                public function __construct($waktu, $pesan) {
                    $this->waktu = $waktu;
                    $this->pesan = $pesan;
                }

                
                public function toArray() {
                    return ['waktu' => $this->waktu, 'pesan' => $this->pesan];
                }
            }
            // Modul 2 Pengkondisian: Menentukan modul yang dipilih oleh pengguna
            // Menampilkan Halaman Home 
            if (isset($_GET['modul']) && $_GET['modul'] == 'home') {
                //echo '<img src="nahida_greeting.jpg" alt="Gambar center" width="1050" height="500">';
                echo "<h2>Selamat datang di Aplikasi Pengatur Rutinitas Sehari-Hari!</h2>";
                echo "<p>Ini adalah aplikasi untuk membantu Anda mengatur rutinitas harian dengan mudah. Anda bisa menambahkan tugas yang perlu dikerjakan dan menetapkan pengingat waktu.</p>";
                echo "<p>Pilih modul di atas untuk memulai.</p>";
                echo "<h3>Tentang Produk</h3>";
                echo "<p>Aplikasi Pengatur Rutinitas Sehari-Hari dirancang untuk membantu Anda mengelola waktu dan tugas dengan lebih efisien. Fitur-fitur utama meliputi:</p>";
                echo "<ul>
                        <li><strong>Daftar Tugas:</strong> Tambahkan dan kelola tugas harian Anda.</li>
                        <li><strong>Pengingat Waktu:</strong> Tetapkan pengingat untuk memastikan Anda tidak melewatkan tugas penting.</li>
                      </ul>";
                echo "<p>Dengan antarmuka yang sederhana dan mudah digunakan, aplikasi ini cocok untuk semua kalangan yang ingin meningkatkan produktivitas sehari-hari.</p>";
                echo "</div>";

            // Daftar Tugas Sehari-hari // Perulangan Modul 3: Menampilkan daftar tugas
            } elseif (isset($_GET['modul']) && $_GET['modul'] == 'tugas') {
                $filename_tugas = 'tugas.json';
                $tugasList = ManajemenData::muat($filename_tugas);

                if (isset($_POST['tambah_tugas'])) {
                    $tugasBaru = new Tugas($_POST['tugas'], $_POST['waktu']);
                    $tugasList[] = $tugasBaru->toArray();
                    ManajemenData::simpan($tugasList, $filename_tugas);
                }

                if (isset($_GET['hapus'])) {
                    $index = $_GET['hapus'];
                    unset($tugasList[$index]);
                    $tugasList = array_values($tugasList);
                    ManajemenData::simpan($tugasList, $filename_tugas);
                }
                echo '<h2>Daftar Tugas Sehari-hari</h2>';
                echo '<form method="POST">
                        <label>Tugas: </label><input type="text" name="tugas" required><br>
                        <label>Waktu: </label><input type="time" name="waktu" required><br>
                        <input type="submit" name="tambah_tugas" value="Tambah Tugas">
                      </form>';

                echo '<table>';
                echo '<tr><th>Tugas</th><th>Waktu</th><th>Aksi</th></tr>';
                foreach ($tugasList as $index => $task) {
                    echo "<tr class='saved-text'><td>{$task['tugas']}</td><td>{$task['waktu']}</td>
                          <td><a href='?modul=tugas&hapus=$index' class='action-btn'>Hapus</a></td></tr>";
                }
                echo '</table>';
                
            // Pengingat Waktu
            } elseif (isset($_GET['modul']) && $_GET['modul'] == 'pengingat') {
                $filename_pengingat = 'pengingat.json';
                $pengingatList = ManajemenData::muat($filename_pengingat);

                if (isset($_POST['set_pengingat'])) {
                    $pengingatBaru = new Pengingat($_POST['waktu_pengingat'], $_POST['pesan_pengingat']);
                    $pengingatList[] = $pengingatBaru->toArray();
                    ManajemenData::simpan($pengingatList, $filename_pengingat);
                }

                if (isset($_GET['hapus_pengingat'])) {
                    $index = $_GET['hapus_pengingat'];
                    unset($pengingatList[$index]);
                    $pengingatList = array_values($pengingatList);
                    ManajemenData::simpan($pengingatList, $filename_pengingat);
                }

                echo '<h2>Pengingat Waktu</h2>';
                echo '<form method="POST">
                        <label>Pilih Waktu Pengingat: </label><input type="time" name="waktu_pengingat" required><br>
                        <label>Pesan Pengingat: </label><input type="text" name="pesan_pengingat" required><br>
                        <input type="submit" name="set_pengingat" value="Set Pengingat">
                      </form>';

                echo '<table>';
                echo '<tr><th>Waktu</th><th>Pesan</th><th>Aksi</th></tr>';
                foreach ($pengingatList as $index => $pengingat) {
                    echo "<tr class='saved-text'><td>{$pengingat['waktu']}</td><td>{$pengingat['pesan']}</td>
                          <td><a href='?modul=pengingat&hapus_pengingat=$index' class='action-btn'>Hapus</a></td></tr>";
                }
                echo '</table>';
            } else {
                // Halaman Home sebagai default jika tidak ada modul yang dipilih
                echo "<h3>Selamat datang di Aplikasi Pengatur Rutinitas Sehari-Hari! Pilih modul di atas untuk memulai.</h3>";
            }
            ?>
        </div>
    </div>

    <!-- Elemen audio untuk pengingat -->
    <audio id="reminder-sound" src="samplealarm.mp3" preload="auto"></audio>

    <!-- Script untuk memeriksa pengingat // Function & Perulangan: Memeriksa pengingat setiap menit--> 
    <script>
    function checkReminders() {
        const now = new Date();
        const currentTime = now.toTimeString().split(' ')[0].substring(0, 5); // Format jam:Menit

        // Muat data pengingat dari file JSON atau array
        const reminders = <?php echo json_encode($pengingatList); ?>;

        reminders.forEach(reminder => {
            if (reminder.waktu === currentTime) {
                const reminderSound = document.getElementById("reminder-sound");
                
                // Mulai memutar suara
                reminderSound.play().then(() => {
                    // Setelah suara mulai diputar, munculkan pop-up
                    alert("Pengingat: " + reminder.pesan);
                }).catch(error => {
                    // Jika ada error, munculkan pop-up saja
                    console.error("Gagal memutar suara:", error);
                    alert("Pengingat: " + reminder.pesan);
                });
            }
        });
    }

    setInterval(checkReminders, 60000); // Periksa setiap menit
</script>
</body>
</html>
