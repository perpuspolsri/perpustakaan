<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>
<div class="max-w-7xl">
    <h1 class="text-3xl font-semibold mb-6 text-[#505050]">WhatsApp Service Monitoring</h1>


    <div class="flex w-full justify-between items-start">
        <div class="w-1/3 p-2 border border-gray-200 flex-col justify-center gap-3" id="qr-wrapper">
            <img id="qr">
            <button class="bg-base-blue p-2 px-5 w-full text-white font-semibold rounded" id="btn-generate-qr">Click To Generate QR</button>
        </div>
        <button class="bg-base-blue p-2 px-5 text-white font-semibold rounded" id="btn-edit">Edit</button>
    </div>
    <div class="border border-gray-300 w-full mt-4 p-3 px-5 rounded flex flex-col gap-3">
        <p id="invalid-info" class="hidden">Token Invalid</p>
        <div class="flex gap-3 justify-between items-center w-full mt-2" id="device-info">
            <div class="flex flex-col">
                <p class="text-sm text-gray-400">Status</p>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-base-blue" id="indicator"></div>
                    <p id="status" class="font-semibold">Test</p>
                </div>
            </div>
            <div class="flex flex-col">
                <p class="text-sm text-gray-400">Device Name</p>
                <p id="device-name">Test</p>
            </div>
            <div class="flex flex-col">
                <p class="text-sm text-gray-400">Number</p>
                <p id="device-number">Test</p>
            </div>
            <div class="flex flex-col">
                <p class="text-sm text-gray-400">Expired Date</p>
                <p id="expired-date">Test</p>
            </div>
            <div class="flex flex-col">
                <p class="text-sm text-gray-400">Total Message</p>
                <p id="total-message">Test</p>
            </div>
            <div class="flex flex-col">
                <p class="text-sm text-gray-400">Quota</p>
                <p id="quota">Test</p>
            </div>
        </div>
    </div>

    <div id="edit-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4 overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-[#505050]">Edit WhatsApp</h2>
                <button id="sejarah-modal-button-close" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="visionForm">
                <div class="mt-2">
                    <label for="bodySejarah" class="block text-sm font-medium text-t-gray mb-2">Token</label>
                    <input type="text" name="landing_page_content_id" id="token" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>
                <div class="flex justify-end space-x-3 mt-3">
                    <button type="button" id="sejarah-modal-button-back" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="edit-button-save" type="submit" class="px-4 py-2 bg-b-green hover:bg-b-green-hover text-white rounded-md  transition-colors duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    const qrWrapper = document.getElementById("qr-wrapper");
    const btnGenerateQR = document.getElementById("btn-generate-qr");
    const btnEdit = document.getElementById("btn-edit");
    const editModal = document.getElementById("edit-modal");
    const editBtnSave = document.getElementById("edit-button-save");

    editBtnSave.addEventListener("click", async (e) => {
        e.preventDefault();
        try {
            const inputToken = document.getElementById("token");
            const response = await Api.post('/api/admin/contents/whatsapp_token', {
                content: inputToken.value,
            });

            const result = response;
            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'WhatsApp Token berhasil diperbarui ✅',
                    confirmButtonText: 'OK',
                    timer: 2000,
                    willClose: () => {
                        window.location.href = '/admin/wa-service-monitoring';
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal memperbarui WhatsApp Token ❌',
                    confirmButtonText: 'OK'
                });
            }
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    })

    async function generateQR(number, token) {
        const qr = document.getElementById("qr");
        try {
            const deviceNumber = document.getElementById("device-number");
            const res = await fetch("https://api.fonnte.com/qr", {
                method: "POST",
                headers: {
                    "Authorization": `${token}`
                },
                body: JSON.stringify({
                    type: "qr",
                    whatsapp: deviceNumber.innerHTML
                })
            });
            const data = await res.json();
            console.log(data)
            qr.src = `data:image/png;base64,${data.url}`
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    async function getDeviceStatus(token) {
        const deviceName = document.getElementById("device-name");
        const deviceNumber = document.getElementById("device-number");
        const expiredDate = document.getElementById("expired-date");
        const totalMessage = document.getElementById("total-message");
        const quota = document.getElementById("quota");
        const status = document.getElementById("status");
        const indicator = document.getElementById("indicator");
        try {
            const res = await fetch("https://api.fonnte.com/device", {
                method: "POST",
                headers: {
                    "Authorization": token
                },
            });
            const data = await res.json();
            console.log(data)
            if (data.reason != "token invalid") {
                deviceName.innerHTML = data.name
                deviceNumber.innerHTML = data.device
                expiredDate.innerHTML = data.expired
                totalMessage.innerHTML = data.messages
                quota.innerHTML = data.quota
                if (data.device_status != "connect") {
                    status.innerHTML = "Disconnected"
                    indicator.style.backgroundColor = "red"
                    qrWrapper.style.display = "flex"
                } else {
                    status.innerHTML = "Connected"
                    indicator.style.backgroundColor = "#16476A"
                    qrWrapper.style.display = "hidden"
                }
            } else {
                const deviceInfo = document.getElementById("device-info")
                const invalidInfo = document.getElementById("invalid-info")
                deviceInfo.classList.add("hidden")
                invalidInfo.classList.remove("hidden")
            }

        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    async function getCurrentToken() {
        try {
            const response = await Api.get('/api/public/contents/whatsapp_token');
            const result = response.data
            return result.content;
        } catch (error) {
            console.error(error.message)
        }
    }

    document.addEventListener('DOMContentLoaded', async () => {
        const token = await getCurrentToken();
        if (token) {
            getDeviceStatus(token);

            btnGenerateQR.addEventListener("click", () => {
                generateQR(123, token)
            })

            btnEdit.addEventListener("click", () => {
                const inputToken = document.getElementById("token")
                inputToken.value = token
                editModal.classList.remove("hidden")
            })
        }
    });
</script>
<?= $this->endSection(); ?>
