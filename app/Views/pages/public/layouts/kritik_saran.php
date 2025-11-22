<div class="px-8 md:px-20 pt-40 w-full flex flex-col items-center gap-4 font-gabarito" id="kritik-saran">
    <div class="w-full flex justify-center items-center flex-col">
        <h2 class="text-[var(--primary)] text-xl font-bold">Kritik & Saran</h2>
        <p>Berikan kritik & saran untuk Perpustakaan Polsri</p>
    </div>
    <form class="flex flex-col w-full md:w-1/2 gap-4" id="form-kritik" method="post" action="">
        <div class="flex flex-col">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required placeholder="ex: johndoe@mail.com" class="w-full bg-white border border-gray-300 rounded p-2">
        </div>
        <div class="flex flex-col">
            <label for="message">Kritik & Saran</label>
            <textarea name="message" id="message" required placeholder="Tulis di sini" rows="7" class="w-full bg-white border border-gray-300 rounded p-2"></textarea>
        </div>
        <div class="flex justify-center items-center">
            <button id="btn-kirim-kritik" class="bg-[var(--primary)] w-1/2 py-2 px-5 rounded text-white flex gap-3 justify-center" type="submit">
                <img src="img/icons/send-light.svg" alt="">
                <p class="font-bold">Kirim</p>
            </button>
        </div>
    </form>
    <div class="hidden bg-white border border-gray-300 p-3 rounded fixed bottom-5 right-5" id="notif">
        <p>Kritik & Saran Berhasil Dikirim ✅</p>
    </div>
</div>


<script>
    const formKritik = document.getElementById('form-kritik');
    const btnKirimKritik = document.getElementById('btn-kirim-kritik');
    const email = document.getElementById('email');
    const message = document.getElementById('message');
    const notif = document.getElementById('notif');

    formKritik.addEventListener('submit', async function(e) {
        e.preventDefault();
        const formKritik = e.target;
        const requiredFields = formKritik.querySelectorAll("[required]");
        let valid = true;

        try {
            const response = await Api.post('/api/public/kritiksaran', {
                email: email.value,
                message: message.value,
            });

            notif.classList.toggle("hidden");
            email.value = ""
            message.value = ""
            setTimeout(() => {
                notif.classList.add("hidden");
            }, 3000);
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    });
</script>
