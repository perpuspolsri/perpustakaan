<?= $this->extend("pages/public/layouts/main") ?>

<?= $this->section('content'); ?>
<?= $this->include("pages/public/layouts/nav") ?>

<div class="p-8 w-full h-fit pt-20">
    <div class="w-full h-fit relative overflow-hidden bg-black rounded-md">
        <div
            id="hero-bg"
            class="absolute inset-0 bg-cover bg-center transition-opacity duration-500 ease-in-out"
            style="background-image: url('/img/DSC01911-min.JPG');" data-aos="zoom-out" data-aos-duration="2000">
            <div class="absolute inset-0 bg-black opacity-60"></div>
        </div>

        <div class="my-20 relative z-10 px-8 md:px-80 py-20 flex flex-col gap-3 justify-between h-full">
            <h1 class="text-white font-semibold text-5xl text-center" data-aos="fade-up" data-aos-duration="1000">Berita</h1>
        </div>
    </div>
</div>

<div class="w-full py-10 pt-7 px-8 lg:px-40 mt-5 mb-5">
    <div class="pb-20 w-full flex flex-col gap-4 font-gabarito">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5" id="news-wrapper">
        </div>
    </div>
    <div id="pagination" class="flex justify-center items-center space-x-2">
        <button class="flex justify-center items-center rounded border border-gray-300 p-3 h-10 hover:bg-gray-300" id="next">Tampilkan Lebih Banyak</button>
    </div>
</div>

<?= $this->include("pages/public/layouts/footer") ?>
<script>
    class NewsManager {
        constructor() {
            this.currentPage = 1;
            this.perPage = 6;
            this.init();
        }

        init() {
            this.loadNews();
            this.setupPagination();
            this.setupIntersectionObserver();
        }

        formatDate(dateString) {
            return new Date(dateString).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        }

        formatRelativeTimeCustom(datetimeStr) {
            if (!datetimeStr) return '-';
            const date = new Date(datetimeStr);
            const diff = (new Date() - date) / (1000 * 60 * 60);
            if (diff < 1) return 'Baru saja';
            if (diff < 24) return `${Math.floor(diff)} jam lalu`;
            if (diff < 48) return 'Kemarin';
            return this.formatDate(datetimeStr);
        }

        async loadNews() {
            try {
                const newsData = await Api.get(`/api/public/news?page=${this.currentPage}`);
                const data = newsData.data;

                if (data && data.length > 0) {
                    this.renderNews(data);
                }
            } catch (error) {
                console.error("Gagal load news:", error);
            }
        }

        // ========================
        // RENDER KARTU BERITA
        // ========================
        renderNews(newsData) {
            const newsWrapper = document.getElementById('news-wrapper');

            newsData.forEach(news => {
                const card = document.createElement("div");
                card.className = "p-5 border border-gray-300 flex flex-col gap-1 rounded-md card-border opacity-0";

                card.innerHTML = `
                    <p class="text-gray-600">${this.formatRelativeTimeCustom(news.last_update)}</p>
                    <h2 class="text-lg font-bold text-[var(--primary)]">${news.content_title}</h2>
                    <p class="text-gray-800 line-clamp-3 text-justify leading-5">${news.content_desc}</p>
                    <a href="/news/${news.content_path}" class="text-[var(--primary)]">Selengkapnya</a>
                `;

                newsWrapper.appendChild(card);
            });

            // aktifkan animation observer
            this.observeCards();
        }

        // ========================
        // PAGINATION (NEXT ONLY)
        // ========================
        setupPagination() {
            const nextBtn = document.getElementById('next');

            nextBtn.addEventListener('click', () => {
                this.currentPage++;
                this.loadNews();
            });
        }

        // ========================
        // ANIMASI MUNCUL (fade-in)
        // ========================
        setupIntersectionObserver() {
            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                        entry.target.classList.remove('opacity-0');
                    }
                });
            });
        }

        observeCards() {
            document.querySelectorAll('.card-border').forEach(card => {
                this.observer.observe(card);
            });
        }

    }

    document.addEventListener('DOMContentLoaded', () => {
        new NewsManager();
    });
</script>

<style>
    /* optional: animasi fade-in */
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0px);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.6s ease forwards;
    }
</style>


<!-- <p>asdasd</p> -->
<?= $this->endSection(); ?>
