<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>
<div class="max-w-7xl ">
    <h1 class="text-3xl font-semibold mb-6 text-[#505050]">Loan Management</h1>
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
      <div class="flex items-center gap-2">
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
      class="absolute mt-40 w-56 bg-white border border-gray-200 rounded-lg shadow-xl p-4 z-50 hidden transform origin transition-all duration-200">

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

<div class="w-full mx-auto" id="cardsContainer">
    <div class="space-y-6 flex-1" id="cards">

    </div>

    <template id="card-template" class="absolute z-100 bg-red-800">
        <div class="card-border bg-white rounded-lg border border-gray-200 p-6 shadow-sm z-100">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                <div class="md:col-span-6">
                    <div class="flex items-start justify-between">
                        <div class="text-2xl font-bold text-indigo-600 mb-1 item-code">B00002</div>
                        <div class="px-3 py-1 rounded-full status-overdue text-xs font-semibold status-badge">
                            <i class="fas fa-exclamation-circle mr-1"></i>Terlambat
                        </div>
                    </div>
                    <h2 class="text-lg font-semibold text-t-gray mb-2 book-title">PostgreSQL: A Comprehensive Guide</h2>
                </div>

                <div class="md:col-span-6 ">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-500">Tanggal Pinjam:</span>
                            <span class="text-sm font-medium text-gray-800 loan-date">15 Sep 2025</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-500">Tenggat Waktu:</span>
                            <span class="text-sm font-medium text-gray-800 due-date">22 Sep 2025</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Keterlambatan:</span>
                            <span class="text-sm font-semibold text-red-600 overdue-days">5 Hari</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-4 mt-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="text-sm text-gray-500">Status:
                        <span class="font-semibold text-red-600 overdue-status">Terlambat 5 hari</span>
                    </div>
                    <div class="px-4 py-1 rounded-lg text-white font-semibold text-sm fine-amount bg-base-blue">Rp 25.000</div>
                </div>
            </div>
        </div>
    </template>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
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
</script>

<script>
    document.addEventListener('DOMContentLoaded', async function() {
        const cardsContainer = document.getElementById('cards');
        const template = document.getElementById('card-template');

        try {
            const response = await Api.get('/api/member/fines/<?= esc(session()->get('member_id')); ?>');
            const result = response;

            if (result.status === 'success' && Array.isArray(result.data) && result.data != '') {
                result.data.forEach(item => {
                    const clone = template.content.cloneNode(true);

                    clone.querySelector('.item-code').textContent = item.item_code || '-';
                    clone.querySelector('.book-title').textContent = item.title || 'No title available';
                    clone.querySelector('.loan-date').textContent = item.loan_date || '-';
                    clone.querySelector('.due-date').textContent = item.due_date || '-';

                    const overdueDays = item.days_total || '0';
                    clone.querySelector('.overdue-days').textContent = `${overdueDays} Hari`;
                    clone.querySelector('.overdue-status').textContent =
                        overdueDays > 0 ? `Terlambat ${overdueDays} hari` : 'Tepat waktu';

                    const fineAmount = item.fine_total || '0';
                    clone.querySelector('.fine-amount').textContent =
                        fineAmount > 0 ? `Rp ${parseInt(fineAmount).toLocaleString('id-ID')}` : 'Rp 0';

                    const statusBadge = clone.querySelector('.status-badge');
                    if (overdueDays > 0) {
                        statusBadge.className = 'px-3 py-1 rounded-full status-overdue text-xs font-semibold status-badge';
                        statusBadge.innerHTML = '<i class="fas fa-exclamation-circle mr-1"></i>Terlambat';
                    } else {
                        statusBadge.className = 'px-3 py-1 rounded-full status-normal text-xs font-semibold status-badge';
                        statusBadge.innerHTML = '<i class="fas fa-check-circle mr-1"></i>Tepat Waktu';
                    }

                    cardsContainer.appendChild(clone);
                });
            } else {
                document.getElementById('cardsContainer').classList.remove('mx-auto');
                cardsContainer.innerHTML = `<div class="text-gray-500">Tidak ada peminjaman aktif</div>`;
            }
        } catch (error) {
            console.error('Error fetching fines:', error);
            cardsContainer.innerHTML = `<div class="text-center py-8 text-red-500">Terjadi kesalahan saat memuat data</div>`;
        }
    });
</script>
<?= $this->endSection(); ?>
