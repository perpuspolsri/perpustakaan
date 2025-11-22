<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 id="titlePage" class="text-3xl font-bold text-t-gray">Tulis Berita Baru</h1>
        <div class="flex space-x-4">
            <button id="backBtn" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </button>
            <button id="saveDraftBtn" class="px-4 py-2 bg-b-green text-white   rounded-lg hover:bg-b-green-hover transition duration-200 flex items-center">
                <i class="fas fa-save mr-2"></i> Simpan Draft
            </button>
            <button id="publishBtn" type="button" onclick="createNews()" class="px-4 py-2 bg-base-blue text-white rounded-lg hover:bg-base-hover transition duration-200 flex items-center">
                <i class="fas fa-paper-plane mr-2"></i> Publikasikan
            </button>
        </div>
    </div>

    <div class="bg-white  rounded-lg border border-gray-200 shadow-sm p-8">
        <div class="mb-6">
            <div class="flex items-center">
                <span class="text-sm font-bold text-t-gray mr-4">Status :</span>
                <div id="statusIndicator" class="px-3 py-1 rounded-full text-white text-sm font-medium status-draft">
                    Draft
                </div>
            </div>
        </div>

        <div class="w-full px-6">
            <form id="newsForm" class="w-full grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-t-gray mb-2">Judul Berita</label>
                        <input type="text" id="title"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Masukkan judul berita yang menarik">
                    </div>

                    <div>
                        <label for="body" class="block text-sm font-medium text-t-gray mb-2">Isi Berita</label>
                        <div id="editor-container">
                            <textarea id="body" class="hidden"></textarea>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="slug" class="block text-sm font-medium text-t-gray mb-2">Slug (URL)</label>
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                berita/
                            </span>
                            <input type="text" id="slug"
                                class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border border-gray-300 focus:ring-base-blue focus:border-base-blue"
                                placeholder="judul-berita">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Slug akan digunakan untuk URL berita ini</p>
                    </div>

                    <!-- <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Publikasi</label>
            <select id="status"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
              <option value="draft">Draft</option>
              <option value="published">Published</option>
            </select>
          </div> -->

                    <div>
                        <label for="publishDate" class="block text-sm font-medium text-t-gray mb-2">Tanggal Publikasi</label>
                        <input type="datetime-local" id="publishDate"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-t-gray mb-4">Pratinjau Berita</h2>
        <div id="preview" class="border border-gray-200 rounded-lg p-4 min-h-32">
            <p class="text-t-gray text-center">Pratinjau akan muncul di sini saat Anda mulai mengetik</p>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    ClassicEditor
        .create(document.querySelector('#body'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'link', 'bulletedList', 'numberedList', '|',
                    'blockQuote', 'insertTable', 'mediaEmbed', '|',
                    'undo', 'redo'
                ]
            },
            language: 'id',
            licenseKey: '',
        })
        .then(editor => {
            window.editor = editor;

            editor.model.document.on('change:data', () => {
                updatePreview();
            });
        })
        .catch(error => {
            console.error(error);
        });

    document.getElementById('title').addEventListener('input', function() {
        const slugInput = document.getElementById('slug');
        if (!slugInput.dataset.manual) {
            const slug = this.value
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            slugInput.value = slug;
        }
    });

    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.manual = true;
    });

    function updatePreview() {
        const preview = document.getElementById('preview');
        const title = document.getElementById('title').value;
        const content = window.editor.getData();

        if (title || content) {
            let previewHTML = '';

            if (title) {
                previewHTML += `<h2 class="text-2xl font-bold mb-4">${title}</h2>`;
            }

            if (content) {
                previewHTML += content;
            } else {
                previewHTML += '<p class="text-t-gray">Mulai mengetik untuk melihat pratinjau konten...</p>';
            }

            preview.innerHTML = previewHTML;
        } else {
            preview.innerHTML = '<p class="text-t-gray text-center">Pratinjau akan muncul di sini saat Anda mulai mengetik</p>';
        }
    }

    document.getElementById('title').addEventListener('input', updatePreview);

    // document.getElementById('publishBtn').addEventListener('click', function() {
    //   document.getElementById('status').value = 'published';
    //   document.getElementById('status').dispatchEvent(new Event('change'));
    //   alert('Berita berhasil dipublikasikan!');
    // });

    const now = new Date();
    now.setHours(now.getHours() + 7);
    const formattedDate = now.toISOString().slice(0, 16);
    document.getElementById('publishDate').value = formattedDate;
</script>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const currentUrl = window.location.href;
        const match = currentUrl.match(/\/(\d+)$/);

        if (match) {
            const newsId = match[1];

            document.getElementById('titlePage').innerText = 'Edit Berita'
            document.getElementById('publishBtn').setAttribute('onclick', `editNews(${newsId})`)

            try {
                const response = await fetch(`/api/public/news/${newsId}`);
                if (!response.ok) throw new Error("Gagal ambil data berita");

                const newsData = await response.json();
                const news = newsData.data

                console.log(news)

                document.getElementById('title').value = news.content_title || '';
                document.getElementById('slug').value = news.content_path || '';
                document.getElementById('publishDate').value = news.last_update || '';
                editor.setData(news.content_desc || '');

            } catch (error) {
                console.error("Error saat ambil berita:", error);
            }
        } else {
            console.log("Mode tambah berita");
        }
    });
</script>

<script>
    async function editNews(id) {
        const title = document.getElementById('title').value.trim();
        const body = editor.getData().trim();
        const slug = document.getElementById('slug').value.trim();

        if (!title || !body || !slug) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Judul, isi berita, dan slug harus diisi.',
                confirmButtonText: 'OK'
            });
            return;
        }

        try {
            const response = await Api.post(`/api/admin/news/${id}`, {
                content_title: title,
                content_desc: body,
                content_path: slug
            });

            const result = response;

            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Berita berhasil diperbarui ✅',
                    confirmButtonText: 'OK',
                    timer: 2000,
                    willClose: () => {
                        window.location.href = '/admin/news-management';
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal memperbarui berita ❌',
                    confirmButtonText: 'OK'
                });
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim data.');
        }
    }
</script>

<script>
    async function createNews(e) {

        const title = document.getElementById('title').value.trim();
        const body = editor.getData().trim();
        const slug = document.getElementById('slug').value.trim();
        const publishDate = document.getElementById('publishDate').value;

        if (!title || !body || !slug) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Judul, isi berita, dan slug harus diisi.',
                confirmButtonText: 'OK'
            });
            return;
        }

        const data = {
            content_title: title,
            content_desc: body,
            content_path: slug,
            status: status,
            publish_date: publishDate
        };

        try {
            const response = await Api.post('/api/admin/news', data)
            const result = response

            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Berita berhasil dipublish ✅',
                    confirmButtonText: 'OK',
                    timer: 2000,
                    willClose: () => {
                        window.location.href = '/admin/news-management';
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal menyimpan berita ❌',
                    confirmButtonText: 'OK'
                });
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim data.');
        }
    }
</script>

<script>
    document.getElementById('backBtn').addEventListener('click', function() {
        window.history.back();
    });
</script>
<?= $this->endSection(); ?>
