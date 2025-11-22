<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>
<div class="max-w-7xl">
    <h1 class="text-3xl font-semibold mb-6 text-[#505050]">WhatsApp Service Monitoring</h1>

    <div class="border border-gray-300 w-full mt-4 p-3 px-5 rounded flex gap-3">
        <div class="w-1/3 p-2 border border-gray-200 flex-col justify-center gap-3" id="qr-wrapper">
            <img id="qr">
            <button class="bg-base-blue p-2 px-5 w-full text-white font-semibold rounded" id="btn-generate-qr" onclick="generateQR('123')">Click To Generate QR</button>
        </div>
        <div class="flex gap-3 justify-between items-center w-full">
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

</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    const qrWrapper = document.getElementById("qr-wrapper");

    async function generateQR(number) {
        const qr = document.getElementById("qr");
        try {
            const res = await fetch("https://api.fonnte.com/qr", {
                method: "POST",
                headers: {
                    "Authorization": "aqsmLwc5ckdUiz5YBxsx"
                },
                body: JSON.stringify({
                    type: "qr",
                    whatsapp: "6285165394486"
                })
            });
            const data = await res.json();
            console.log(data)
            qr.src = `data:image/png;base64,${data.url}`
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    async function getDeviceStatus() {
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
                    "Authorization": "aqsmLwc5ckdUiz5YBxsx"
                },
            });
            const data = await res.json();

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

        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', async () => {
        getDeviceStatus();
    });
</script>
<?= $this->endSection(); ?>
