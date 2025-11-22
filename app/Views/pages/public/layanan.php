<?= $this->extend("pages/public/layouts/main") ?>

<?= $this->section('content'); ?>
<?= $this->include("pages/public/layouts/nav") ?>

<div class="p-8 w-full h-fit pt-20">
    <div class="w-full h-fit relative overflow-hidden bg-black rounded-md">
        <div
            id="hero-bg"
            class="absolute inset-0 bg-cover bg-center transition-opacity duration-500 ease-in-out"
            style="background-image: url('/img/background/DSC01996-min.JPG');" data-aos="zoom-out" data-aos-duration="2000">
            <div class="absolute inset-0 bg-black opacity-55"></div>
        </div>

        <div class="my-20 relative z-10 px-8 md:px-80 py-20 flex flex-col gap-3 justify-between h-full">
            <h1 class="text-white font-semibold text-5xl text-center" data-aos="fade-up" data-aos-duration="1000"><?= $layanan?></h1>
            <h1 class="hidden" id="endpoint"><?= $layanan_endpoint?></h1>
        </div>
    </div>
</div>

<div class="px-8 md:px-20 pb-20 pt-10 w-full font-gabarito flex flex-col items-center gap-4">
    <div id="content-area" class="text-justify flex flex-col gap-4 w-2/3"></div>
</div>

<?= $this->include("pages/public/layouts/footer") ?>

<script>
    const contentArea = document.getElementById("content-area")
    const endpoint = document.getElementById("endpoint").innerHTML

    async function getContentData() {
        contentArea.innerHTML = "Loading..."
        try {
            const response = await Api.get(`/api/public/contents/${endpoint}`);
            const datas = response.data;

            contentArea.innerHTML = datas.content
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', async function() {
        getContentData()
    });
</script>

<?= $this->endSection(); ?>
