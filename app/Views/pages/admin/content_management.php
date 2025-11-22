<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>

<?php

function formatPathToTitle($path)
{
    $segments = explode('/', $path);
    $formatted = array_map(function ($segment) {
        $words = explode('_', $segment);
        $words = array_map(function ($word) {
            return ucfirst($word);
        }, $words);
        return implode(' ', $words);
    }, $segments);
    return implode(' / ', $formatted);
}

function pathToDash($path)
{
    return str_replace('_', '-', $path);
}

function underscoreToCamelCase($string)
{
    // ubah semua ke huruf kecil biar konsisten
    $string = strtolower($string);

    // pisah berdasarkan underscore
    $parts = explode('_', $string);

    // huruf pertama tiap bagian (kecuali yang pertama) jadi kapital
    $camelCased = array_shift($parts);
    foreach ($parts as $part) {
        $camelCased .= ucfirst($part);
    }

    return $camelCased;
}

?>
<div class="w-full mx-auto text-[#505050]">
    <div class="w-full flex justify-between items-center">
        <h1 class="text-3xl font-semibold">Content Management</h1>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-5" id="layanan-lists">
        <div class="border border-gray-300 p-3 rounded flex flex-col gap-3">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-base-blue" id="indicator"></div>
                <h2 class="text-lg">Landing Page</h2>
            </div>
            <ul class="flex flex-col gap-2">
                <a href="/admin/content-management/slide-show">
                    <li class="p-2 border bg-gray-100 rounded hover:bg-gray-200 flex gap-2 items-center">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g id="Media / Image_02">
                                    <path id="Vector" d="M3.00005 18.0001C3 17.9355 3 17.8689 3 17.8002V6.2002C3 5.08009 3 4.51962 3.21799 4.0918C3.40973 3.71547 3.71547 3.40973 4.0918 3.21799C4.51962 3 5.08009 3 6.2002 3H17.8002C18.9203 3 19.4801 3 19.9079 3.21799C20.2842 3.40973 20.5905 3.71547 20.7822 4.0918C21 4.5192 21 5.07899 21 6.19691V17.8031C21 18.2881 21 18.6679 20.9822 18.9774M3.00005 18.0001C3.00082 18.9884 3.01337 19.5058 3.21799 19.9074C3.40973 20.2837 3.71547 20.5905 4.0918 20.7822C4.5192 21 5.07899 21 6.19691 21H17.8036C18.9215 21 19.4805 21 19.9079 20.7822C20.2842 20.5905 20.5905 20.2837 20.7822 19.9074C20.9055 19.6654 20.959 19.3813 20.9822 18.9774M3.00005 18.0001L7.76798 12.4375L7.76939 12.436C8.19227 11.9426 8.40406 11.6955 8.65527 11.6064C8.87594 11.5282 9.11686 11.53 9.33643 11.6113C9.58664 11.704 9.79506 11.9539 10.2119 12.4541L12.8831 15.6595C13.269 16.1226 13.463 16.3554 13.6986 16.4489C13.9065 16.5313 14.1357 16.5406 14.3501 16.4773C14.5942 16.4053 14.8091 16.1904 15.2388 15.7607L15.7358 15.2637C16.1733 14.8262 16.3921 14.6076 16.6397 14.5361C16.8571 14.4734 17.0896 14.4869 17.2988 14.5732C17.537 14.6716 17.7302 14.9124 18.1167 15.3955L20.9822 18.9774M20.9822 18.9774L21 18.9996M15 9C14.4477 9 14 8.55228 14 8C14 7.44772 14.4477 7 15 7C15.5523 7 16 7.44772 16 8C16 8.55228 15.5523 9 15 9Z" stroke="#16476A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </g>
                        </svg>
                        Slide Show
                    </li>
                </a>
                <a href="/admin/content-management/visi-misi">
                    <li class="p-2 border bg-gray-100 rounded hover:bg-gray-200 flex gap-2 items-center">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9436 1.25H13.0564C14.8942 1.24998 16.3498 1.24997 17.489 1.40314C18.6614 1.56076 19.6104 1.89288 20.3588 2.64124C21.1071 3.38961 21.4392 4.33856 21.5969 5.51098C21.75 6.65019 21.75 8.10583 21.75 9.94359V14.0564C21.75 15.8942 21.75 17.3498 21.5969 18.489C21.4392 19.6614 21.1071 20.6104 20.3588 21.3588C19.6104 22.1071 18.6614 22.4392 17.489 22.5969C16.3498 22.75 14.8942 22.75 13.0564 22.75H10.9436C9.10583 22.75 7.65019 22.75 6.51098 22.5969C5.33856 22.4392 4.38961 22.1071 3.64124 21.3588C2.89288 20.6104 2.56076 19.6614 2.40314 18.489C2.24997 17.3498 2.24998 15.8942 2.25 14.0564V9.94358C2.24998 8.10582 2.24997 6.65019 2.40314 5.51098C2.56076 4.33856 2.89288 3.38961 3.64124 2.64124C4.38961 1.89288 5.33856 1.56076 6.51098 1.40314C7.65019 1.24997 9.10582 1.24998 10.9436 1.25ZM6.71085 2.88976C5.70476 3.02502 5.12511 3.27869 4.7019 3.7019C4.27869 4.12511 4.02502 4.70476 3.88976 5.71085C3.75159 6.73851 3.75 8.09318 3.75 10V14C3.75 15.9068 3.75159 17.2615 3.88976 18.2892C4.02502 19.2952 4.27869 19.8749 4.7019 20.2981C5.12511 20.7213 5.70476 20.975 6.71085 21.1102C7.73851 21.2484 9.09318 21.25 11 21.25H13C14.9068 21.25 16.2615 21.2484 17.2892 21.1102C18.2952 20.975 18.8749 20.7213 19.2981 20.2981C19.7213 19.8749 19.975 19.2952 20.1102 18.2892C20.2484 17.2615 20.25 15.9068 20.25 14V10C20.25 8.09318 20.2484 6.73851 20.1102 5.71085C19.975 4.70476 19.7213 4.12511 19.2981 3.7019C18.8749 3.27869 18.2952 3.02502 17.2892 2.88976C16.2615 2.75159 14.9068 2.75 13 2.75H11C9.09318 2.75 7.73851 2.75159 6.71085 2.88976ZM7.25 8C7.25 7.58579 7.58579 7.25 8 7.25H16C16.4142 7.25 16.75 7.58579 16.75 8C16.75 8.41421 16.4142 8.75 16 8.75H8C7.58579 8.75 7.25 8.41421 7.25 8ZM7.25 12C7.25 11.5858 7.58579 11.25 8 11.25H16C16.4142 11.25 16.75 11.5858 16.75 12C16.75 12.4142 16.4142 12.75 16 12.75H8C7.58579 12.75 7.25 12.4142 7.25 12ZM7.25 16C7.25 15.5858 7.58579 15.25 8 15.25H13C13.4142 15.25 13.75 15.5858 13.75 16C13.75 16.4142 13.4142 16.75 13 16.75H8C7.58579 16.75 7.25 16.4142 7.25 16Z" fill="#16476A"></path>
                            </g>
                        </svg>
                        Visi Misi
                    </li>
                </a>
                <a href="/admin/content-management/staff">
                    <li class="p-2 border bg-gray-100 rounded hover:bg-gray-200 flex gap-2 items-center">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#16476A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#16476A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        Staff
                    </li>
                </a>
                <a href="/admin/content-management/tentang-kami">
                    <li class="p-2 border bg-gray-100 rounded hover:bg-gray-200 flex gap-2 items-center">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <circle cx="12" cy="12" r="10" stroke="#16476A" stroke-width="1.5"></circle>
                                <path d="M12 17V11" stroke="#16476A" stroke-width="1.5" stroke-linecap="round"></path>
                                <circle cx="1" cy="1" r="1" transform="matrix(1 0 0 -1 11 9)" fill="#16476A"></circle>
                            </g>
                        </svg>
                        Tentang Kami
                    </li>
                </a>
                <a href="/admin/content-management/sejarah">
                    <li class="p-2 border bg-gray-100 rounded hover:bg-gray-200 flex gap-2 items-center">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M5.52786 16.7023C6.6602 18.2608 8.3169 19.3584 10.1936 19.7934C12.0703 20.2284 14.0409 19.9716 15.7434 19.0701C17.446 18.1687 18.766 16.6832 19.4611 14.8865C20.1562 13.0898 20.1796 11.1027 19.527 9.29011C18.8745 7.47756 17.5898 5.96135 15.909 5.02005C14.2282 4.07875 12.2641 3.77558 10.3777 4.16623C8.49129 4.55689 6.80919 5.61514 5.64045 7.14656C4.47171 8.67797 3.89482 10.5797 4.01579 12.5023M4.01579 12.5023L2.51579 11.0023M4.01579 12.5023L5.51579 11.0023" stroke="#16476A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M12 8V12L15 15" stroke="#16476A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        Sejarah
                    </li>
                </a>
                <a href="/admin/content-management/fasilitas">
                    <li class="p-2 border bg-gray-100 rounded hover:bg-gray-200 flex gap-2 items-center">
                        <svg viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.867 15.8321L18.873 10.0391L14.75 5.92908C13.5057 4.69031 11.4942 4.69031 10.25 5.92908L6.13599 10.0291V15.8291C6.1393 17.5833 7.56377 19.0028 9.31799 19.0001H15.685C17.438 19.0029 18.862 17.5851 18.867 15.8321Z" stroke="#16476A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M19.624 6.01807C19.624 5.60385 19.2882 5.26807 18.874 5.26807C18.4598 5.26807 18.124 5.60385 18.124 6.01807H19.624ZM18.874 10.0391H18.124C18.124 10.2384 18.2033 10.4295 18.3445 10.5702L18.874 10.0391ZM19.9705 12.1912C20.2638 12.4837 20.7387 12.4829 21.0311 12.1896C21.3236 11.8962 21.3229 11.4214 21.0295 11.1289L19.9705 12.1912ZM6.66552 10.5602C6.95886 10.2678 6.95959 9.79289 6.66714 9.49955C6.3747 9.20621 5.89982 9.20548 5.60648 9.49793L6.66552 10.5602ZM3.97048 11.1289C3.67714 11.4214 3.67641 11.8962 3.96886 12.1896C4.2613 12.4829 4.73618 12.4837 5.02952 12.1912L3.97048 11.1289ZM13.75 19.0001C13.75 19.4143 14.0858 19.7501 14.5 19.7501C14.9142 19.7501 15.25 19.4143 15.25 19.0001H13.75ZM9.75 19.0001C9.75 19.4143 10.0858 19.7501 10.5 19.7501C10.9142 19.7501 11.25 19.4143 11.25 19.0001H9.75ZM18.124 6.01807V10.0391H19.624V6.01807H18.124ZM18.3445 10.5702L19.9705 12.1912L21.0295 11.1289L19.4035 9.50792L18.3445 10.5702ZM5.60648 9.49793L3.97048 11.1289L5.02952 12.1912L6.66552 10.5602L5.60648 9.49793ZM15.25 19.0001V17.2201H13.75V19.0001H15.25ZM15.25 17.2201C15.25 15.7013 14.0188 14.4701 12.5 14.4701V15.9701C13.1904 15.9701 13.75 16.5297 13.75 17.2201H15.25ZM12.5 14.4701C10.9812 14.4701 9.75 15.7013 9.75 17.2201H11.25C11.25 16.5297 11.8096 15.9701 12.5 15.9701V14.4701ZM9.75 17.2201V19.0001H11.25V17.2201H9.75Z" fill="#16476A"></path>
                            </g>
                        </svg>
                        Fasilitas
                    </li>
                </a>
                <a href="/admin/content-management/eresource">
                    <li class="p-2 border bg-gray-100 rounded hover:bg-gray-200 flex gap-2 items-center">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g id="style=linear" clip-path="url(#clip0_1_1825)">
                                    <g id="web">
                                        <path id="vector" d="M7.8 12L7.05 12L7.8 12ZM16.2 12H16.95H16.2ZM12 16.2V16.95V16.2ZM14.1729 22.2749L14.3273 23.0088L14.1729 22.2749ZM9.82712 22.2749L9.67269 23.0088L9.82712 22.2749ZM2.27554 8.03225L1.58122 7.74867H1.58122L2.27554 8.03225ZM1.7251 14.1729L0.991173 14.3273L1.7251 14.1729ZM9.82712 1.7251L9.67269 0.991173L9.82712 1.7251ZM14.1729 1.7251L14.3273 0.991174L14.1729 1.7251ZM21.6399 8.07014L21.8576 8.78785L21.6399 8.07014ZM2.35887 8.06976L2.14116 8.78747L2.35887 8.06976ZM21.0312 8.3185C21.4944 9.45344 21.75 10.6959 21.75 12H23.25C23.25 10.4983 22.9553 9.06352 22.42 7.75174L21.0312 8.3185ZM21.75 12C21.75 12.6927 21.6779 13.3678 21.541 14.0184L23.0088 14.3273C23.167 13.5757 23.25 12.7972 23.25 12H21.75ZM21.541 14.0184C20.7489 17.7827 17.7828 20.7489 14.0184 21.541L14.3273 23.0088C18.6735 22.0943 22.0943 18.6735 23.0088 14.3273L21.541 14.0184ZM14.0184 21.541C13.3678 21.6779 12.6927 21.75 12 21.75V23.25C12.7972 23.25 13.5757 23.167 14.3273 23.0088L14.0184 21.541ZM12 21.75C11.3072 21.75 10.6322 21.6779 9.98156 21.541L9.67269 23.0088C10.4242 23.167 11.2028 23.25 12 23.25V21.75ZM2.25 12C2.25 10.6949 2.50601 9.45149 2.96986 8.31584L1.58122 7.74867C1.0451 9.06127 0.75 10.4971 0.75 12H2.25ZM9.98156 21.541C6.21724 20.7489 3.25112 17.7827 2.45903 14.0184L0.991173 14.3273C1.90571 18.6735 5.32647 22.0943 9.67269 23.0088L9.98156 21.541ZM2.45903 14.0184C2.32213 13.3678 2.25 12.6927 2.25 12H0.75C0.75 12.7972 0.83303 13.5757 0.991173 14.3273L2.45903 14.0184ZM2.96986 8.31584C4.17707 5.36016 6.79381 3.1298 9.98155 2.45903L9.67269 0.991173C5.99032 1.76602 2.97369 4.33941 1.58122 7.74867L2.96986 8.31584ZM9.98155 2.45903C10.6322 2.32213 11.3072 2.25 12 2.25V0.75C11.2028 0.75 10.4242 0.83303 9.67269 0.991173L9.98155 2.45903ZM12 2.25C12.6927 2.25 13.3678 2.32213 14.0184 2.45903L14.3273 0.991174C13.5757 0.833031 12.7972 0.75 12 0.75V2.25ZM14.0184 2.45903C17.2071 3.13 19.8245 5.3615 21.0312 8.3185L22.42 7.75174C21.0281 4.34096 18.0108 1.76625 14.3273 0.991174L14.0184 2.45903ZM13.4584 1.95309C13.7482 2.8614 14.8215 6.35621 15.2615 9.5682L16.7476 9.36461C16.289 6.01664 15.1813 2.41835 14.8874 1.49712L13.4584 1.95309ZM15.2615 9.5682C15.3795 10.4292 15.45 11.2568 15.45 12L16.95 12C16.95 11.1681 16.8715 10.269 16.7476 9.36461L15.2615 9.5682ZM21.4222 7.35242C20.2692 7.70212 18.1033 8.3164 15.8685 8.72886L16.1407 10.204C18.4546 9.7769 20.6809 9.14473 21.8576 8.78785L21.4222 7.35242ZM15.8685 8.72886C14.5129 8.97904 13.1579 9.15 12 9.15L12 10.65C13.2874 10.65 14.743 10.4619 16.1407 10.204L15.8685 8.72886ZM15.45 12C15.45 13.1009 15.2954 14.3808 15.0647 15.671L16.5413 15.935C16.7797 14.6019 16.95 13.2252 16.95 12L15.45 12ZM15.0647 15.671C14.5591 18.4992 13.7097 21.2593 13.4584 22.0469L14.8874 22.5029C15.145 21.6956 16.0181 18.8613 16.5413 15.935L15.0647 15.671ZM22.0469 13.4584C21.2593 13.7097 18.4992 14.5591 15.671 15.0647L15.935 16.5413C18.8613 16.0181 21.6956 15.145 22.5029 14.8874L22.0469 13.4584ZM15.671 15.0647C14.3808 15.2954 13.1009 15.45 12 15.45L12 16.95C13.2252 16.95 14.6019 16.7797 15.935 16.5413L15.671 15.0647ZM12 15.45C10.8991 15.45 9.61923 15.2954 8.32897 15.0647L8.06496 16.5413C9.39807 16.7797 10.7748 16.95 12 16.95L12 15.45ZM8.32897 15.0647C5.50076 14.5591 2.74066 13.7097 1.95309 13.4584L1.49712 14.8874C2.30437 15.145 5.13873 16.0181 8.06496 16.5413L8.32897 15.0647ZM7.05 12C7.05 13.2252 7.22032 14.6019 7.45867 15.935L8.93526 15.671C8.70456 14.3808 8.55 13.1009 8.55 12L7.05 12ZM7.45867 15.935C7.98188 18.8613 8.85504 21.6956 9.11261 22.5029L10.5416 22.0469C10.2903 21.2593 9.44094 18.4992 8.93526 15.671L7.45867 15.935ZM9.11261 1.49712C8.81867 2.41835 7.711 6.01664 7.25235 9.36461L8.73846 9.5682C9.17849 6.35621 10.2518 2.8614 10.5416 1.95309L9.11261 1.49712ZM7.25235 9.36461C7.12846 10.269 7.05 11.1681 7.05 12L8.55 12C8.55 11.2568 8.62052 10.4292 8.73846 9.5682L7.25235 9.36461ZM12 9.15C10.8421 9.15 9.4871 8.97904 8.13152 8.72886L7.85929 10.204C9.25697 10.4619 10.7126 10.65 12 10.65L12 9.15ZM8.13152 8.72886C5.89586 8.31625 3.72921 7.70168 2.57657 7.35205L2.14116 8.78747C3.3175 9.14428 5.54457 9.77675 7.85929 10.204L8.13152 8.72886ZM21.38 7.3695C21.3919 7.3633 21.4065 7.35719 21.4222 7.35242L21.8576 8.78785C21.933 8.76498 22.0039 8.73569 22.0712 8.70074L21.38 7.3695ZM1.88425 8.67209C1.96322 8.72038 2.04888 8.75948 2.14116 8.78747L2.57657 7.35205C2.60983 7.36214 2.64048 7.3763 2.66683 7.39242L1.88425 8.67209Z" fill="#16476A"></path>
                                    </g>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_1825">
                                        <rect width="24" height="24" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </g>
                        </svg>
                        E-Resource
                    </li>
                </a>
                <a href="/admin/content-management/faq">
                    <li class="p-2 border bg-gray-100 rounded hover:bg-gray-200 flex gap-2 items-center">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 17.1086 6.89137 21.25 12 21.25C17.1086 21.25 21.25 17.1086 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75ZM1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12ZM12 7.75C11.3787 7.75 10.875 8.25368 10.875 8.875C10.875 9.28921 10.5392 9.625 10.125 9.625C9.71079 9.625 9.375 9.28921 9.375 8.875C9.375 7.42525 10.5503 6.25 12 6.25C13.4497 6.25 14.625 7.42525 14.625 8.875C14.625 9.83834 14.1056 10.6796 13.3353 11.1354C13.1385 11.2518 12.9761 11.3789 12.8703 11.5036C12.7675 11.6246 12.75 11.7036 12.75 11.75V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V11.75C11.25 11.2441 11.4715 10.8336 11.7266 10.533C11.9786 10.236 12.2929 10.0092 12.5715 9.84439C12.9044 9.64739 13.125 9.28655 13.125 8.875C13.125 8.25368 12.6213 7.75 12 7.75ZM12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" fill="#16476A"></path>
                            </g>
                        </svg>
                        FaQ
                    </li>
                </a>
            </ul>
        </div>
        <div class="border border-gray-300 p-3 rounded flex flex-col gap-3">
            <div class="flex items-center gap-2 justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-base-blue" id="indicator"></div>
                    <h2 class="text-lg">Layanan</h2>
                </div>
                <button id="add-new-layanan-modal-button" class="bg-base-blue hover:bg-base-hover text-white p-4 py-2 rounded-md flex items-center space-x-1 transition-colors duration-200">
                    <span>+</span><span>Tambah Layanan Baru</span>
                </button>
            </div>
            <ul class="flex flex-col gap-2">
                <?php foreach ($layanan as $item) { ?>
                    <a href="/admin/content-management/<?= pathToDash($item['landing_page_content_id']) ?>">
                        <li class="p-2 border bg-gray-100 rounded hover:bg-gray-200 flex gap-2 items-center">
                            <?= formatPathToTitle($item['landing_page_content_id']); ?>
                        </li>
                    </a>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div id="add-new-layanan-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-[#505050]">Tambah Layanan Baru</h2>
                <button id="add-new-layanan-modal-button-close" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="visionForm">
                <div>
                    <label for="bodyAddNewLayanan" class="block text-sm font-medium text-t-gray mb-2">Nama Layanan (Wajib ada kata "Layanan" di awal)</label>
                    <input type="text" name="landing_page_content_id" id="new-layanan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>
                <div class="flex justify-end space-x-3 mt-3">
                    <button type="button" id="add-new-layanan-modal-button-back" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="add-new-layanan-modal-button-save" type="submit" class="px-4 py-2 bg-b-green hover:bg-b-green-hover text-white rounded-md  transition-colors duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const addNewLayananModal = document.getElementById("add-new-layanan-modal")
    const addNewLayananModalButton = document.getElementById("add-new-layanan-modal-button")
    const addNewLayananModalButtonClose = document.getElementById("add-new-layanan-modal-button-close")
    const addNewLayananModalButtonBack = document.getElementById("add-new-layanan-modal-button-back")
    const addNewLayananModalButtonSave = document.getElementById("add-new-layanan-modal-button-save")
    const newLayanan = document.getElementById("new-layanan")

    addNewLayananModalButton.addEventListener("click", function() {
        addNewLayananModal.classList.remove("hidden")
    })

    addNewLayananModalButtonClose.addEventListener("click", function() {
        addNewLayananModal.classList.add('hidden');
    })

    addNewLayananModalButtonBack.addEventListener("click", function() {
        addNewLayananModal.classList.add('hidden');
    })

    function titleToUnderscore(title) {
        return title
            .toLowerCase() // jadi huruf kecil semua
            .replace(/\s+/g, '_'); // ganti spasi (atau multiple spasi) jadi underscore
    }

    addNewLayananModalButtonSave.addEventListener("click", async function(e) {
        e.preventDefault()
        const response = await Api.post('/api/admin/contents', {
            landing_page_content_id: titleToUnderscore(newLayanan.value)
        });

        const result = response;
        if (result.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Layanan Baru berhasil dibuat ✅',
                confirmButtonText: 'OK',
                timer: 2000,
                willClose: () => {
                    window.location.href = '/admin/content-management';
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal memperbarui Layanan Baru ❌',
                confirmButtonText: 'OK'
            });
        }
    })
</script>

<?= $this->endSection(); ?>
