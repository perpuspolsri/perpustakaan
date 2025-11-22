<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>

<div class="w-full h-screen flex justify-center items-center text-t-gray">
    <div class="w-1/2">
        <div class="w-full border-t border-l border-r border-gray-300 p-5 rounded-t-md flex justify-between">
            <div class="flex item-center justify-center gap-2">
                <img src="/img/polsri.png" alt="" class="w-9 h-9">
                <div class="flex flex-col">
                    <h1 class="text-t-gray font-semibold text-lg">UPT Perpustakaan POLSRI</h1>
                    <p class="text-[#969696] text-[12px] -mt-1">Peminjaman Mandiri</p>
                </div>
            </div>
            <a href="<?= base_url('logout') ?>">
                <button class="bg-base-blue text-white py-2 px-5 rounded hover:bg-base-hover transition-all duration-200 flex item-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-1 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </a>
        </div>
        <div class="w-full border border-gray-300 p-5 py-10 rounded-b-md flex justify-center items-center">
            <div class="flex flex-col w-4/5 gap-4">
                <div class="flex flex-col text-center mb-2">
                    <h1 class="text-xl">Halo, <b><?= session()->get('realname'); ?>!</b></h1>
                    <p class="text-sm">Masukkan kode buku untuk memulai peminjaman mandiri.</p>
                    <h1 class="hidden" id="member_id"><?= session()->get('member_id'); ?></h1>
                </div>
                <div  class="flex flex-col gap-3">
                    <div>
                        <label for="item_code">Kode Buku</label>
                        <input id="item_code" type="text" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-base-blue focus:border-transparent transition-all duration-200 mt-1" placeholder="Masukkan Kode Buku">
                    </div>

                    <button onclick="createLoan()" class="bg-base-blue text-white py-3 px-5 rounded hover:bg-base-hover transition-all duration-200 hover:scale-105">Pinjam Sekarang</button>
                </div>
                <p class="text-sm text-center">© 2025 UPT Perpustakaan POLSRI. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    async function createLoan(e) {

        const itemCode = document.getElementById('item_code').value.trim();
        const memberId = document.getElementById('member_id').innerHTML;

        if (!itemCode) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Kode buku harus di isi!',
                confirmButtonText: 'OK'
            });
            return;
        }

        const data = {
            item_code: itemCode,
            member_id: memberId,
        };

        console.log(memberId);

        try {
            const response = await Api.post('/api/member/loans', data)
            const result = response
            console.log(result)

            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Peminjaman Berhasil ✅',
                    confirmButtonText: 'OK',
                    timer: 2000,
                    willClose: () => {
                        window.location.href = '/member/loan';
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Peminjaman Gagal ❌',
                    confirmButtonText: 'OK'
                });
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim data.');
        }
    }
</script>
<?= $this->endSection(); ?>
