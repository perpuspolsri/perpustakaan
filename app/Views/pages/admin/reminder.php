<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>
<div class="max-w-7xl">
    <h1 class="text-3xl font-semibold mb-6 text-[#505050]">H-1 Reminder</h1>
    <!-- Search & Filter -->
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <div class="flex items-center gap-2">
            <!-- Search Input with Icon -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <input
                    type="text"
                    placeholder="Cari ID Anggota"
                    class="w-80 border border-gray-300 rounded-md pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-base-blue focus:border-transparent transition-all duration-200"
                    id="searchInput">
            </div>

            <!-- Dropdown Filter -->
            <button id="filterBtn" class="flex items-center px-4 py-2.5 text-sm text-[#505050] rounded-md border border-gray-300 bg-white hover:bg-gray-50 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                <span>Filter & Urutkan</span>
                <svg id="filterIcon" class="w-4 h-4 ml-2 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Dropdown -->
            <div id="dropdownMenu"
                class="absolute mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-xl p-4 z-50 hidden transform origin transition-all duration-200">

                <!-- Sort By -->
                <div class="flex items-center justify-between text-sm mb-2">
                    <span class="text-gray-500">Sort By</span>
                    <select id="sortBy"
                        class="text-gray-700 border border-gray-300 rounded-md text-sm px-2 py-1 focus:outline-none focus:ring-1 focus:ring-orange-400">
                        <option value="loan_date">Loan Date</option>
                        <option value="due_date">Due Date</option>
                        <option value="name">Name</option>
                    </select>
                </div>

                <!-- Direction -->
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500">Direction</span>
                    <select id="sortDirection"
                        class="text-gray-700 border border-gray-300 rounded-md text-sm px-2 py-1 focus:outline-none focus:ring-1 focus:ring-orange-400">
                        <option value="asc">ASC</option>
                        <option value="desc">DESC</option>
                    </select>
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
                    <p class="text-sm font-medium text-gray-600">Total</p>
                    <p class="text-2xl font-bold text-gray-900" id="total">0</p>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6 flex-1" id="cards"></div>

    <template id="card-template">
        <div class="card-border bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                <div class="md:col-span-5">
                    <div class="flex items-start justify-between mb-3">
                        <div class="text-2xl font-bold book-code text-[#505050]">B00002</div>
                    </div>
                    <h2 class="text-lg font-semibold text-t-gray mb-2 book-title">PostgreSQL : a comprehensive guide to building, programming, and administering PostgreSQL databases</h2>
                </div>

                <div class="md:col-span-4">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                            <i class="fas fa-user text-indigo-500"></i>
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-t-gray member-name">Wahid Abdul Aziz</div>
                            <div class="text-xs text-gray-500 member-id">ID: 062430701412</div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-phone-alt mr-2 text-sm w-4"></i>
                            <div class="text-sm member-phone">087893244578</div>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-envelope mr-2 text-sm w-4"></i>
                            <div class="text-sm member-email truncate">officehiddev@gmail.com</div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-100">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm text-gray-500 flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i>Pinjam:
                            </span>
                            <span class="text-sm font-medium text-gray-800 loan-date">15 Sep 2025</span>
                        </div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm text-gray-500 flex items-center">
                                <i class="fas fa-calendar-check mr-2"></i>Jatuh Tempo:
                            </span>
                            <span class="text-sm font-medium text-gray-800 due-date">22 Sep 2025</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-4 mt-4 flex flex-col md:flex-row items-start md:items-center justify-end gap-4">
                <div class="flex items-center gap-3">
                    <a href="#" class="whatsapp-btn relative group flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-green-500 to-green-600 text-white shadow-sm hover:from-green-600 hover:to-green-700 transition-all">
                        <i class="fab fa-whatsapp text-lg"></i>
                        <span>WhatsApp</span>
                    </a>

                    <button type="button" class="email-btn relative group flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-base-blue to-base-hover text-white shadow-sm">
                        <i class="fas fa-envelope text-lg"></i>
                        <span>Email</span>
                    </button>
                </div>
            </div>
        </div>
    </template>

    <div id="pagination" class="flex justify-center items-center space-x-2 mt-8">
        <button class="flex justify-center items-center rounded border border-gray-300 w-10 h-10 hover:bg-gray-300" id="prev">&lt;</button>
        <button class="flex justify-center items-center p-3 h-10" id="current">0 of 0</button>
        <button class="flex justify-center items-center rounded border border-gray-300 w-10 h-10 hover:bg-gray-300" id="next">&gt;</button>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>
<script>
    // Dropdown toggle (filter)
    const filterBtn = document.getElementById('filterBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const filterIcon = document.getElementById('filterIcon');

    filterBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle('hidden');
        filterIcon.classList.toggle('rotate-180');
    });

    window.addEventListener('click', (e) => {
        if (!dropdownMenu.contains(e.target) && !filterBtn.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
            filterIcon.classList.remove('rotate-180');
        }
    });

    // Helper safe setter
    function safeSetTextContent(element, selector, text, defaultValue = '-') {
        if (!element) return;
        const el = element.querySelector(selector);
        if (el) el.textContent = text ?? defaultValue;
    }

    // Page / state
    const searchInput = document.getElementById('searchInput');
    const sortBy = document.getElementById('sortBy');
    const sortDirection = document.getElementById('sortDirection');
    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');
    const currentBtn = document.getElementById('current');

    let currentPage = 1;
    let totalPages = 1;

    // Debounce util
    function debounce(fn, delay = 400) {
        let t;
        return (...args) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...args), delay);
        };
    }

    // Main loader
    async function loadData(page = 1) {
        const cardsContainer = document.getElementById('cards');
        const template = document.getElementById('card-template');
        const total = document.getElementById('total');

        // show loader
        cardsContainer.innerHTML = `
      <div class="flex justify-center items-center py-12">
        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500"></div>
        <span class="ml-3 text-gray-600">Memuat data...</span>
      </div>`;

        const params = new URLSearchParams();
        params.append('page', page);
        const s = searchInput.value.trim();
        if (s) params.append('search', s);
        if (sortBy.value) params.append('sortBy', sortBy.value);
        if (sortDirection.value) params.append('sortDirection', sortDirection.value);

        try {
            // expected API: /api/admin/fines/reminder?page=1&search=...&sortBy=...&sortDirection=...
            const response = await Api.get(`/api/admin/fines/reminder?${params.toString()}`);
            const result = response;

            total.innerHTML = result.pagination.total

            cardsContainer.innerHTML = '';

            if (result && result.status === 'success' && Array.isArray(result.data) && result.data.length > 0) {
                // read pagination meta (adjust keys based on your API)
                currentPage = result.pagination.currentPage ?? 1;
                totalPages = result.pagination.pageCount ?? 1;

                result.data.forEach(item => {
                    const clone = template.content.cloneNode(true);
                    const card = clone.querySelector('.card-border');
                    if (!card) return; // safety

                    // fill values using classes present in template
                    safeSetTextContent(card, '.book-code', item.item_code || '-');
                    safeSetTextContent(card, '.book-title', item.title || '-');
                    safeSetTextContent(card, '.member-name', item.member_name || '-');
                    safeSetTextContent(card, '.member-id', item.member_id ? `ID: ${item.member_id}` : '-');
                    safeSetTextContent(card, '.member-phone', item.member_phone || '-');
                    safeSetTextContent(card, '.member-email', item.member_email || '-');

                    const loanDateText = item.loan_date ? formatDate(item.loan_date) : '-';
                    const dueDateText = item.due_date ? formatDate(item.due_date) : '-';
                    safeSetTextContent(card, '.loan-date', loanDateText);
                    safeSetTextContent(card, '.due-date', dueDateText);

                    // Whatsapp button (select by class)
                    const whatsappBtn = card.querySelector('.whatsapp-btn');
                    if (whatsappBtn) {
                        if (item.member_phone) {
                            const phone = (item.member_phone || '').replace(/\D/g, '');
                            const message = `Halo ${item.member_name || ''}, ini pengingat untuk pengembalian buku "${item.title || ''}" yang akan jatuh tempo. Mohon cek ya.`;
                            whatsappBtn.href = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
                            whatsappBtn.target = '_blank';
                            whatsappBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                        } else {
                            whatsappBtn.removeAttribute('href');
                            whatsappBtn.classList.add('opacity-50', 'cursor-not-allowed');
                            whatsappBtn.addEventListener('click', e => e.preventDefault());
                        }
                    }

                    // Email button
                    const emailBtn = card.querySelector('.email-btn');
                    if (emailBtn) {
                        if (item.member_email) {
                            emailBtn.disabled = false;
                            emailBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                            // bind click once per element (closure per card)
                            emailBtn.addEventListener('click', async () => {
                                Swal.fire({
                                    title: 'Mengirim Email...',
                                    text: 'Mohon tunggu sebentar.',
                                    allowOutsideClick: false,
                                    didOpen: () => Swal.showLoading()
                                });
                                try {
                                    const res = await Api.post(`/api/admin/service/email/${item.loan_id}`);
                                    Swal.close();
                                    if (res.status === 'success') {
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: `Email berhasil dikirim ke ${item.member_name}`,
                                            icon: 'success',
                                            confirmButtonColor: '#16476A'
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: res.message || 'Terjadi kesalahan saat mengirim email.',
                                            icon: 'error',
                                            confirmButtonColor: '#16476A'
                                        });
                                    }
                                } catch (err) {
                                    Swal.close();
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Tidak dapat mengirim email. Periksa koneksi atau server.',
                                        icon: 'error',
                                        confirmButtonColor: '#16476A'
                                    });
                                }
                            }, {
                                once: true
                            }); // once: avoid multiple identical listeners if re-rendered
                        } else {
                            emailBtn.disabled = true;
                            emailBtn.classList.add('opacity-50', 'cursor-not-allowed');
                        }
                    }

                    cardsContainer.appendChild(clone);
                });

                // update pagination UI
                currentBtn.textContent = `${currentPage} of ${totalPages}`;
                prevBtn.disabled = currentPage <= 1;
                nextBtn.disabled = currentPage >= totalPages;
                prevBtn.classList.toggle('opacity-50', currentPage <= 1);
                nextBtn.classList.toggle('opacity-50', currentPage >= totalPages);
            } else {
                // no data
                currentBtn.textContent = `0 of 0`;
                cardsContainer.innerHTML = `
          <div class="text-center py-12">
            <div class="text-gray-400 text-6xl mb-4"><i class="fas fa-inbox"></i></div>
            <div class="text-gray-500 text-lg">Tidak ada data</div>
            <p class="text-gray-400 mt-2">Tidak ada pengingat untuk saat ini</p>
          </div>`;
            }
        } catch (err) {
            console.error('Error fetching fines:', err);
            cardsContainer.innerHTML = `
        <div class="text-center py-12">
          <div class="text-red-400 text-6xl mb-4"><i class="fas fa-exclamation-triangle"></i></div>
          <div class="text-red-500 text-lg">Gagal memuat data</div>
          <p class="text-gray-500 mt-2">Silakan refresh halaman atau coba lagi nanti</p>
          <button class="mt-4 px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition-colors" onclick="location.reload()">
            <i class="fas fa-redo mr-2"></i>Refresh Halaman
          </button>
        </div>`;
        }
    }

    // small date formatter
    function formatDate(d) {
        try {
            const dt = new Date(d);
            if (isNaN(dt)) return '-';
            return dt.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            });
        } catch {
            return '-';
        }
    }

    // Events
    const debouncedLoad = debounce(() => loadData(1), 400);
    searchInput.addEventListener('input', debouncedLoad);
    sortBy.addEventListener('change', () => loadData(1));
    sortDirection.addEventListener('change', () => loadData(1));

    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) loadData(currentPage - 1);
    });
    nextBtn.addEventListener('click', () => {
        if (currentPage < totalPages) loadData(currentPage + 1);
    });

    // initial load
    document.addEventListener('DOMContentLoaded', () => loadData(1));
</script>
<?= $this->endSection(); ?>
