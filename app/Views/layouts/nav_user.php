 <aside class="w-full md:w-72 h-fit md:h-screen fixed z-100 top-0 left-0 bg-white border-b md:border-r border-gray-200 px-8 py-3 md:p-4 md:p-6 overflow-y-auto z-200">
     <div class="flex items-center justify-between mb-0 md:mb-8">
         <div class="flex items-center gap-3">
             <div class="w-12 h-12 rounded-full flex items-center justify-center bg-[#fde9db] overflow-hidden">
                 <img src="<?= session()->get('member_image') ?? 'https://blogger.googleusercontent.com/img/a/AVvXsEimZBnB1Lsea4ng-b1Q_j3B1XRkdz5r1rpNtaRO3vqdJi-GX3jNkkNAbM8k0U9mJD5bZtXKoL3Duk9eD0ZjsVXXih2lLDq54chx-bVBxIng76Aa0eCYPU9OmhFrToyCUpblqOgyzpgdq8FY6yUoGmO9fNsh8ym4oNZfwOBrkvlkpx-cec9y7AltJi7i' ?>" alt="" class="h-[48px] w-[48px]">
             </div>
             <div>
                 <div class="text-gray-900 font-semibold"><?= session()->get('realname'); ?></div>
                 <div class="text-sm text-[gray]">Member</div>
             </div>
         </div>
         <div class="flex items-center justify-center gap-3">
             <img src="/img/icons/hamburger-dark.svg" alt="" class="flex md:hidden w-6 cursor-pointer" id="hamburger">
             <a href="<?= base_url('logout') ?>"
                 class="hidden md:flex p-2 text-gray-600 rounded-lg hover:bg-red-100 hover:text-red-600 transition-colors duration-200">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                 </svg>
             </a>
         </div>
     </div>

     <nav id="menu" class="hidden md:flex flex-4 w-full mt-4">
         <ul class="space-y-2 text-[#505050] w-full">
             <li>
                 <a href="<?= '/member/dashboard'; ?>" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg <?= uri_string() == 'member/dashboard' ? 'rounded-lg bg-base-blue text-white' : 'hover:bg-gray-200'; ?>">
                     <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                         <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                         <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                         <g id="SVGRepo_iconCarrier">
                             <path d="M11.7255 17.1019C11.6265 16.8844 11.4215 16.7257 11.1734 16.6975C10.9633 16.6735 10.7576 16.6285 10.562 16.5636C10.4743 16.5341 10.392 16.5019 10.3158 16.4674L10.4424 16.1223C10.5318 16.1622 10.6239 16.1987 10.7182 16.2317L10.7221 16.2331L10.7261 16.2344C11.0287 16.3344 11.3265 16.3851 11.611 16.3851C11.8967 16.3851 12.1038 16.3468 12.2629 16.2647L12.2724 16.2598L12.2817 16.2544C12.5227 16.1161 12.661 15.8784 12.661 15.6021C12.661 15.2955 12.4956 15.041 12.2071 14.9035C12.062 14.8329 11.8559 14.7655 11.559 14.6917C11.2545 14.6147 10.9987 14.533 10.8003 14.4493C10.6553 14.3837 10.5295 14.279 10.4161 14.1293C10.3185 13.9957 10.2691 13.7948 10.2691 13.5319C10.2691 13.2147 10.3584 12.9529 10.5422 12.7315C10.7058 12.5375 10.9381 12.4057 11.2499 12.3318C11.4812 12.277 11.6616 12.1119 11.7427 11.8987C11.8344 12.1148 12.0295 12.2755 12.2723 12.3142C12.4751 12.3465 12.6613 12.398 12.8287 12.4677L12.7122 12.8059C12.3961 12.679 12.085 12.6149 11.7841 12.6149C10.7848 12.6149 10.7342 13.3043 10.7342 13.4425C10.7342 13.7421 10.896 13.9933 11.1781 14.1318L11.186 14.1357L11.194 14.1393C11.3365 14.2029 11.5387 14.2642 11.8305 14.3322C12.1322 14.4004 12.3838 14.4785 12.5815 14.5651L12.5856 14.5669L12.5897 14.5686C12.7365 14.6297 12.8624 14.7317 12.9746 14.8805L12.9764 14.8828L12.9782 14.8852C13.0763 15.012 13.1261 15.2081 13.1261 15.4681C13.1261 15.7682 13.0392 16.0222 12.8604 16.2447C12.7053 16.4377 12.4888 16.5713 12.1983 16.6531C11.974 16.7163 11.8 16.8878 11.7255 17.1019Z"
                                 fill="#<?= uri_string() == 'member/dashboard' ? 'FFFFFF' : '505050'; ?>"></path>
                             <path d="M11.9785 18H11.497C11.3893 18 11.302 17.9105 11.302 17.8V17.3985C11.302 17.2929 11.2219 17.2061 11.1195 17.1944C10.8757 17.1667 10.6399 17.115 10.412 17.0394C10.1906 16.9648 9.99879 16.8764 9.83657 16.7739C9.76202 16.7268 9.7349 16.6312 9.76572 16.5472L10.096 15.6466C10.1405 15.5254 10.284 15.479 10.3945 15.5417C10.5437 15.6262 10.7041 15.6985 10.8755 15.7585C11.131 15.8429 11.3762 15.8851 11.611 15.8851C11.8129 15.8851 11.9572 15.8628 12.0437 15.8181C12.1302 15.7684 12.1735 15.6964 12.1735 15.6021C12.1735 15.4929 12.1158 15.411 12.0004 15.3564C11.8892 15.3018 11.7037 15.2422 11.4442 15.1777C11.1104 15.0933 10.8323 15.0039 10.6098 14.9096C10.3873 14.8103 10.1936 14.6514 10.0288 14.433C9.86396 14.2096 9.78156 13.9092 9.78156 13.5319C9.78156 13.095 9.91136 12.7202 10.1709 12.4074C10.4049 12.13 10.7279 11.9424 11.1401 11.8447C11.2329 11.8227 11.302 11.7401 11.302 11.6425V11.2C11.302 11.0895 11.3893 11 11.497 11H11.9785C12.0862 11 12.1735 11.0895 12.1735 11.2V11.6172C12.1735 11.7194 12.2487 11.8045 12.3471 11.8202C12.7082 11.8777 13.0255 11.9866 13.2989 12.1469C13.3765 12.1924 13.4073 12.2892 13.3775 12.3756L13.0684 13.2725C13.0275 13.3914 12.891 13.4417 12.7812 13.3849C12.433 13.2049 12.1007 13.1149 11.7841 13.1149C11.4091 13.1149 11.2216 13.2241 11.2216 13.4425C11.2216 13.5468 11.2773 13.6262 11.3885 13.6809C11.4998 13.7305 11.6831 13.7851 11.9386 13.8447C12.2682 13.9192 12.5464 14.006 12.773 14.1053C12.9996 14.1996 13.1953 14.356 13.3602 14.5745C13.5291 14.7929 13.6136 15.0908 13.6136 15.4681C13.6136 15.8851 13.4879 16.25 13.2365 16.5628C13.0176 16.8354 12.7145 17.0262 12.3274 17.1353C12.2384 17.1604 12.1735 17.2412 12.1735 17.3358V17.8C12.1735 17.9105 12.0862 18 11.9785 18Z"
                                 fill="#<?= uri_string() == 'member/dashboard' ? 'FFFFFF' : '505050'; ?>"></path>
                             <path fill-rule="evenodd" clip-rule="evenodd" d="M9.59235 5H13.8141C14.8954 5 14.3016 6.664 13.8638 7.679L13.3656 8.843L13.2983 9C13.7702 8.97651 14.2369 9.11054 14.6282 9.382C16.0921 10.7558 17.2802 12.4098 18.1256 14.251C18.455 14.9318 18.5857 15.6958 18.5019 16.451C18.4013 18.3759 16.8956 19.9098 15.0182 20H8.38823C6.51033 19.9125 5.0024 18.3802 4.89968 16.455C4.81587 15.6998 4.94656 14.9358 5.27603 14.255C6.12242 12.412 7.31216 10.7565 8.77823 9.382C9.1696 9.11054 9.63622 8.97651 10.1081 9L10.0301 8.819L9.54263 7.679C9.1068 6.664 8.5101 5 9.59235 5Z"
                                 stroke="#<?= uri_string() == 'member/dashboard' ? 'FFFFFF' : '505050'; ?>" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                             <path d="M13.2983 9.75C13.7125 9.75 14.0483 9.41421 14.0483 9C14.0483 8.58579 13.7125 8.25 13.2983 8.25V9.75ZM10.1081 8.25C9.69391 8.25 9.35812 8.58579 9.35812 9C9.35812 9.41421 9.69391 9.75 10.1081 9.75V8.25ZM15.9776 8.64988C16.3365 8.44312 16.4599 7.98455 16.2531 7.62563C16.0463 7.26671 15.5878 7.14336 15.2289 7.35012L15.9776 8.64988ZM13.3656 8.843L13.5103 9.57891L13.5125 9.57848L13.3656 8.843ZM10.0301 8.819L10.1854 8.08521L10.1786 8.08383L10.0301 8.819ZM8.166 7.34357C7.80346 7.14322 7.34715 7.27469 7.1468 7.63722C6.94644 7.99976 7.07791 8.45607 7.44045 8.65643L8.166 7.34357ZM13.2983 8.25H10.1081V9.75H13.2983V8.25ZM15.2289 7.35012C14.6019 7.71128 13.9233 7.96683 13.2187 8.10752L13.5125 9.57848C14.3778 9.40568 15.2101 9.09203 15.9776 8.64988L15.2289 7.35012ZM13.2209 8.10709C12.2175 8.30441 11.1861 8.29699 10.1854 8.08525L9.87486 9.55275C11.0732 9.80631 12.3086 9.81521 13.5103 9.57891L13.2209 8.10709ZM10.1786 8.08383C9.47587 7.94196 8.79745 7.69255 8.166 7.34357L7.44045 8.65643C8.20526 9.0791 9.02818 9.38184 9.88169 9.55417L10.1786 8.08383Z"
                                 fill="#<?= uri_string() == 'member/dashboard' ? 'FFFFFF' : '505050'; ?>"></path>
                         </g>
                     </svg>
                     <span class="text-base">Denda</span>
                 </a>
             </li>
             <li>
                 <a href="<?= '/member/peminjaman'; ?>" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg <?= uri_string() == 'member/peminjaman' ? 'rounded-lg bg-base-blue text-white' : 'hover:bg-gray-200'; ?>">
                     <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                         <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                         <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                         <g id="SVGRepo_iconCarrier">
                             <path d="M9 17H15M9 13H15M9 9H10M13 3H8.2C7.0799 3 6.51984 3 6.09202 3.21799C5.71569 3.40973 5.40973 3.71569 5.21799 4.09202C5 4.51984 5 5.0799 5 6.2V17.8C5 18.9201 5 19.4802 5.21799 19.908C5.40973 20.2843 5.71569 20.5903 6.09202 20.782C6.51984 21 7.0799 21 8.2 21H15.8C16.9201 21 17.4802 21 17.908 20.782C18.2843 20.5903 18.5903 20.2843 18.782 19.908C19 19.4802 19 18.9201 19 17.8V9M13 3L19 9M13 3V7.4C13 7.96005 13 8.24008 13.109 8.45399C13.2049 8.64215 13.3578 8.79513 13.546 8.89101C13.7599 9 14.0399 9 14.6 9H19"
                                 stroke="#<?= uri_string() == 'member/peminjaman' ? 'FFFFFF' : '505050'; ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                         </g>
                     </svg>
                     <span class="text-base">Peminjaman</span>
                 </a>
             </li>
             <li class="flex md:hidden">
                 <a href="<?= base_url('logout') ?>" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg rounded-lg border">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                     </svg>
                     <span class="text-base">Logout</span>
                 </a>
             </li>
         </ul>
     </nav>
 </aside>

 <script>
     const menuBtn = document.getElementById("hamburger");
     const menu = document.getElementById("menu");
     const navbar = document.getElementById("navbar");
     const btnLogin = document.getElementById("btn-login");
     const btnLoginIcon = document.getElementById("btn-login-icon");

     menuBtn.addEventListener("click", (e) => {
         e.stopPropagation(); // biar gak langsung nutup pas diklik
         menu.classList.toggle("hidden");
         btnLogin.classList.toggle("hidden");
         btnLogin.classList.add("flex");
         menu.classList.add("flex");
         if (navbar.style.backgroundColor != "white") {
             navbar.style.backgroundColor = "white"
             navbar.style.color = "#505050";
             btnLogin.style.backgroundColor = "#16476A";
             btnLogin.style.color = "white"
             btnLoginIcon.src = "img/icons/login-light.svg"
             menuBtn.src = "img/icons/hamburger-dark.svg"
         } else {
             navbar.style.backgroundColor = "white"
             navbar.style.color = "white";
             menuBtn.src = "img/icons/hamburger-light.svg"
         }
     });

     // klik di luar -> nutup menu
     document.addEventListener("click", (e) => {
         if (!menu.contains(e.target) && !menuBtn.contains(e.target)) {
             menu.classList.add("hidden");
             btnLogin.classList.add("hidden");
             if (navbar.style.backgroundColor == "white") {
                 navbar.style.backgroundColor = "transparent"
                 navbar.style.color = "white";
                 menuBtn.src = "img/icons/hamburger-light.svg"
             }
         }
     });
 </script>
