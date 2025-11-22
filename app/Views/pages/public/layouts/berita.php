<div class="px-8 md:px-20 pt-40 w-full flex flex-col gap-4 font-gabarito">
    <div class="w-full flex justify-between items-end">
        <div>
            <h2 class="text-[var(--primary)] text-xl font-bold">Berita</h2>
            <p>Berita terkini di Perpustakaan Polsri</p>
        </div>
        <a href="/news">
            <p class="text-gray-500">Selengkapnya</p>
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3" id="news-wrapper">
        <!-- <div class="p-5 border border-gray-300 flex flex-col gap-1 rounded-md">
            <p class="text-gray-600">Selasa, 15 Juli 2025</p>
            <h2 class="text-lg font-bold text-[var(--primary)]">Membangun Generasi Cerdas Dengan Budaya Literasi</h2>
            <p class="text-gray-800 line-clamp-2 text-justify leading-5">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis accusamus, sit ad sapiente deserunt, consectetur amet eos, quisquam nemo temporibus magnam illo necessitatibus quasi! A dolor harum laudantium vero in?</p>
            <p class="text-[var(--primary)]">Selengkapnya</p>
        </div> -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', async function() {
        const newsWrapper = document.getElementById('news-wrapper');

        function formatDate(dateString) {
            return new Date(dateString).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        }

        function formatRelativeTimeCustom(datetimeStr) {
            if (!datetimeStr) return '-';
            const date = new Date(datetimeStr);
            const diff = (new Date() - date) / (1000 * 60 * 60);
            if (diff < 1) return 'Baru saja';
            if (diff < 24) return `${Math.floor(diff)} jam lalu`;
            if (diff < 48) return 'Kemarin';
            return formatDate(datetimeStr);
        }

        try {
            const response = await Api.get('/api/public/news');
            const result = response;

            if (result.status === 'success' && Array.isArray(result.data) && result.data != '') {
                filteredData = result.data.slice(0, 6)
                filteredData.forEach(item => {
                    const card = document.createElement("div")
                    card.className = "p-5 border border-gray-300 flex flex-col gap-1 rounded-md h-full transition-all duration-300 ease-in-out hover:shadow-lg"

                    const date = document.createElement("p")
                    date.className = "text-gray-600"
                    date.innerHTML = formatRelativeTimeCustom(item.last_update)

                    const title = document.createElement("h2")
                    title.className = "text-lg font-bold text-[var(--primary)] leading-5"
                    title.innerHTML = item.content_title

                    const body = document.createElement("p")
                    body.className = "text-gray-800 line-clamp-1 leading-5"
                    body.innerHTML = item.content_desc

                    const anchor = document.createElement("a")
                    anchor.className = "h-full"
                    anchor.href = `/news/${item.content_path}`

                    card.appendChild(title)
                    card.appendChild(body)
                    card.appendChild(date)
                    anchor.appendChild(card)

                    newsWrapper.appendChild(anchor)
                });
            } else {}
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    });
</script>
