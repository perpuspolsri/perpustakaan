<nav id="navbar" class="fixed w-full py-4 text-[#505050] z-50 flex justify-center items-center px-8 lg:px-20 transition-all duration-500 ease-in-out bg-white border border-b-gray-300">
    <div class="w-full flex flex-col gap-5 lg:gap-0 lg:flex-row justify-between">
        <div class="flex justify-between items-center w-full lg:w-fit gap-2">
            <a href="/loan">
                <div class="flex justify-center items-center w-fit gap-2">
                    <img src="/img/polsri.png" alt="" class="w-10">
                    <h1 class="text-lg font-bold">UPT Perpustakaan</h1>
                </div>
            </a>
        </div>
        <a href="<?= base_url('loan/logout') ?>">
            <button class="bg-base-blue text-white py-2 px-5 rounded hover:bg-base-hover transition-all duration-200 flex item-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-1 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </a>
    </div>
</nav>
