<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>
<div class="max-w-7xl">
    <h1 class="text-3xl font-semibold mb-7 text-[#505050]">News Management</h1>

    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <button class="bg-base-blue hover:bg-base-hover text-white px-4 py-2.5 rounded-md flex items-center space-x-2 transition-all duration-200 shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <a href="<?= base_url('admin/add-news-management'); ?>" class="font-medium">Tambah Berita</a>
        </button>

        <div class="flex items-center gap-3">
            <!-- Search Input  -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <input
                    type="text"
                    placeholder="Cari judul atau deskripsi berita..."
                    class="w-80 border border-gray-300 rounded-md pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-base-blue focus:border-transparent transition-all duration-200"
                    id="searchInput">
            </div>

            <!-- Filter Dropdown -->
            <div class="relative">
                <button id="filterBtn" class="flex items-center px-4 py-2.5 text-sm text-[#505050] rounded-md border border-gray-300 bg-white hover:bg-gray-50 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    <span>Filter & Urutkan</span>
                    <svg id="filterIcon" class="w-4 h-4 ml-2 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-72 bg-white border border-gray-200 rounded-lg shadow-xl p-4 z-50 hidden transform origin-top-right transition-all duration-200">
                    <div class="space-y-4">
                        <!-- Sort By -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan Berdasarkan</label>
                            <select id="sortBy" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-base-blue transition-colors duration-200">
                                <option value="last_update">Tanggal Update</option>
                                <option value="publish_date">Tanggal Publikasi</option>
                                <option value="content_title">Judul Berita</option>
                                <option value="input_date">Tanggal Input</option>
                            </select>
                        </div>

                        <!-- Direction -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                            <select id="sortDirection" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-base-blue transition-colors duration-200">
                                <option value="desc">Terbaru - Terlama</option>
                                <option value="asc">Terlama - Terbaru</option>
                            </select>
                        </div>

                        <!-- Apply Button -->
                        <button id="applyFilter" class="w-full bg-base-blue hover:bg-base text-white py-2.5 rounded-md text-sm font-medium transition-colors duration-200">
                            Terapkan Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
                    <p class="text-sm font-medium text-gray-600">Total Berita</p>
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
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada berita ditemukan</h3>
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
                            <span class="date-badge bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full text-xs font-medium"></span>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-4 line-clamp-3"></p>

                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="publish-date"></span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="last-update"></span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center space-x-2 lg:flex-col lg:space-x-0 lg:space-y-2">
                    <button class="edit-btn bg-base-blue hover:bg-base-hover   text-white p-2.5 rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md tooltip">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                        <span class="tooltip-text">Edit Berita</span>
                    </button>
                    <button class="delete-btn bg-red-600 hover:bg-red-700 text-white p-2.5 rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md tooltip">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        <span class="tooltip-text">Hapus Berita</span>
                    </button>
                </div>
            </div>
        </div>
    </template>

    <div id="pagination" class="flex justify-center items-center space-x-2 mt-8">
        <button class="flex justify-center items-center rounded border border-gray-300 w-10 h-10 hover:bg-gray-300" id="prev">
            <</button>
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
            this.currentPage = 1;
            this.perPage = 10;
            this.searchKeyword = '';
            this.sortBy = 'last_update';
            this.sortDirection = 'desc';
            this.statusFilter = 'all';

            this.init();
        }

        init() {
            this.bindEvents();
            this.loadNews();
            this.setupPagination();
        }

        bindEvents() {
            // 🔍 Search
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', this.debounce(() => {
                this.searchKeyword = searchInput.value.trim();
                this.currentPage = 1;
                this.loadNews();
            }, 500));

            // 🔽 Filter dropdown
            const filterBtn = document.getElementById('filterBtn');
            const dropdownMenu = document.getElementById('dropdownMenu');

            filterBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
                document.getElementById('filterIcon').classList.toggle('rotate-180');
            });

            document.addEventListener('click', (e) => {
                if (!dropdownMenu.contains(e.target) && !filterBtn.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                    document.getElementById('filterIcon').classList.remove('rotate-180');
                }
            });

            // 🧩 Apply filter
            document.getElementById('applyFilter').addEventListener('click', () => {
                this.sortBy = document.getElementById('sortBy').value;
                this.sortDirection = document.getElementById('sortDirection').value;
                this.currentPage = 1;
                this.loadNews();
                dropdownMenu.classList.add('hidden');
            });

            // 🔄 Reset filter
            document.getElementById('resetFilters').addEventListener('click', () => {
                this.resetFilters();
            });
        }

        async loadNews() {
            this.showLoading();
            this.hideEmptyState();

            // 🔥 Build query params lengkap
            const params = new URLSearchParams({
                search: this.searchKeyword,
                orderBy: this.sortBy,
                direction: this.sortDirection,
                page: this.currentPage,
                perPage: this.perPage
            });

            try {
                const newsData = await Api.get(`/api/public/news?${params.toString()}`);
                const data = newsData.data;

                document.getElementById('totalNews').textContent = newsData.pagination?.total || 0;
                this.renderNews(data);
                this.updatePagination(newsData.pagination || {
                    currentPage: 1,
                    pageCount: 1
                });
                this.hideLoading();

                if (!data || data.length === 0) this.showEmptyState();
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
                const cardElement = card.querySelector('.card-border');

                card.querySelector('h3').textContent = news.content_title;
                card.querySelector('p').innerHTML = this.truncateText(news.content_desc, 150);

                const statusBadge = card.querySelector('.status-badge');
                statusBadge.textContent = news.is_draft == '1' ? 'Draft' : 'Published';
                if (news.is_draft == '1') {
                    statusBadge.classList.add('bg-yellow-100', 'text-yellow-700');
                } else {
                    statusBadge.classList.add('bg-green-100', 'text-green-700');
                }

                card.querySelector('.date-badge').textContent = this.formatDate(news.publish_date);
                card.querySelector('.publish-date').textContent = `Publikasi: ${this.formatDate(news.publish_date)}`;
                card.querySelector('.last-update').textContent = `Update: ${this.formatRelativeTimeCustom(news.last_update)}`;

                card.querySelector('.edit-btn').addEventListener('click', () => this.editNews(news.content_id));
                card.querySelector('.delete-btn').addEventListener('click', () => this.deleteNews(news.content_id, cardElement));

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
            current.textContent = `${pagination.currentPage} of ${pagination.pageCount}`;
        }

        debounce(func, wait) {
            let timeout;
            return (...args) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => func(...args), wait);
            };
        }

        truncateText(text, maxLength) {
            if (!text) return 'Tidak ada deskripsi';
            if (text.length <= maxLength) return text;
            return text.substr(0, maxLength) + '...';
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
            const toastMessage = document.getElementById('toast-message');
            toastMessage.textContent = message;
            toast.classList.remove('translate-x-full');
            setTimeout(() => toast.classList.add('translate-x-full'), 3000);
        }

        resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('sortBy').value = 'last_update';
            document.getElementById('sortDirection').value = 'desc';
            this.searchKeyword = '';
            this.sortBy = 'last_update';
            this.sortDirection = 'desc';
            this.currentPage = 1;
            this.loadNews();
        }

        editNews(id) {
            window.location.href = `add-news-management/${id}`;
        }

        async deleteNews(id, cardElement) {
            if (confirm('Yakin hapus berita ini?')) {
                cardElement.style.opacity = '0.5';
                await Api.post(`/api/admin/news/delete/${id}`);
                cardElement.remove();
                this.showToast('Berita berhasil dihapus', 'success');
                this.loadNews();
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        new NewsManager();
    });
</script>

<?= $this->endSection(); ?>
