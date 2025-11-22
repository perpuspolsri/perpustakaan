<?= $this->extend("pages/public/layouts/main") ?>

<?= $this->section('content'); ?>
<?= $this->include("pages/public/layouts/nav") ?>

<div class="p-8 w-full h-fit pt-20">
    <div class="w-full h-fit relative overflow-hidden bg-black rounded-md">
        <div
            id="hero-bg"
            class="absolute inset-0 bg-cover bg-center transition-opacity duration-500 ease-in-out"
            style="background-image: url('/img/background/default-background.JPG');" data-aos="zoom-out" data-aos-duration="2000">
            <div class="absolute inset-0 bg-black opacity-60"></div>
        </div>

        <div class="mt-20 relative z-10 px-8 md:px-80 py-10 flex flex-col gap-3 justify-between h-full">
            <h1 class="text-white font-semibold text-4xl" id="title" data-aos="fade-up" data-aos-duration="1000"></h1>
            <p class="hidden" id="sub"><?= $path ?></p>
            <p class="text-white text-gray-200" id="date"></p>
        </div>
    </div>
</div>
<div class="w-full py-10 pt-7 px-8 lg:px-80 mt-5 mb-5 flex flex-col text-justify" id="content">
</div>

</div>
<?= $this->include("pages/public/layouts/footer") ?>

<script>
    function formatRelativeTimeCustom(datetimeStr) {
        if (!datetimeStr) return 'Tidak ada data waktu';

        try {
            const [datePart, timePart] = datetimeStr.split(' ');
            const [year, month, day] = datePart.split('-').map(Number);
            const [hour, minute, second] = timePart.split(':').map(Number);

            const utcTimestamp = Date.UTC(year, month - 1, day, hour, minute, second);
            const wibTimestamp = utcTimestamp - (7 * 60 * 60 * 1000);
            const date = new Date(wibTimestamp);

            const now = new Date();
            const diffMs = now - date;
            const diffHours = Math.floor(diffMs / (1000 * 60 * 60));

            if (diffHours < 1) return 'Baru saja';
            if (diffHours < 24) return `${diffHours} jam lalu`;
            if (diffHours < 48) return 'Kemarin';
            return date.toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        } catch (e) {
            console.error('Error parsing date:', datetimeStr, e);
            return 'Format waktu tidak valid';
        }
    }

    document.addEventListener('DOMContentLoaded', async function() {
        const sub = document.getElementById('sub');
        const title = document.getElementById('title');
        const content = document.getElementById('content');
        const date = document.getElementById('date');

        try {
            const response = await Api.get(`/api/public/news/path/${sub.innerHTML}`);
            const result = response.data;

            if (result) {
                title.innerHTML = result.content_title
                content.innerHTML = result.content_desc
                date.innerHTML = `${formatRelativeTimeCustom(result.last_update)} oleh Perpustakaan Polsri`
            } else {
                title.innerHTML = "Berita Tidak Ditemukan"
                title.style.textAlign = "center"
            }

        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    });
</script>

<!-- <p>asdasd</p> -->
<?= $this->endSection(); ?>
