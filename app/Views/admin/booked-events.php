<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Daftar Event yang Sudah Dibooking
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow-sm">
    <div class="card-header bg-success text-white d-flex align-items-center">
        <h5 class="mb-0 flex-grow-1">
            <i class="fas fa-calendar-check"></i> Daftar Event yang Sudah Dibooking
        </h5>
        <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-primary btn-sm ms-auto">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">
        <?php if (!empty($events)): ?>
            <?php
            // 🔹 Kelompokkan event berdasarkan bulan-tahun
            $groupedEvents = [];
            $months = [];
            foreach ($events as $event) {
                $monthYear = date('F Y', strtotime($event['tanggal_event']));
                $groupedEvents[$monthYear][] = $event;
                $months[$monthYear] = $monthYear; // untuk dropdown filter
            }
            ?>

            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <input type="text" id="searchEvent" class="form-control" placeholder="Cari nama event...">
                </div>
                <div class="col-md-6 mb-2">
                    <select id="monthFilter" class="form-select">
                        <option value="">-- Filter berdasarkan bulan --</option>
                        <?php foreach ($months as $month): ?>
                            <option value="<?= strtolower($month) ?>"><?= esc($month) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <?php foreach ($groupedEvents as $month => $monthEvents): ?>
                <div class="mb-5 event-group" data-month="<?= strtolower($month) ?>">
                    <h5 class="text-primary border-bottom pb-2 mb-3">
                        <i class="fas fa-calendar-alt"></i> <?= esc($month) ?>
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 25%;">Nama Event</th>
                                    <th style="width: 15%; cursor:pointer;" id="sortDate">
                                        Tanggal Event <i class="fas fa-sort"></i>
                                    </th>
                                    <th style="width: 35%;">Lokasi</th>
                                    <th style="width: 20%;">Nama Panitia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($monthEvents as $event): ?>
                                    <tr class="event-row" data-month="<?= strtolower($month) ?>" data-date="<?= strtotime($event['tanggal_event']) ?>">
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="event-name"><strong><?= esc($event['nama_event']) ?></strong></td>
                                        <td class="text-center"><?= date('d F Y', strtotime($event['tanggal_event'])) ?></td>
                                        <td>
                                            <?= esc($event['provinsi']) ?>, <?= esc($event['kabupaten']) ?>,
                                            <?= esc($event['kecamatan']) ?>, <?= esc($event['kelurahan']) ?><br>
                                            <?php if (!empty($event['lokasi'])): ?>
                                                <a href="<?= esc($event['lokasi']) ?>" target="_blank" class="text-info small">
                                                    <i class="fas fa-map-marker-alt"></i> Lihat Lokasi
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center"><?= esc($event['nama_panitia']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="text-center py-5">
                <p class="text-muted fs-5">
                    <i class="fas fa-info-circle"></i> Belum ada event yang dibooking.
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchEvent');
    const monthFilter = document.getElementById('monthFilter');

    function filterEvents() {
        const filterText = searchInput.value.toLowerCase();
        const filterMonth = monthFilter.value.toLowerCase();

        document.querySelectorAll('.event-row').forEach(row => {
            const strong = row.querySelector('.event-name strong');
            const originalText = strong.textContent; // teks asli
            const nameLower = originalText.toLowerCase();
            const month = row.getAttribute('data-month');
            let show = true;

            // Filter nama event
            if (filterText && !nameLower.includes(filterText)) show = false;

            // Filter bulan
            if (filterMonth && month !== filterMonth) show = false;

            row.style.display = show ? '' : 'none';

            // Highlight rapi tanpa merusak huruf kapital
            if (filterText && nameLower.includes(filterText)) {
                const regex = new RegExp(`(${filterText})`, 'gi');
                strong.innerHTML = originalText.replace(regex, '<mark>$1</mark>');
            } else {
                strong.innerHTML = originalText; // reset
            }
        });
    }

    searchInput.addEventListener('input', filterEvents);
    monthFilter.addEventListener('change', filterEvents);

    // Sort by tanggal
    let sortAsc = true;
    document.getElementById('sortDate').addEventListener('click', function() {
        document.querySelectorAll('tbody').forEach(tbody => {
            Array.from(tbody.querySelectorAll('tr'))
                .sort((a, b) => sortAsc ?
                    a.getAttribute('data-date') - b.getAttribute('data-date') :
                    b.getAttribute('data-date') - a.getAttribute('data-date'))
                .forEach(tr => tbody.appendChild(tr));
        });
        sortAsc = !sortAsc;
        this.querySelector('i').classList.toggle('fa-sort-up', sortAsc);
        this.querySelector('i').classList.toggle('fa-sort-down', !sortAsc);
    });
</script>

<?= $this->endSection() ?>