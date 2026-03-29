<?= $this->extend("pages/loan/layouts/main") ?>

<?= $this->section("content") ?>
<?= $this->include("pages/loan/layouts/nav") ?>

<div class="w-full flex justify-center items-center h-screen">
    <div class="w-2/5 h-screen flex justify-center items-center">
        <div class="w-3/5 flex flex-col gap-1 items-center">
            <img src="/img/loan-illustration.svg" alt="" class="w-full">
            <div class="flex flex-col text-center">
                <h1 class="font-semibold text-3xl">Peminjaman Berhasil✅</h1>
            </div>
        </div>
    </div>
    <div class="w-3/5 h-screen flex justify-center items-center">
        <div class="w-2/4 flex flex-col gap-4">
            <div class="w-full p-5 py-6 border border-gray-300 rounded-md flex flex-col gap-4">
                <div class="flex flex-col">
                    <p class="m-0 p-0 text-sm text-gray-500">Kode Buku</p>
                    <p class="m-0 p-0 font-semibold" id="kode_buku">88272871</p>
                </div>
                <div class="flex flex-col">
                    <p class="m-0 p-0 text-sm text-gray-500">Judul Buku</p>
                    <p class="m-0 p-0 font-semibold" id="judul_buku">PostgreSQL : a comprehensive guide to building, programming, and administering PostgreSQL databases</p>
                </div>
                <div class="flex flex-col">
                    <p class="m-0 p-0 text-sm text-gray-500">Tanggal Peminjaman</p>
                    <p class="m-0 p-0 font-semibold" id="kode_buku">22 November 2026</p>
                </div>
                <div class="flex flex-col">
                    <p class="m-0 p-0 text-sm text-gray-500">Tanggal Pengembalian</p>
                    <p class="m-0 p-0 font-semibold" id="kode_buku">22 November 2026</p>
                </div>
                <div class="bg-orange-100 p-2 rounded border border-orange-500">
                    <p class="m-0 p-0 text-sm text-orange-600">Mohon untuk mengembalikan buku tepat waktu. Keterlambatan pengembalian akan dikenakan denda sebesar Rp 1.000 per/hari.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
