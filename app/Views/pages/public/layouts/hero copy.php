<div class="p-8 w-full h-screen pt-20">
    <div class="w-full h-full relative overflow-hidden bg-black rounded-md">
        <div
            id="hero-bg"
            class="absolute inset-0 bg-cover bg-center transition-opacity duration-500 ease-in-out"
            style="background-image: url('/img/hero-background-1.jpg');">
            <div class="absolute inset-0 bg-black opacity-60"></div>
        </div>

        <!-- <div class="absolute bottom-0 w-full flex justify-end z-100">
            <div class="bg-white pt-3 ps-5 w-fit rounded-tl-md flex items-center gap-5 justify-end">
                <div>
                    <a href="/">
                        <p class="m-0 p-0 font-semibold">Berita</p>
                        <p class="truncate w-40 md:w-80" id="highlight-text">
                            Loading...
                        </p>
                    </a>
                </div>
                <button
                    class="bg-[var(--primary)] py-1.5 px-4 text-white rounded md:rounded-md text-center w-max ">
                    Selengkapnya
                </button>
            </div>
        </div> -->

        <div class="relative z-10 ps-8 lg:ps-8 pt-20 lg:pt-8 flex flex-col lg:flex-row items-center lg:items-end justify-end lg:justify-between h-full">
            <div class="flex flex-col gap-2 w-full lg:w-fit text-white mb-6 justify-center">
                <h1 class="text-white text-3xl md:text-5xl font-bold leading-1">
                    UPT Perpustakaan<br />Politeknik Negeri Sriwijaya
                </h1>
                <p class="text-sm lg:text-base">Pusat Informasi & Pengetahuan Politeknik Negeri Sriwijaya</p>
            </div>
            <div class="w-full lg:w-fit flex justify-end">
                <div class="bg-white pt-3 ps-5 w-fit rounded-tl-md flex items-center gap-5 justify-end">
                    <div>
                        <p class="m-0 p-0 font-semibold">Berita</p>
                        <p class="truncate w-40 md:w-80" id="highlight-text">
                            Loading...
                        </p>
                    </div>
                    <a href="/" id="highlight-link">
                        <button
                            class="bg-[var(--primary)] py-1.5 px-4 text-white rounded md:rounded-md text-center w-max ">
                            Selengkapnya
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", async () => {
        const bg = document.getElementById("hero-bg");

        const response = await Api.get('/api/public/contents/slide_show');
        const result = response.data.content;
        let images = result.split(";");


        // const images = [
        //     "/img/hero-background-1.png",
        //     "/img/hero-background-2.jpg",
        //     "/img/hero-background-3.jpg",
        //     "/img/hero-background-4.jpg",
        // ];

        let index = 0;
        const interval = 10000; // 5 detik
        const fadeDuration = 1000; // sesuai transition di Tailwind

        function changeBg() {
            bg.style.opacity = 0;

            setTimeout(() => {
                index = (index + 1) % images.length;
                bg.style.backgroundImage = `url('${images[index]}')`;
                bg.style.opacity = 1;
            }, fadeDuration);
        }

        setInterval(changeBg, interval);
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', async function() {
        const hightlightText = document.getElementById('highlight-text');
        const hightlightLink = document.getElementById('highlight-link');

        try {
            const response = await Api.get('/api/public/news');
            const result = response;

            if (result.status === 'success' && Array.isArray(result.data) && result.data != '') {
                filteredData = result.data.slice(0, 1)
                filteredData.forEach(item => {
                    hightlightText.innerHTML = item.content_title
                    hightlightLink.href = `/news/${item.content_path}`
                });
            } else {}
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    });
</script>
