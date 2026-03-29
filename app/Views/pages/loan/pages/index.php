<?= $this->extend("pages/loan/layouts/main") ?>

<?= $this->section("content") ?>
<?= $this->include("pages/loan/layouts/nav") ?>

<div class="w-full flex justify-center items-center h-screen">
    <div class="w-1/3 p-6 py-7 border border-gray-300 rounded-md flex flex-col gap-6 bg-white">
        <div>
            <h1 class="text-3xl">Halo, <b><?= session()->get('realname'); ?>!</b></h1>
            <p class="text-gray-500">Mau pinjam buku apa hari ini?</p>
        </div>
        <div id="alert" class="hidden text-sm p-2 rounded text-red-500 flex items-center">
            <i class="" id="alert-icon"></i>
            <p id="alert-message">Kode Buku Tidak Ditemukan</p>
        </div>
        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-3">
                <div>
                    <label for="item_code">Kode Buku</label>
                    <input id="item_code" type="text" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-base-blue focus:border-transparent transition-all duration-200 mt-1" placeholder="Masukkan Kode Buku">
                </div>

                <button onclick="createLoan()" class="bg-base-blue text-white py-3 px-5 rounded hover:bg-base-hover transition-all duration-200 hover:scale-105">Pinjam Sekarang</button>
            </div>
            <div class="flex items-center justify-center">
                <div class="w-1/3 border border-b-gray-100"></div>
                <p class="text-center w-1/3 text-gray-500">Atau</p>
                <div class="w-1/3 border border-b-gray-100"></div>
            </div>
            <a href="" class="w-full">
                <button class="w-full bg-white border border-gray-300 py-3 px-5 rounded hover:bg-gray-100 transition-all duration-200 hover:scale-105">Kembalikan Buku</button>
            </a>
        </div>
    </div>
</div>

<script>
    const itemCode = document.getElementById("item_code")
    async function createLoan(e) {
        if (itemCode.value == "") {
            showAlert("Kode Buku Belum Diisi", "error")
        } else {
            try {
                const response = await Api.get(`/api/member/loans/items/${itemCode.value}`);
                const result = response;

                console.log(result)

                if (result.status == "failed") {
                    showAlert(result.message, "error")
                } else {
                    showAlert("Kode buku ditemukan. Mengalihkan...", "success")
                    setTimeout(() => {
                        window.location.href = `/loan/confirm/${itemCode.value}`;
                    }, 1000);
                }
            } catch (error) {
                console.error('Error fetching fines:', error);
            }
        }
    }

    function showAlert(message, type = "error") {
        const alert = document.getElementById("alert")
        const alertIcon = document.getElementById("alert-icon")
        const alertMessage = document.getElementById("alert-message")

        alert.classList.remove("hidden")
        if (type != "error") {
            alert.className = "bg-green-100 border border-green-300 rounded flex p-2 items-center text-green-800"
            alertIcon.className = "fas fa-check-circle mr-2"
        } else {
            alert.className = "bg-red-100 border border-red-300 rounded flex p-2 items-center text-red-800"
            alertIcon.className = "fas fa-exclamation-circle mr-2"
        }

        alertMessage.innerHTML = message
        setTimeout(() => {
            alert.classList.add("hidden")
        }, 5000);
    }
</script>
<?= $this->endSection(); ?>
