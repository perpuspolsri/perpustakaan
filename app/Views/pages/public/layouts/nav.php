<nav id="navbar" class="fixed w-full py-5 text-[#505050] z-50 flex justify-center items-center px-8 lg:px-20 transition-all duration-500 ease-in-out bg-white">
    <div class="w-full flex flex-col gap-5 lg:gap-0 lg:flex-row justify-between">
        <div class="flex justify-between items-center w-full lg:w-fit gap-2">
            <a href="/">
                <div class="flex justify-center items-center w-fit gap-2">
                    <img src="/img/polsri.png" alt="" class="w-10">
                    <h1 class="text-lg font-bold">UPT Perpustakaan</h1>
                </div>
            </a>
            <img src="/img/icons/hamburger-dark.svg" alt="" class="w-7 block lg:hidden cursor-pointer" id="hamburger">
        </div>
        <div class="hidden lg:flex flex-col lg:flex-row justify-center items-center gap-5 lg:gap-10 tracking-wide transition-all duration-300 ease-in-out" id="menu">
            <a href="/">
                <div class="flex gap-3 w-full md:w-fit items-center md:items-center">
                    <?php if (uri_string() == "") { ?>
                        <div class="w-3 h-3 bg-[#505050] rounded-full" id="menu-indicator"></div>
                    <?php } ?>
                    <p>Beranda</p>
                </div>
            </a>
            <a href="/about">
                <div class="flex gap-3 w-full md:w-fit items-center">
                    <?php if (uri_string() == "about") { ?>
                        <div class="w-3 h-3 bg-[#505050] rounded-full" id="menu-indicator"></div>
                    <?php } ?>
                    <p>Tentang Kami</p>
                </div>
            </a>
            <div class="relative flex gap-3 w-full md:w-fit items-center cursor-pointer justify-center">
                <?php if (in_array(uri_string(), ["services", "circulation-services", "member-services", "pustaka-services", "magang-services"])) { ?>
                    <div class="w-3 h-3 bg-[#505050] rounded-full" id="menu-indicator"></div>
                <?php } ?>
                <p id="services-toogle">Layanan</p>
                <div class="hidden absolute right-0 top-14 bg-white p-3 border border-gray-300 rounded" id="services-menu"></div>
            </div>
            <a href="/news">
                <div class="flex gap-3 w-full md:w-fit items-center">
                    <?php if (in_array(uri_string(), ["news"]) || substr(uri_string(), 0, 4) == "news") { ?>
                        <div class="w-3 h-3 bg-[#505050] rounded-full" id="menu-indicator"></div>
                    <?php } ?>
                    <p>Berita</p>
                </div>
            </a>
            <a href="#kritik-saran">
                <div class="flex gap-3 w-full md:w-fit items-center">
                    <p>Kritik & Saran</p>
                </div>
            </a>
            <div class="relative flex gap-3 w-full md:w-fit items-center cursor-pointer justify-center">
                <p id="eresource-toogle">E-Resource</p>
                <div class="hidden absolute right-0 top-14 bg-white p-3 border border-gray-300 rounded" id="eresource-menu">

                </div>
            </div>
        </div>
        <button onclick="window.location.href='login'" id="btn-login" class="bg-[var(--primary)] hover:bg-gray-200 hover:px-7 transition-all duration-500 ease-in-out py-2 lg:py-1 px-5 hidden lg:flex justify-center items-center gap-2 rounded-md text-white">
            <img src="/img/icons/login-light.svg" alt="" id="btn-login-icon">
            <p class="font-bold">Login</p>
        </button>
    </div>
</nav>
<script>
    const menuBtn = document.getElementById("hamburger");
    const menu = document.getElementById("menu");
    const navbar = document.getElementById("navbar");
    const btnLogin = document.getElementById("btn-login");
    const btnLoginIcon = document.getElementById("btn-login-icon");
    const eresourceToogle = document.getElementById("eresource-toogle");
    const eresourceMenu = document.getElementById("eresource-menu");
    const servicesToogle = document.getElementById("services-toogle");
    const servicesMenu = document.getElementById("services-menu");

    menuBtn.addEventListener("click", (e) => {
        e.stopPropagation(); // biar gak langsung nutup pas diklik
        menu.classList.toggle("hidden");
        btnLogin.classList.toggle("hidden");
        btnLogin.classList.add("flex");
        menu.classList.add("flex");
    });

    eresourceToogle.addEventListener("click", (e) => {
        e.stopPropagation(); // biar gak langsung nutup pas diklik
        eresourceMenu.classList.toggle("hidden");

    });

    servicesToogle.addEventListener("click", (e) => {
        e.stopPropagation(); // biar gak langsung nutup pas diklik
        servicesMenu.classList.toggle("hidden");
    });

    // klik di luar -> nutup menu
    document.addEventListener("click", (e) => {
        if (!menu.contains(e.target) && !menuBtn.contains(e.target)) {
            menu.classList.add("hidden");
            btnLogin.classList.add("hidden");
        }
        if (!eresourceMenu.contains(e.target) && !eresourceToogle.contains(e.target)) {
            eresourceMenu.classList.add("hidden");
        }
        if (!servicesMenu.contains(e.target) && !servicesToogle.contains(e.target)) {
            servicesMenu.classList.add("hidden");
        }
    });

    function underscoreToDash(path) {
        return path.replace(/_/g, '-');
    }

    function formatUnderscoreToTitle(path) {
        return path
            .split('_') // pisah berdasarkan underscore
            .map(word => word.charAt(0).toUpperCase() + word.slice(1)) // kapital huruf pertama
            .join(' '); // gabung pake spasi
    }

    async function getLayananLists() {
        try {
            const response = await Api.get(`/api/public/contents/layanan`);
            const datas = response.data;

            datas.forEach(data => {
                servicesMenu.innerHTML += `<a href="/layanan/${underscoreToDash(data.landing_page_content_id)}">
                        <p class="text-[#505050] w-[150px] p-1 px-2 border-b hover:bg-gray-100">${formatUnderscoreToTitle(data.landing_page_content_id)}</p>
                    </a>`
            });
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    async function getEresourceLists() {
        try {
            const response = await Api.get(`/api/public/contents/eresource_content`);
            const datas = response.data.content;

            const contentArr = datas.split(";")

            contentArr.forEach(data => {
                let itemArr = data.split("&")
                let item = itemArr[itemArr.length - 1].split("|")
                eresourceMenu.innerHTML += `<a href="${item[1]}">
                                <p class="text-[#505050] w-[150px] p-1 px-2 border-b hover:bg-gray-100">${item[0]}</p>
                            </a>`
            });
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        getLayananLists()
        getEresourceLists()
        // Ambil elemen navbar
        const navbar = document.getElementById('navbar');
        const btnLogin = document.getElementById('btn-login');
        const btnLoginIcon = document.getElementById('btn-login-icon');
        const menuIndicator = document.getElementById('menu-indicator');
        const hamburger = document.getElementById('hamburger');
        // Tentukan batas scroll dalam piksel
        const scrollThreshold = 1;

        // Kelas Tailwind untuk background solid
        const solidBgClass = 'bg-white'; // Ganti dengan warna yang kamu inginkan, misalnya bg-white
        const borderOn = 'border-b';
        const borderOff = 'border-none';

        // Kelas Tailwind untuk background solid
        const morePTop = 'pt-5'; // Ganti dengan warna yang kamu inginkan, misalnya bg-white

        // Kelas Tailwind untuk teks saat background solid (misalnya dari putih jadi hitam)
        const solidTextClass = 'text-[#505050]'; // Sesuaikan jika kamu ganti warna teks

        // Kelas Tailwind untuk background transparent (awal)
        const transparentBgClass = 'bg-transparent';

        const lessPTop = 'pt-5`';

        // Kelas Tailwind untuk teks saat background transparent (awal)
        const transparentTextClass = 'text-[#505050]';

        const btnPrimary = 'bg-[var(--primary)]';
        const btnWhite = 'bg-white';

        const btnPrimaryText = 'text-white';
        const btnWhiteText = 'text-[#505050]';


        function handleScroll() {
            // window.scrollY memberikan posisi scroll vertikal
            if (window.scrollY > scrollThreshold) {
                // Jika sudah discroll melewati batas
                navbar.classList.add(solidBgClass);
                navbar.classList.remove(transparentBgClass);

                navbar.classList.add(borderOn);
                navbar.classList.remove(borderOff);

                // Mengubah warna teks (jika perlu)
                navbar.classList.add(solidTextClass);
                navbar.classList.remove(transparentTextClass);

                navbar.classList.add(lessPTop);
                navbar.classList.remove(morePTop);
            } else {
                // Jika di posisi paling atas atau kurang dari batas
                navbar.classList.add(transparentBgClass);
                navbar.classList.remove(solidBgClass);

                navbar.classList.add(borderOff);
                navbar.classList.remove(borderOn);

                // Mengubah warna teks kembali (jika perlu)
                navbar.classList.add(transparentTextClass);
                navbar.classList.remove(solidTextClass);

                navbar.classList.add(morePTop);
                navbar.classList.remove(lessPTop);
            }
        }

        // Tambahkan event listener untuk memantau scroll
        window.addEventListener('scroll', handleScroll);
    });
</script>
