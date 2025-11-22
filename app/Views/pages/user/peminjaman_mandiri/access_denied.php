<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>

<div class="w-full h-screen flex justify-center items-center text-t-gray">
    <div class="flex flex-col items-center gap-3">
        <p class="text-3xl font-semibold">Anda Tidak Diizinkan Mengakses Halaman Ini!</p>
        <a href="/member/dashboard" class="w-1/3">
            <button class="py-3 px-5 bg-base-blue text-white font-semibold rounded-md w-full">Kembali</button>
        </a>
    </div>
</div>
<?= $this->endSection(); ?>
