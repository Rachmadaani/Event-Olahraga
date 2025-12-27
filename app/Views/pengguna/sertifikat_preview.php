<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="<?= base_url('img/logo.png') ?>">
    <title>Sertifikat Peserta</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body,
        .certificate-wrapper {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .certificate-wrapper {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px;
            box-sizing: border-box;
            background-image: url('<?= base_url('uploads/templates/' . $sertifikat['background_img']) ?>');
            background-size: cover;
            background-position: center;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            max-width: 90%;
        }

        .certificate-title {
            font-family: Georgia, serif;
            font-size: 50px;
            font-weight: bold;
            color: #0a3d62;
            letter-spacing: 5px;
            margin-bottom: 10px;
        }

        .recipient-name {
            font-size: 42px;
            font-weight: bold;
            margin: 20px 0;
            text-transform: uppercase;
        }

        .event-description {
            font-size: 18px;
            line-height: 1.6;
            max-width: 800px;
        }

        .location-info {
            margin: 10px 0;
            line-height: 1.4;
        }

        .signature-block {
            text-align: center;
            margin-top: 50px;
        }

        .signature-block img {
            width: 120px;
        }

        .signature-name {
            font-weight: bold;
            margin-top: 5px;
        }

        .panitia-label {
            font-size: 14px;
            color: #666;
        }

        @media print {

            html,
            body {
                width: 100%;
                height: 100%;
            }

            .certificate-wrapper {
                width: 100%;
                height: 100%;
                padding: 0;
            }
        }
    </style>
</head>

<body>

    <div class="certificate-wrapper">
        <div class="content-wrapper">
            <div class="certificate-title">SERTIFIKAT</div>
            <div>Diberikan kepada:</div>
            <div class="recipient-name"><?= esc($sertifikat['nama_peserta']) ?></div>
            <div>Sebagai PESERTA</div>

            <div class="event-description">
                Pada event <strong><?= esc($sertifikat['nama_event']) ?></strong><br>
                yang diselenggarakan oleh <strong>Event Olahraga</strong><br>
                <div class="location-info">
                    bertempat di <strong><?= esc($sertifikat['kelurahan']) ?>, Kec. <?= esc($sertifikat['kecamatan']) ?>,<br>
                        Kab. <?= esc($sertifikat['kabupaten']) ?>, Prov. <?= esc($sertifikat['provinsi']) ?></strong>
                </div>
                pada tanggal <strong><?= esc($sertifikat['tanggal_indonesia']) ?></strong>
            </div>
            <div class="signature-block">
                <?php if (!empty($sertifikat['ttd_panitia'])): ?>
                    <img src="<?= base_url('uploads/event/ttd/' . $sertifikat['ttd_panitia']) ?>" alt="TTD Panitia">
                <?php else: ?>
                    <p><em>TTD belum tersedia</em></p>
                <?php endif; ?>
                <div class="signature-name"><?= esc($sertifikat['nama_panitia'] ?? 'Panitia') ?></div>
                <div class="panitia-label">Ketua Panitia</div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>

</body>

</html>