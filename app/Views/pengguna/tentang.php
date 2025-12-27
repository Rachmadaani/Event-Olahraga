<?= $this->extend('layouts/pengguna') ?>

<?= $this->section('title') ?>
Tentang
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h1 class="mb-4">Tentang Event Olahraga</h1>
            <p class="lead">
                Event Olahraga adalah platform yang dirancang untuk memudahkan masyarakat dalam mendapatkan informasi,
                mengikuti, dan berpartisipasi dalam berbagai kegiatan olahraga.
                Kami percaya bahwa olahraga bukan hanya aktivitas fisik,
                tetapi juga sarana untuk mempererat kebersamaan dan membangun gaya hidup sehat.
            </p>
            <hr class="my-4">
            <h3 class="mb-3">Visi Kami</h3>
            <p>
                Menjadi wadah utama dalam penyelenggaraan event olahraga yang inovatif, inklusif,
                serta mampu menginspirasi masyarakat untuk hidup lebih sehat dan aktif.
            </p>
            <h3 class="mb-3 mt-5">Misi Kami</h3>
            <ul class="list-unstyled text-start d-inline-block">
                <li>✅ Menyediakan informasi terkini mengenai event olahraga.</li>
                <li>✅ Mendukung partisipasi aktif masyarakat di berbagai bidang olahraga.</li>
                <li>✅ Membangun komunitas olahraga yang sehat, solid, dan berprestasi.</li>
                <li>✅ Menghadirkan pengalaman event olahraga yang menyenangkan dan bermanfaat.</li>
            </ul>
        </div>
    </div>
</div>
<?= $this->endSection() ?>