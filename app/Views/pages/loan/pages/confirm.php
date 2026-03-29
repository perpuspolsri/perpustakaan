<?= $this->extend("pages/loan/layouts/main") ?>

<?= $this->section("content") ?>
<?= $this->include("pages/loan/layouts/nav") ?>

<div class="w-full flex justify-center items-center h-screen">
    <p id="loader">Sedang Memuat...</p>
    <div class="hidden w-2/4 p-6 py-7 border border-gray-300 rounded-md flex gap-7" id="card">
        <img
            src=""
            alt=""
            class="w-1/2 h-min rounded"
            id="cover_buku">
        <div class="w-2/3 flex flex-col gap-5">
            <h1 class="text-3xl font-semibold">Konfirmasi Peminjaman</h1>
            <div class="flex flex-col">
                <p class="m-0 p-0 text-sm text-gray-500">Kode Buku</p>
                <p class="m-0 p-0 font-semibold" id="kode_buku"></p>
            </div>
            <div class="flex flex-col">
                <p class="m-0 p-0 text-sm text-gray-500">Judul Buku</p>
                <p class="m-0 p-0 font-semibold" id="judul_buku"></p>
            </div>
            <div class="flex flex-col gap-2">
                <button onclick="createLoan()" class="bg-base-blue text-white py-3 px-5 rounded hover:bg-base-hover transition-all duration-200 hover:scale-105">Lanjutkan</button>
                <a href="/loan" class="w-full">
                    <button class="w-full bg-white border border-gray-300 py-3 px-5 rounded hover:bg-gray-100 transition-all duration-200 hover:scale-105">Batalkan</button>
                </a>
                <h1 class="hidden" id="member_id"><?= session()->get('member_id'); ?></h1>
            </div>
        </div>
    </div>
</div>

<script>
    async function createLoan(e) {
        const itemCode = document.getElementById('kode_buku').innerHTML;
        const memberId = document.getElementById('member_id').innerHTML;

        const data = {
            item_code: itemCode,
            member_id: memberId,
        };

        console.log(memberId);

        try {
            const response = await Api.post('/api/member/loans', data)
            const result = response.data
            console.log(result)

            if (result.status === 'success') {
                setTimeout(() => {
                    window.location.href = `/loan/${itemCode.value}`;
                }, 1000);
            } else {
                setTimeout(() => {
                    window.location.href = `/loan`;
                }, 1000);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim data.');
            window.location.href = `/loan`;
        }
    }

    const loader = document.getElementById("loader")
    const card = document.getElementById("card")
    const kodeBuku = document.getElementById("kode_buku")
    const judulBuku = document.getElementById("judul_buku")
    const coverBuku = document.getElementById("cover_buku")

    document.addEventListener('DOMContentLoaded', async function() {
        try {
            const url = window.location.href.split("/")
            const itemCode = url[url.length - 1]
            kodeBuku.innerHTML = "Loading..."
            judulBuku.innerHTML = "Loading..."

            const response = await Api.get(`/api/member/loans/items/${itemCode}`);
            const result = response.data;

            if (result) {
                loader.classList.add("hidden")
                card.classList.remove("hidden")
                kodeBuku.innerHTML = result.item_code
                judulBuku.innerHTML = result.title
                coverBuku.src = `https://library.polsri.ac.id/lib/minigalnano/createthumb.php?filename=images/docs/${result.image}.jpg&width=200`
            }
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    });
</script>
<?= $this->endSection(); ?>
