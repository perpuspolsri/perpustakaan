<?= $this->extend("pages/public/layouts/main") ?>

<?= $this->section('content'); ?>
<?= $this->include("pages/public/layouts/nav") ?>

<div class="p-8 w-full h-fit pt-20">
    <div class="w-full h-fit relative overflow-hidden bg-black rounded-md">
        <div
            id="hero-bg"
            class="absolute inset-0 bg-cover bg-center transition-opacity duration-500 ease-in-out"
            style="background-image: url('/img/background/visi-misi.png');" data-aos="zoom-out" data-aos-duration="2000">
            <div class="absolute inset-0 bg-black opacity-60"></div>
        </div>

        <div class="my-20 relative z-10 px-8 md:px-80 py-20 flex flex-col gap-3 justify-between h-full">
            <h1 class="text-white font-semibold text-5xl text-center" data-aos="fade-up" data-aos-duration="1000">Tentang Kami</h1>
        </div>
    </div>
</div>

<div class="w-full py-10 px-8 lg:px-20 grid grid-cols-1 md:grid-cols-2 gap-5 text-justify" id="tentang-kami-area" data-aos="fade-up" data-aos-duration="1000"></div>

<div class="p-8 w-full h-fit pt-20">
    <div class="w-full h-fit relative overflow-hidden bg-black rounded-md">
        <div
            id="hero-bg"
            class="absolute inset-0 bg-cover bg-center transition-opacity duration-500 ease-in-out"
            style="background-image: url('/img/background/DSC01996-min.JPG');" data-aos="zoom-out" data-aos-duration="2000" data-aos-delay="800">
            <div class="absolute inset-0 bg-gradient-to-r from-black/90 to-transparent"></div>
        </div>

        <div class="relative z-10 px-8 md:px-20 py-20 flex flex-col gap-2h-full w-full md:w-1/2 text-white" id="visi-misi-area" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">

        </div>
    </div>
</div>

<div class="px-8 md:px-20 pb-20 pt-10 w-full flex flex-col gap-4 font-gabarito">
    <div class="w-full flex justify-between items-end rounde">
        <div>
            <h2 class="text-[var(--primary)] text-xl font-bold">Staf</h2>
            <p data-aos="fade-up">Staf Perpustakaan Polsri</p>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5" id="staff-wrapper">

    </div>
</div>

<div class="px-8 md:px-20 pb-20 pt-10 w-full font-gabarito flex flex-col gap-4">
    <p class="text-xl font-bold text-[var(--primary)]" data-aos="fade-up">Sejarah</p>
    <div id="sejarah-area" class="text-justify flex flex-col gap-4" data-aos="fade-up"></div>
</div>

<?= $this->include("pages/public/layouts/footer") ?>

<script>
    const tentangKamiArea = document.getElementById("tentang-kami-area")
    const sejarahArea = document.getElementById("sejarah-area")
    const visiMisiArea = document.getElementById("visi-misi-area")

    async function getStaff() {
        try {
            const staffWrapper = document.getElementById("staff-wrapper");

            const response = await Api.get('/api/public/staff');
            const result = response;

            if (result.status === 'success' && Array.isArray(result.data) && result.data != '') {
                result.data.forEach(item => {
                    staffWrapper.innerHTML += `<div class="p-3 border border-gray-300 flex items-center gap-5 rounded-md" data-aos="fade-up" data-aos-duration="800">
            <img src="${item.image}" alt="" class="w-1/5 rounded">
            <div class="flex flex-col justify-around">
                <div class="flex flex-col">
                    <p class="text-sm">${item.nip}</p>
                    <p class="text-xl font-semibold">${item.name}</p>
                    <p>${item.role}</p>
                </div>
                <div class="grid grid-cols-2 gap-2 mt-3">
                    <div class="flex gap-2">
                        <img src="/img/icons/email-dark.svg" alt="" class="w-4">
                        <p>${item.email}</p>
                    </div>
                    <div class="flex gap-2">
                        <img src="/img/icons/instagram-dark.svg" alt="" class="w-4">
                        <p>${item.medsos.instagram}</p>
                    </div>
                    <div class="flex gap-2">
                        <img src="/img/icons/facebook-dark.svg" alt="" class="w-3">
                        <p>${item.medsos.facebook}</p>
                    </div>
                    <div class="flex gap-2">
                        <img src="/img/icons/linkedin-dark.svg" alt="" class="w-4">
                        <p>${item.medsos.linkedin}</p>
                    </div>
                </div>
            </div>
        </div>`
                });
            } else {}
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    async function getTentangKamiData() {
        tentangKamiArea.innerHTML = "Loading..."
        try {
            const response = await Api.get('/api/public/contents/tentang_kami');
            const datas = response.data;

            tentangKamiArea.innerHTML = datas.content
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    async function getVisiMisiData() {
        visiMisiArea.innerHTML = "Loading..."
        try {
            const response = await Api.get('/api/public/contents/visi_misi');
            const datas = response.data;
            console.log(datas)

            visiMisiArea.innerHTML = datas.content
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    async function getSejarahData() {
        sejarahArea.innerHTML = "Loading..."
        try {
            const response = await Api.get('/api/public/contents/sejarah');
            const datas = response.data;

            sejarahArea.innerHTML = datas.content
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', async function() {
        getStaff();
        getVisiMisiData();
        getTentangKamiData()
        getSejarahData()
    });
</script>

<!-- <p>asdasd</p> -->
<?= $this->endSection(); ?>
