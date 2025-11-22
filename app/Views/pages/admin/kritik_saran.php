<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>
<div class="max-w-7xl">
    <h1 class="text-3xl font-semibold mb-7 text-[#505050]">Kritik & Saran</h1>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
        <div class="flex items-center">
            <div class="p-2 bg-blue-100 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v12m0 0h6m-6 0h6"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Kritik & Saran</p>
                <p class="text-2xl font-bold text-gray-900" id="totalNews">0</p>
            </div>
        </div>
    </div>
</div>

<!-- Loading State -->
<div id="loadingState" class="hidden">
    <div class="flex justify-center items-center py-12">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-base-blue"></div>
    </div>
</div>

<!-- Empty State -->
<div id="emptyState" class="hidden text-center py-12">
    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada kritik & saran yang ditemukan</h3>
    <p class="text-gray-500 mb-4">Coba ubah kata kunci pencarian atau filter yang Anda gunakan.</p>
    <button id="resetFilters" class="bg-base-blue hover:bg-[#e77f35] text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">
        Reset Filter
    </button>
</div>

<div id="cards" class="space-y-4">
    <!-- Cards will be dynamically inserted here -->
</div>

<template id="card-template">
    <div class="card-border bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-200">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
            <div class="flex-1">
                <div class="flex items-start justify-between mb-3">
                    <h3 class="text-xl font-semibold text-gray-800 pr-4"></h3>
                    <div class="flex items-center space-x-2 flex-shrink-0">
                        <span class="status-badge px-2.5 py-1 rounded-full text-xs font-medium"></span>
                    </div>
                </div>
                <p class="text-gray-600 leading-relaxed mb-4"></p>

                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="last-update"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<div id="pagination" class="flex justify-center items-center space-x-2 mt-8">
    <button class="flex justify-center items-center rounded border border-gray-300 w-10 h-10 hover:bg-gray-300" id="prev"><</button>
    <button class="flex justify-center items-center p-3 h-10" id="current">0 of 0</button>
    <button class="flex justify-center items-center rounded border border-gray-300 w-10 h-10 hover:bg-gray-300" id="next">></button>
</div>
</div>

<div id="toast" class="fixed top-4 right-4 transform translate-x-full transition-transform duration-300 z-50">
    <div class="bg-gray-800 text-white px-6 py-4 rounded-lg shadow-lg max-w-sm">
        <div class="flex items-center space-x-3">
            <svg id="toast-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
            <p id="toast-message" class="text-sm"></p>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    class NewsManager {
        constructor() {
            this.currentPage = 1; // halaman awal
            this.perPage = 6;
            this.searchKeyword = '';
            this.sortBy = 'last_update';
            this.sortDirection = 'asc';
            this.statusFilter = 'all';

            this.init();
        }

        init() {
            this.loadNews();
            this.setupPagination(); // setup tombol prev/next
            this.setupIntersectionObserver();
        }

        async loadNews() {
            this.showLoading();
            this.hideEmptyState();

            try {
                // ambil data berdasarkan halaman aktif
                const newsData = await Api.get(`/api/admin/kritiksaran?page=${this.currentPage}`);
                const data = newsData.data;

                document.getElementById('totalNews').textContent = newsData.pagination.total || 0;
                this.renderNews(data);
                this.updatePagination(newsData.pagination);
                this.hideLoading();

                if (!data.length) this.showEmptyState();
            } catch (error) {
                this.hideLoading();
                console.error(error);
                this.showToast('Terjadi kesalahan saat memuat data', 'error');
            }
        }

        renderNews(newsData) {
            const cardsContainer = document.getElementById('cards');
            const template = document.getElementById('card-template');
            cardsContainer.innerHTML = '';

            newsData.forEach(news => {
                const card = template.content.cloneNode(true);
                card.querySelector('h3').textContent = news.email;
                card.querySelector('p').innerHTML = news.message;
                card.querySelector('.last-update').textContent =
                    `${this.formatRelativeTimeCustom(news.last_update)}`;
                cardsContainer.appendChild(card);
            });
        }

        setupPagination() {
            const nextBtn = document.getElementById('next');
            const prevBtn = document.getElementById('prev');

            nextBtn.addEventListener('click', () => {
                this.currentPage++;
                this.loadNews();
            });

            prevBtn.addEventListener('click', () => {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.loadNews();
                }
            });
        }

        updatePagination(pagination) {
            const current = document.getElementById('current');
            current.textContent = `${pagination.currentPage} of ${pagination.pageCount || 1}`;
        }

        // Fungsi lain tetap sama
        formatRelativeTimeCustom(datetimeStr) {
            if (!datetimeStr) return 'Tidak ada data waktu';
            try {
                const [datePart, timePart] = datetimeStr.split(' ');
                const [year, month, day] = datePart.split('-').map(Number);
                const [hour, minute, second] = timePart.split(':').map(Number);

                const utcTimestamp = Date.UTC(year, month - 1, day, hour, minute, second);
                const wibTimestamp = utcTimestamp - (7 * 60 * 60 * 1000);
                const date = new Date(wibTimestamp);

                const now = new Date();
                const diffMs = now - date;
                const diffHours = Math.floor(diffMs / (1000 * 60 * 60));

                if (diffHours < 1) return 'Baru saja';
                if (diffHours < 24) return `${diffHours} jam lalu`;
                if (diffHours < 48) return 'Kemarin';
                return date.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            } catch (e) {
                console.error('Error parsing date:', datetimeStr, e);
                return 'Format waktu tidak valid';
            }
        }

        showLoading() {
            document.getElementById('loadingState').classList.remove('hidden');
            document.getElementById('cards').classList.add('hidden');
        }

        hideLoading() {
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('cards').classList.remove('hidden');
        }

        showEmptyState() {
            document.getElementById('emptyState').classList.remove('hidden');
        }

        hideEmptyState() {
            document.getElementById('emptyState').classList.add('hidden');
        }

        showToast(message, type = 'info') {
            const toast = document.getElementById('toast');
            const toastIcon = document.getElementById('toast-icon');
            const toastMessage = document.getElementById('toast-message');

            let iconPath = '';
            switch (type) {
                case 'success':
                    iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
                    break;
                case 'error':
                    iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                    break;
                default:
                    iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
            }

            toastIcon.innerHTML = iconPath;
            toastMessage.textContent = message;
            toast.classList.remove('translate-x-full');

            setTimeout(() => {
                toast.classList.add('translate-x-full');
            }, 3000);
        }

        setupIntersectionObserver() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('.card-border').forEach(card => {
                    observer.observe(card);
                });
            });
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        new NewsManager();
    });
</script>

<?= $this->endSection(); ?>
