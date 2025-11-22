<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>
<div class="max-w-7xl">
    <h1 class="text-3xl font-semibold mb-6 text-[#505050]">Fines Management</h1>
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
</div>

<div class="max-w-6xl">

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
                    <p class="text-sm font-medium text-gray-600">Total Denda</p>
                    <p class="text-2xl font-bold text-gray-900" id="totalFines">0</p>
                </div>
            </div>
        </div>
    </div>
    <div class="space-y-6 flex-1" id="cards">

    </div>

    <template id="card-template">
        <div class="card-border bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start card-grid">
                <div class="md:col-span-6">
                    <div class="flex items-start justify-between mb-3">
                        <div class="text-2xl font-bold book-code item-code">B00002</div>
                        <div class="status-badge px-3 py-1 rounded-full text-xs font-semibold">
                            <i class="fas fa-clock mr-1"></i><span class="status-text">Aktif</span>
                        </div>
                    </div>
                    <h2 class="text-lg font-semibold text-t-gray mb-2 book-title">PostgreSQL : a comprehensive guide to building, programming, and administering PostgreSQL databases</h2>
                </div>

                <div class="md:col-span-3">
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
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Keterlambatan:
                            </span>
                            <span class="text-sm font-semibold overdue-days">0 Hari</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-4 mt-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="text-sm text-gray-500">Status:
                        <span class="font-semibold overdue-status">Tepat waktu</span>
                    </div>
                    <div class="fine-badge px-4 py-2 rounded-lg text-white font-semibold text-sm fine-amount bg-gradient-to-r from-base-blue to-base-hover shadow-md">
                        <i class="fas fa-money-bill-wave mr-2"></i>Rp 0
                    </div>
                </div>

                <div class="flex items-center gap-3 action-buttons">
                    <a href="#" class="relative group action-btn flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-green-500 to-green-600 text-white shadow-sm hover:from-green-600 hover:to-green-700 transition-all">
                        <i class="fab fa-whatsapp text-lg"></i>
                        <span>WhatsApp</span>

                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-2 bg-gray-800 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-10">
                            Kirim reminder WhatsApp
                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                        </div>
                    </a>

                    <button type="button" class="relative group action-btn email-btn flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-base-blue to-base-hover text-white shadow-sm  transition-all">
                        <i class="fas fa-envelope text-lg"></i>
                        <span>Email</span>

                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-2 bg-gray-800 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-10">
                            Kirim reminder email
                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                        </div>
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
    </script>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    const filterBtn = document.getElementById('filterBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const filterIcon = document.getElementById('filterIcon');
    const searchInput = document.getElementById('searchInput');
    const sortBy = document.getElementById('sortBy');
    const sortDirection = document.getElementById('sortDirection');

    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');
    const currentBtn = document.getElementById('current');

    let currentPage = 1;
    let totalPages = 1;

    // 🔽 Filter button toggle
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

    // ✅ Safe text setter
    function safeSetTextContent(element, selector, text, defaultValue = '-') {
        const targetElement = element.querySelector(selector);
        if (targetElement) targetElement.textContent = text || defaultValue;
    }

    // ✅ Style setter
    function setStatusStyles(card, daysTotal, fineTotal) {
        const statusBadge = card.querySelector('.status-badge');
        const statusText = card.querySelector('.status-text');
        const overdueStatus = card.querySelector('.overdue-status');
        const fineBadge = card.querySelector('.fine-badge');
        const days = parseInt(daysTotal) || 0;
        const fine = parseInt(fineTotal) || 0;

        if (days === 0) {
            statusBadge.className = 'status-normal px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700';
            statusText.textContent = 'Tepat Waktu';
            overdueStatus.textContent = 'Tepat waktu';
            overdueStatus.className = 'font-semibold text-green-600';
        } else if (days <= 3) {
            statusBadge.className = 'status-warning px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700';
            statusText.textContent = `${days} Hari Terlambat`;
            overdueStatus.textContent = `Terlambat ${days} hari`;
            overdueStatus.className = 'font-semibold text-amber-500';
        } else {
            statusBadge.className = 'status-overdue px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700';
            statusText.textContent = `${days} Hari Terlambat`;
            overdueStatus.textContent = `Terlambat ${days} hari`;
            overdueStatus.className = 'font-semibold text-red-600';
        }

        fineBadge.innerHTML = fine > 0 ?
            `<i class="fas fa-money-bill-wave mr-2"></i>Rp ${fine.toLocaleString('id-ID')}` :
            `<i class="fas fa-check-circle mr-2"></i>Rp 0`;
    }

    // ✅ Load data dengan pagination
    async function loadData(page = 1) {
        const cardsContainer = document.getElementById('cards');
        const template = document.getElementById('card-template');
        const totalFines = document.getElementById('totalFines');

        cardsContainer.innerHTML = `
            <div class="flex justify-center items-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500"></div>
                <span class="ml-3 text-gray-600">Memuat data peminjaman...</span>
            </div>`;

        const search = searchInput.value.trim();
        const sortField = sortBy.value;
        const sortDir = sortDirection.value;

        try {
            const params = new URLSearchParams();
            params.append('page', page);
            if (search) params.append('search', search);
            if (sortField) params.append('sortBy', sortField);
            if (sortDir) params.append('direction', sortDir);

            const response = await Api.get(`/api/admin/fines/?${params.toString()}`);
            const result = response;

            totalFines.innerHTML = result.pagination.total
            cardsContainer.innerHTML = '';

            if (result.status === 'success' && Array.isArray(result.data) && result.data.length > 0) {
                // ambil pagination info dari response
                currentPage = result.pagination.currentPage || 1;
                totalPages = result.pagination.pageCount || 1;

                // render data
                result.data.forEach(item => {
                    const clone = template.content.cloneNode(true);
                    const card = clone.querySelector('.card-border');

                    safeSetTextContent(card, '.item-code', item.item_code);
                    safeSetTextContent(card, '.book-title', item.title);
                    safeSetTextContent(card, '.member-name', item.member_name);
                    safeSetTextContent(card, '.member-id', `ID: ${item.member_id}`);
                    safeSetTextContent(card, '.member-phone', item.member_phone);
                    safeSetTextContent(card, '.member-email', item.member_email);

                    const loanDate = item.loan_date ?
                        new Date(item.loan_date).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'short',
                            year: 'numeric'
                        }) : '-';
                    const dueDate = item.due_date ?
                        new Date(item.due_date).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'short',
                            year: 'numeric'
                        }) : '-';

                    safeSetTextContent(card, '.loan-date', loanDate);
                    safeSetTextContent(card, '.due-date', dueDate);
                    safeSetTextContent(card, '.overdue-days', `${item.days_total || '0'} Hari`);
                    setStatusStyles(card, item.days_total, item.fine_total);

                    // WA Button
                    const whatsappBtn = card.querySelector('a[href="#"]');
                    if (item.member_phone) {
                        const phone = item.member_phone.replace(/\D/g, '');
                        const message = `Halo ${item.member_name}, ini pengingat untuk pengembalian buku "${item.title}" yang sudah melewati batas waktu peminjaman. Mohon segera dikembalikan. Terima kasih.`;
                        whatsappBtn.href = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
                        whatsappBtn.target = '_blank';
                    } else {
                        whatsappBtn.classList.add('opacity-50', 'cursor-not-allowed');
                        whatsappBtn.addEventListener('click', e => e.preventDefault());
                    }

                    // Email Button
                    const emailBtn = card.querySelector('.email-btn');
                    if (item.member_email) {
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
                                Swal.fire({
                                    title: res.status === 'success' ? 'Berhasil!' : 'Gagal!',
                                    text: res.status === 'success' ?
                                        `Email berhasil dikirim ke ${item.member_name}` : res.message || 'Terjadi kesalahan saat mengirim email.',
                                    icon: res.status === 'success' ? 'success' : 'error',
                                    confirmButtonColor: '#16476A'
                                });
                            } catch {
                                Swal.close();
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Tidak dapat mengirim email. Periksa koneksi atau server.',
                                    icon: 'error',
                                    confirmButtonColor: '#16476A'
                                });
                            }
                        });
                    } else {
                        emailBtn.classList.add('opacity-50', 'cursor-not-allowed');
                        emailBtn.disabled = true;
                    }

                    cardsContainer.appendChild(clone);
                });

                // update pagination indicator
                currentBtn.textContent = `${currentPage} of ${totalPages}`;
                prevBtn.disabled = currentPage <= 1;
                nextBtn.disabled = currentPage >= totalPages;
                prevBtn.classList.toggle('opacity-50', currentPage <= 1);
                nextBtn.classList.toggle('opacity-50', currentPage >= totalPages);

            } else {
                cardsContainer.innerHTML = `
                    <div class="text-center py-12">
                        <div class="text-gray-400 text-6xl mb-4"><i class="fas fa-inbox"></i></div>
                        <div class="text-gray-500 text-lg">Tidak ada data peminjaman</div>
                        <p class="text-gray-400 mt-2">Semua buku telah dikembalikan tepat waktu</p>
                    </div>`;
                currentBtn.textContent = `0 of 0`;
            }
        } catch (error) {
            console.error('Error fetching fines:', error);
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

    // ✅ Event handler
    document.addEventListener('DOMContentLoaded', () => loadData());
    searchInput.addEventListener('input', debounce(() => loadData(1), 400));
    sortBy.addEventListener('change', () => loadData(1));
    sortDirection.addEventListener('change', () => loadData(1));

    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) loadData(currentPage - 1);
    });
    nextBtn.addEventListener('click', () => {
        if (currentPage < totalPages) loadData(currentPage + 1);
    });

    // ✅ debounce helper
    function debounce(func, delay) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }
</script>

<?= $this->endSection(); ?>
