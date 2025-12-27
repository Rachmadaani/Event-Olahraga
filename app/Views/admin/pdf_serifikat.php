<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sertifikat Peserta</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .certificate-wrapper {
            width: 100%;
            height: 100%;
            position: relative;
            background-image: url("<?= $history['background'] ?>");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            padding: 15mm;
            box-sizing: border-box;
        }

        .certificate-title {
            font-family: 'Georgia', serif;
            font-size: 54px;
            font-weight: bold;
            color: #0a3d62;
            letter-spacing: 5px;
        }

        .certificate-subtitle {
            font-size: 20px;
            color: #333;
            margin-top: 8px;
        }

        .recipient-name {
            font-size: 44px;
            font-weight: bold;
            color: #2d3436;
            margin: 25px 0 15px;
            text-transform: uppercase;
        }

        .status-label {
            font-size: 22px;
            font-weight: bold;
            color: #0a3d62;
            margin-bottom: 25px;
        }

        .event-description {
            font-size: 18px;
            color: #222;
            line-height: 1.6;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        .signature-section {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            padding-right: 30mm;
        }

        .signature-block {
            text-align: center;
        }

        .signature-block img {
            width: 120px;
            margin-bottom: 8px;
        }

        .signature-name {
            font-weight: bold;
            font-size: 16px;
            color: #222;
            margin-top: 4px;
        }

        .panitia-label {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="certificate-wrapper">

        <!-- Atas -->
        <div>
            <div class="certificate-title">SERTIFIKAT</div>
            <div class="certificate-subtitle">Diberikan kepada:</div>
            <div class="recipient-name"><?= esc($history['nama_lengkap']) ?></div>
            <div class="status-label">Sebagai PESERTA</div>
        </div>

        <!-- Tengah -->
        <div class="event-description">
            <div>
                Pada event olahraga <strong><?= esc($history['event_name']) ?></strong><br>
                yang diselenggarakan oleh <strong>Event Olahraga</strong><br>
                bertempat di <strong><?= esc($history['location']) ?></strong>, pada tanggal
                <strong>
                    <?php
                    // Konversi tanggal ke format Indonesia dengan bulan Indonesia
                    $tanggal = strtotime($history['start_date']);
                    $bulan = [
                        1 => 'Januari',
                        2 => 'Februari',
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                        7 => 'Juli',
                        8 => 'Agustus',
                        9 => 'September',
                        10 => 'Oktober',
                        11 => 'November',
                        12 => 'Desember'
                    ];
                    $bulanAngka = (int)date('n', $tanggal);
                    echo date('d', $tanggal) . ' ' . $bulan[$bulanAngka] . ' ' . date('Y', $tanggal);
                    ?>
                </strong>
            </div>
        </div>

        <!-- Bawah -->
        <div class="signature-section">
            <div class="signature-block">
                <?php if ($history['ttd_qr']): ?>
                    <img src="<?= $history['ttd_qr'] ?>" alt="QR Panitia">
                <?php else: ?>
                    <p><em>TTD belum tersedia</em></p>
                <?php endif; ?>
                <div class="signature-name"><?= esc($history['nama_panitia']) ?></div>
                <div class="panitia-label">Ketua Panitia</div>
            </div>
        </div>

    </div>
</body>

</html>