<nav>
    <div class="navbar-top">
        <a href="{{route('home')}}" class="nav-logo">
            <img src="{{asset('/')}}assets/images/logo.svg" alt="">
        </a>
        <button class="hamburger" type="button">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22 7L2 7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M19 12L5 12" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M16 17H8" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </button>
    </div>
    <div class="navbar-menu">
        <div class="navbar-menu-top">
            <p>Menu</p>
            <button class="closeMenu" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18" stroke="#1C274C" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M6 6L18 18" stroke="#1C274C" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="navbar-menu-links">
            @if(auth()->user()->hasRole('Student'))
{{--                 permissionlar əlavə edildikdən sonra bu route aşağıdakı kimi dəyişdirilib single_student bladesi və route silinsin--}}
{{--                {{route('students.show',auth()->user()->id)}} --}}
                <a href="{{route('single_student')}}" class="navbar-menu-link {{ request()->routeIs('single_student') ? 'active' : '' }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="6" r="4" fill="black"></circle>
                        <ellipse cx="12" cy="17" rx="7" ry="4" fill="black"></ellipse>
                    </svg>
                    <p>Məlumatlarım</p>
                </a>
            @elseif(auth()->user()->hasRole('Agent'))
                <a href="{{ route('students.index') }}"
                   class="navbar-menu-link {{ request()->routeIs('agent_students') ? 'active' : '' }}">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="8.24998" cy="5.49998" r="3.66667" stroke="black" stroke-opacity="0.7"
                                stroke-width="1.5"></circle>
                        <path d="M13.75 8.25C15.2688 8.25 16.5 7.01878 16.5 5.5C16.5 3.98122 15.2688 2.75 13.75 2.75"
                              stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"></path>
                        <ellipse cx="8.24998" cy="15.5834" rx="6.41667" ry="3.66667" stroke="black" stroke-opacity="0.7"
                                 stroke-width="1.5"></ellipse>
                        <path
                            d="M16.5 12.8333C18.1081 13.186 19.25 14.079 19.25 15.125C19.25 16.0685 18.3207 16.8877 16.9583 17.2979"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                    <p>Tələbələr</p>
                </a>

                @can('list-tariffs')
                    <a href="{{ route('tariffs.index') }}"
                       class="navbar-menu-link {{ request()->routeIs('tariffs.index') ? 'active' : '' }}">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.96747 3.20801C10.2701 2.59733 11.7298 2.59733 13.0324 3.20801L19.166 6.08358C20.5002 6.70908 20.5002 8.8743 19.166 9.49979L13.0325 12.3753C11.7299 12.986 10.2701 12.986 8.96755 12.3753L2.83395 9.49975C1.49977 8.87426 1.49977 6.70904 2.83395 6.08354L8.96747 3.20801Z"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M1.83331 7.79166V12.8333" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                                  stroke-linecap="round"/>
                            <path
                                d="M17.4166 10.5417V15.24C17.4166 16.164 16.9551 17.0291 16.1468 17.4768C14.8008 18.2222 12.6463 19.25 11 19.25C9.35364 19.25 7.19921 18.2222 5.8532 17.4768C5.04486 17.0291 4.58331 16.164 4.58331 15.24V10.5417"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        <p>Universitetlər</p>
                    </a>
                @endcan
                <a href="{{route('applications.index')}}" class="navbar-menu-link {{ request()->routeIs('applications.index') ? 'active' : '' }}">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.6667 3.66827C16.6604 3.67937 17.7402 3.76779 18.4445 4.47214C19.25 5.27759 19.25 6.57396 19.25 9.16668V14.6667C19.25 17.2594 19.25 18.5558 18.4445 19.3612C17.6391 20.1667 16.3427 20.1667 13.75 20.1667H8.25C5.65728 20.1667 4.36091 20.1667 3.55546 19.3612C2.75 18.5558 2.75 17.2594 2.75 14.6667V9.16668C2.75 6.57396 2.75 5.27759 3.55546 4.47214C4.25981 3.76779 5.33956 3.67937 7.33333 3.66827"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        <path d="M9.625 12.8333L15.5833 12.8333" stroke="black" stroke-opacity="0.7"
                              stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path d="M6.41669 12.8333H6.87502" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path d="M6.41669 9.625H6.87502" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path d="M6.41669 16.0417H6.87502" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path d="M9.625 9.625H15.5833" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path d="M9.625 16.0417H15.5833" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path
                            d="M7.33331 3.20834C7.33331 2.44895 7.94892 1.83334 8.70831 1.83334H13.2916C14.051 1.83334 14.6666 2.44895 14.6666 3.20834V4.12501C14.6666 4.8844 14.051 5.50001 13.2916 5.50001H8.70831C7.94892 5.50001 7.33331 4.8844 7.33331 4.12501V3.20834Z"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                    </svg>
                    <p>Başvurular</p>
                </a>
            @else
                <a href="{{route('home')}}" class="navbar-menu-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.70356 4.21762C6.11108 3.94533 6.53897 3.70916 6.98232 3.51061C8.23987 2.94743 8.86865 2.66584 9.70515 3.20778C10.5416 3.74972 10.5416 4.6387 10.5416 6.41667V7.79167C10.5416 9.52015 10.5416 10.3844 11.0786 10.9214C11.6156 11.4583 12.4798 11.4583 14.2083 11.4583H15.5833C17.3613 11.4583 18.2503 11.4583 18.7922 12.2948C19.3341 13.1313 19.0526 13.7601 18.4894 15.0177C18.2908 15.461 18.0547 15.8889 17.7824 16.2964C16.8255 17.7285 15.4654 18.8447 13.8742 19.5038C12.2829 20.1629 10.532 20.3353 8.84274 19.9993C7.15349 19.6633 5.60181 18.8339 4.38393 17.6161C3.16605 16.3982 2.33666 14.8465 2.00065 13.1572C1.66463 11.468 1.83709 9.71704 2.4962 8.1258C3.15531 6.53456 4.27148 5.1745 5.70356 4.21762Z"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        <path
                            d="M19.6588 6.47991C18.9147 4.59094 17.409 3.08529 15.5201 2.34114C14.107 1.78445 12.8333 3.06455 12.8333 4.58333V8.25C12.8333 8.75626 13.2437 9.16667 13.75 9.16667H17.4166C18.9354 9.16667 20.2155 7.89299 19.6588 6.47991Z"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                    </svg>
                    <p>Statistika</p>
                </a>
                <div class="menuDropDown">
                    <button class="menuDropBtn" type="button">
                        <svg class="menuDropIcon" width="22" height="22" viewBox="0 0 22 22" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.75 11C2.75 14.457 2.75 18.0188 3.95818 19.0927C5.16637 20.1667 7.11091 20.1667 11 20.1667C14.8891 20.1667 16.8336 20.1667 18.0418 19.0927C19.25 18.0188 19.25 14.457 19.25 11"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path
                                d="M13.4373 13.0184L18.944 11.3664C19.4899 11.2026 19.7628 11.1207 19.936 10.9245C19.9697 10.8863 20.0002 10.8453 20.0272 10.802C20.1654 10.5797 20.1654 10.2947 20.1654 9.72483C20.1654 7.47886 20.1654 6.35587 19.5485 5.59769C19.4299 5.45197 19.2967 5.31878 19.151 5.20021C18.3928 4.58331 17.2698 4.58331 15.0238 4.58331H6.97355C4.72757 4.58331 3.60459 4.58331 2.84641 5.20021C2.70069 5.31878 2.5675 5.45197 2.44893 5.59769C1.83203 6.35587 1.83203 7.47886 1.83203 9.72483C1.83203 10.2947 1.83203 10.5797 1.97024 10.802C1.99717 10.8453 2.02766 10.8863 2.06139 10.9245C2.23459 11.1207 2.50752 11.2026 3.0534 11.3664L8.56007 13.0184"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path
                                d="M5.95703 4.58331C6.71185 4.56418 7.47801 4.08365 7.73485 3.37361C7.74275 3.35177 7.75085 3.32747 7.76705 3.27887L7.79057 3.20831C7.82924 3.0923 7.84859 3.03427 7.86927 2.98281C8.13345 2.32568 8.75251 1.87948 9.45947 1.83667C9.51483 1.83331 9.57598 1.83331 9.69828 1.83331H12.2995C12.4218 1.83331 12.483 1.83331 12.5383 1.83667C13.2453 1.87948 13.8644 2.32568 14.1285 2.98281C14.1492 3.03428 14.1686 3.09229 14.2072 3.20831L14.2308 3.27887C14.2469 3.32718 14.2551 3.35183 14.263 3.37361C14.5198 4.08365 15.2855 4.56418 16.0404 4.58331"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path
                                d="M12.832 11.4583H9.16536C8.91223 11.4583 8.70703 11.6635 8.70703 11.9166V13.898C8.70703 14.0854 8.82113 14.254 8.99514 14.3236L9.63693 14.5803C10.5111 14.9299 11.4863 14.9299 12.3605 14.5803L13.0023 14.3236C13.1763 14.254 13.2904 14.0854 13.2904 13.898V11.9166C13.2904 11.6635 13.0852 11.4583 12.832 11.4583Z"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        <div class="btn-left">
                            Səlahiyyətlər
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 7.5L10 12.5L15 7.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>

                    </button>
                    <!-- hansina click etsen active gelecek o linke -->
                    <div class="menuDrop-links">
                        <a href="{{route('users.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">İstifadəçilər</a>
                        @can('list-roles')
                            <a href="{{route('roles.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Rollar</a>
                        @endcan
                        @can('list-permissions')
                            <a href="{{route('permissions.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Permissions</a>
                        @endcan
                    </div>
                </div>
                <a href="{{route('applications.index')}}" class="navbar-menu-link {{ request()->routeIs('applications.index') ? 'active' : '' }}">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.6667 3.66827C16.6604 3.67937 17.7402 3.76779 18.4445 4.47214C19.25 5.27759 19.25 6.57396 19.25 9.16668V14.6667C19.25 17.2594 19.25 18.5558 18.4445 19.3612C17.6391 20.1667 16.3427 20.1667 13.75 20.1667H8.25C5.65728 20.1667 4.36091 20.1667 3.55546 19.3612C2.75 18.5558 2.75 17.2594 2.75 14.6667V9.16668C2.75 6.57396 2.75 5.27759 3.55546 4.47214C4.25981 3.76779 5.33956 3.67937 7.33333 3.66827"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        <path d="M9.625 12.8333L15.5833 12.8333" stroke="black" stroke-opacity="0.7"
                              stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path d="M6.41669 12.8333H6.87502" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path d="M6.41669 9.625H6.87502" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path d="M6.41669 16.0417H6.87502" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path d="M9.625 9.625H15.5833" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path d="M9.625 16.0417H15.5833" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path
                            d="M7.33331 3.20834C7.33331 2.44895 7.94892 1.83334 8.70831 1.83334H13.2916C14.051 1.83334 14.6666 2.44895 14.6666 3.20834V4.12501C14.6666 4.8844 14.051 5.50001 13.2916 5.50001H8.70831C7.94892 5.50001 7.33331 4.8844 7.33331 4.12501V3.20834Z"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                    </svg>
                    <p>Başvurular</p>
                </a>
                @can('list-students')
                    <a href="{{route('students.index')}}" class="navbar-menu-link {{ request()->routeIs('students.index') ? 'active' : '' }}">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="8.24998" cy="5.49998" r="3.66667" stroke="black" stroke-opacity="0.7"
                                    stroke-width="1.5"/>
                            <path
                                d="M13.75 8.25C15.2688 8.25 16.5 7.01878 16.5 5.5C16.5 3.98122 15.2688 2.75 13.75 2.75"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <ellipse cx="8.24998" cy="15.5834" rx="6.41667" ry="3.66667" stroke="black"
                                     stroke-opacity="0.7"
                                     stroke-width="1.5"/>
                            <path
                                d="M16.5 12.8333C18.1081 13.186 19.25 14.079 19.25 15.125C19.25 16.0685 18.3207 16.8877 16.9583 17.2979"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        <p>Tələbələr</p>
                    </a>
                @endcan
                <a href="employees.html" class="navbar-menu-link ">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.75 11C2.75 14.457 2.75 18.0188 3.95818 19.0927C5.16637 20.1667 7.11091 20.1667 11 20.1667C14.8891 20.1667 16.8336 20.1667 18.0418 19.0927C19.25 18.0188 19.25 14.457 19.25 11"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        <path
                            d="M13.4386 13.0184L18.9453 11.3664C19.4912 11.2026 19.7641 11.1208 19.9373 10.9245C19.971 10.8863 20.0015 10.8453 20.0284 10.802C20.1666 10.5797 20.1666 10.2948 20.1666 9.72485C20.1666 7.47888 20.1666 6.35589 19.5497 5.59771C19.4312 5.45199 19.298 5.3188 19.1523 5.20023C18.3941 4.58333 17.2711 4.58333 15.0251 4.58333H6.97483C4.72886 4.58333 3.60587 4.58333 2.84769 5.20023C2.70197 5.3188 2.56878 5.45199 2.45021 5.59771C1.83331 6.35589 1.83331 7.47888 1.83331 9.72485C1.83331 10.2948 1.83331 10.5797 1.97153 10.802C1.99845 10.8453 2.02894 10.8863 2.06267 10.9245C2.23587 11.1208 2.50881 11.2026 3.05468 11.3664L8.56135 13.0184"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        <path
                            d="M5.95831 4.58333C6.71314 4.56421 7.47929 4.08367 7.73614 3.37363C7.74404 3.35179 7.75213 3.32749 7.76833 3.27889L7.79185 3.20833C7.83052 3.09232 7.84987 3.03429 7.87055 2.98284C8.13473 2.3257 8.75379 1.8795 9.46075 1.83669C9.51611 1.83333 9.57726 1.83333 9.69956 1.83333H12.3008C12.4231 1.83333 12.4843 1.83333 12.5396 1.83669C13.2466 1.8795 13.8656 2.3257 14.1298 2.98284C14.1505 3.0343 14.1698 3.09231 14.2085 3.20833L14.232 3.27889C14.2481 3.32721 14.2564 3.35185 14.2642 3.37363C14.5211 4.08367 15.2868 4.56421 16.0416 4.58333"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        <path
                            d="M12.8333 11.4583H9.16665C8.91352 11.4583 8.70831 11.6635 8.70831 11.9167V13.898C8.70831 14.0854 8.82242 14.254 8.99643 14.3236L9.63821 14.5803C10.5124 14.93 11.4876 14.93 12.3617 14.5803L13.0035 14.3236C13.1775 14.254 13.2916 14.0854 13.2916 13.898V11.9167C13.2916 11.6635 13.0864 11.4583 12.8333 11.4583Z"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <p>İşçilər</p>
                </a>
                @can('list-tariffs')
                    <a href="{{route('tariffs.index')}}" class="navbar-menu-link {{ request()->routeIs('tariffs.index') ? 'active' : '' }}">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.96747 3.20801C10.2701 2.59733 11.7298 2.59733 13.0324 3.20801L19.166 6.08358C20.5002 6.70908 20.5002 8.8743 19.166 9.49979L13.0325 12.3753C11.7299 12.986 10.2701 12.986 8.96755 12.3753L2.83395 9.49975C1.49977 8.87426 1.49977 6.70904 2.83395 6.08354L8.96747 3.20801Z"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M1.83331 7.79166V12.8333" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                                  stroke-linecap="round"/>
                            <path
                                d="M17.4166 10.5417V15.24C17.4166 16.164 16.9551 17.0291 16.1468 17.4768C14.8008 18.2222 12.6463 19.25 11 19.25C9.35364 19.25 7.19921 18.2222 5.8532 17.4768C5.04486 17.0291 4.58331 16.164 4.58331 15.24V10.5417"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        <p>Universitetlər</p>
                    </a>
                @endcan
                {{--<a href="university_categories.html" class="navbar-menu-link ">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.29169 5.95834C2.29169 3.93329 3.93331 2.29167 5.95835 2.29167C7.9834 2.29167 9.62502 3.93329 9.62502 5.95834V8.40278C9.62502 8.68694 9.62502 8.82902 9.59379 8.94559C9.50902 9.26192 9.26194 9.50901 8.9456 9.59377C8.82903 9.625 8.68696 9.625 8.4028 9.625H5.95835C3.93331 9.625 2.29169 7.98338 2.29169 5.95834Z"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        <path
                            d="M12.375 13.5972C12.375 13.3131 12.375 13.171 12.4062 13.0544C12.491 12.7381 12.7381 12.491 13.0544 12.4062C13.171 12.375 13.3131 12.375 13.5972 12.375H16.0417C18.0667 12.375 19.7083 14.0166 19.7083 16.0417C19.7083 18.0667 18.0667 19.7083 16.0417 19.7083C14.0166 19.7083 12.375 18.0667 12.375 16.0417V13.5972Z"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        <path
                            d="M2.29169 16.0417C2.29169 14.0166 3.93331 12.375 5.95835 12.375H8.15835C8.67173 12.375 8.92843 12.375 9.12451 12.4749C9.29699 12.5628 9.43723 12.703 9.52511 12.8755C9.62502 13.0716 9.62502 13.3283 9.62502 13.8417V16.0417C9.62502 18.0667 7.9834 19.7083 5.95835 19.7083C3.93331 19.7083 2.29169 18.0667 2.29169 16.0417Z"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        <path
                            d="M12.375 5.95834C12.375 3.93329 14.0166 2.29167 16.0417 2.29167C18.0667 2.29167 19.7083 3.93329 19.7083 5.95834C19.7083 7.98338 18.0667 9.625 16.0417 9.625H13.4226C13.301 9.625 13.2402 9.625 13.189 9.61924C12.764 9.57136 12.4286 9.23596 12.3808 8.81097C12.375 8.75982 12.375 8.69901 12.375 8.57739V5.95834Z"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                    </svg>
                    Universitet kateqoriyaları
                </a>--}}
                <a href="{{route('academics.index')}}" class="navbar-menu-link {{ request()->routeIs('academics.index') ? 'active' : '' }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M10.9571 1.55175L10.5408 2.30025C10.5311 2.31825 10.5138 2.331 10.4936 2.33475L9.65282 2.49975C9.22682 2.583 8.88032 2.8905 8.74607 3.303C8.61182 3.7155 8.71232 4.1685 9.00707 4.48575L9.59057 5.1135C9.60482 5.1285 9.61157 5.14875 9.60857 5.16975L9.50582 6.0195C9.45332 6.45 9.63857 6.87525 9.98957 7.13025C10.3406 7.38525 10.8018 7.43025 11.1956 7.24725L11.9726 6.8865C11.9913 6.87825 12.0123 6.87825 12.0311 6.8865L12.8081 7.24725C13.2018 7.43025 13.6631 7.38525 14.0141 7.13025C14.3651 6.87525 14.5503 6.45 14.4978 6.0195L14.3951 5.16975C14.3921 5.14875 14.3988 5.1285 14.4131 5.1135L14.9966 4.48575C15.2913 4.1685 15.3918 3.7155 15.2576 3.303C15.1233 2.8905 14.7768 2.583 14.3508 2.49975L13.5101 2.33475C13.4898 2.331 13.4726 2.31825 13.4628 2.30025L13.0466 1.55175C12.8351 1.17225 12.4353 0.9375 12.0018 0.9375C11.5683 0.9375 11.1686 1.17225 10.9571 1.55175ZM11.9403 2.0985C11.9531 2.076 11.9763 2.0625 12.0018 2.0625C12.0273 2.0625 12.0506 2.076 12.0633 2.0985L12.4796 2.847C12.6506 3.1545 12.9483 3.37125 13.2941 3.43875L14.1341 3.60375C14.1596 3.60825 14.1798 3.62625 14.1873 3.65025C14.1956 3.675 14.1896 3.70125 14.1723 3.72L13.5888 4.347C13.3496 4.605 13.2356 4.95525 13.2783 5.30475L13.3811 6.15525C13.3841 6.18 13.3736 6.2055 13.3526 6.2205C13.3323 6.2355 13.3053 6.23775 13.2821 6.22725L12.5051 5.8665C12.1863 5.718 11.8173 5.718 11.4986 5.8665L10.7216 6.22725C10.6983 6.23775 10.6713 6.2355 10.6511 6.2205C10.6301 6.2055 10.6196 6.18 10.6226 6.15525L10.7253 5.30475C10.7681 4.95525 10.6541 4.605 10.4148 4.347L9.83132 3.72C9.81407 3.70125 9.80807 3.675 9.81632 3.65025C9.82382 3.62625 9.84407 3.60825 9.86882 3.60375L10.7096 3.43875C11.0553 3.37125 11.3531 3.1545 11.5241 2.847L11.9403 2.0985Z"
                              fill="black"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M4.1962 3.171L3.56395 3.29475C3.18595 3.369 2.8777 3.642 2.7592 4.008C2.63995 4.374 2.72845 4.776 2.99095 5.058L3.4297 5.5305L3.35245 6.17025C3.30595 6.552 3.4702 6.93 3.78145 7.15575C4.09345 7.38225 4.50295 7.422 4.8517 7.26L5.4367 6.9885L6.0217 7.26C6.37045 7.422 6.77995 7.38225 7.09195 7.15575C7.4032 6.93 7.56745 6.552 7.52095 6.17025L7.4437 5.5305L7.88245 5.058C8.14495 4.776 8.23345 4.374 8.1142 4.008C7.9957 3.642 7.68745 3.369 7.30945 3.29475L6.6772 3.171L6.3637 2.60775C6.1762 2.271 5.82145 2.0625 5.4367 2.0625C5.05195 2.0625 4.6972 2.271 4.5097 2.60775L4.1962 3.171ZM5.4367 3.25575L5.7082 3.744C5.86045 4.017 6.1252 4.209 6.4312 4.269L6.9802 4.377L6.5992 4.78575C6.38695 5.0145 6.2857 5.32575 6.3232 5.63625L6.3907 6.19125L5.8837 5.95575C5.6002 5.82375 5.2732 5.82375 4.9897 5.95575L4.4827 6.19125L4.5502 5.63625C4.5877 5.32575 4.48645 5.0145 4.2742 4.78575L3.8932 4.377L4.4422 4.269C4.7482 4.209 5.01295 4.017 5.1652 3.744L5.4367 3.25575Z"
                              fill="black"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M17.3212 3.171L16.6889 3.29475C16.3109 3.369 16.0027 3.642 15.8842 4.008C15.7649 4.374 15.8534 4.776 16.1159 5.058L16.5547 5.5305L16.4774 6.17025C16.4309 6.552 16.5952 6.93 16.9064 7.15575C17.2184 7.38225 17.6279 7.422 17.9767 7.26L18.5617 6.9885L19.1467 7.26C19.4954 7.422 19.9049 7.38225 20.2169 7.15575C20.5282 6.93 20.6924 6.552 20.6459 6.17025L20.5687 5.5305L21.0074 5.058C21.2699 4.776 21.3584 4.374 21.2392 4.008C21.1207 3.642 20.8124 3.369 20.4344 3.29475L19.8022 3.171L19.4887 2.60775C19.3012 2.271 18.9464 2.0625 18.5617 2.0625C18.1769 2.0625 17.8222 2.271 17.6347 2.60775L17.3212 3.171ZM18.5617 3.25575L18.8332 3.744C18.9854 4.017 19.2502 4.209 19.5562 4.269L20.1052 4.377L19.7242 4.78575C19.5119 5.0145 19.4107 5.32575 19.4482 5.63625L19.5157 6.19125L19.0087 5.95575C18.7252 5.82375 18.3982 5.82375 18.1147 5.95575L17.6077 6.19125L17.6752 5.63625C17.7127 5.32575 17.6114 5.0145 17.3992 4.78575L17.0182 4.377L17.5672 4.269C17.8732 4.209 18.1379 4.017 18.2902 3.744L18.5617 3.25575Z"
                              fill="black"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M19.3203 14.1488V16.9981C19.3203 17.3086 19.5723 17.5606 19.8828 17.5606C20.1933 17.5606 20.4453 17.3086 20.4453 16.9981V14.1488C20.4453 13.8383 20.1933 13.5863 19.8828 13.5863C19.5723 13.5863 19.3203 13.8383 19.3203 14.1488Z"
                              fill="black"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M13.7306 17.7509L19.7554 14.9737C20.2691 14.7367 20.5976 14.2229 20.5976 13.6574C20.5976 13.0919 20.2691 12.5782 19.7554 12.3419L13.7306 9.56469C12.6394 9.06144 11.3831 9.06144 10.2919 9.56469C8.64937 10.3214 6.00563 11.5394 4.26488 12.3419C3.75113 12.5782 3.42188 13.0919 3.42188 13.6574C3.42188 14.2229 3.75113 14.7367 4.26488 14.9737C6.00563 15.7754 8.64937 16.9942 10.2919 17.7509C11.3831 18.2534 12.6394 18.2534 13.7306 17.7509ZM19.2844 13.9514L13.2596 16.7287C12.4676 17.0939 11.5549 17.0939 10.7621 16.7287C9.12038 15.9727 6.47587 14.7539 4.73512 13.9522C4.62037 13.8989 4.54688 13.7842 4.54688 13.6574C4.54688 13.5314 4.62037 13.4167 4.73512 13.3634L10.7621 10.5862C11.5549 10.2209 12.4676 10.2209 13.2596 10.5862L19.2844 13.3634C19.3991 13.4167 19.4726 13.5314 19.4726 13.6574C19.4726 13.7842 19.3991 13.8989 19.2844 13.9514Z"
                              fill="black"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M6.75112 14.8807C6.57712 14.8005 6.37388 14.8147 6.21263 14.9182C6.05063 15.021 5.95312 15.1995 5.95312 15.3915V18.837C5.95312 19.9582 6.39863 21.0322 7.19063 21.825C7.98338 22.617 9.05813 23.0625 10.1786 23.0625H13.8409C14.9614 23.0625 16.0361 22.617 16.8289 21.825C17.6209 21.0322 18.0664 19.9582 18.0664 18.837V15.3922C18.0664 15.2002 17.9681 15.0217 17.8069 14.9182C17.6456 14.8147 17.4424 14.8012 17.2684 14.8815L13.2596 16.7287C12.4676 17.094 11.5549 17.094 10.7621 16.7287L6.75112 14.8807ZM7.07813 16.2705L10.2919 17.751C11.3831 18.2535 12.6394 18.2535 13.7306 17.751L16.9414 16.2705V18.837C16.9414 19.6597 16.6144 20.448 16.0331 21.0292C15.4519 21.6105 14.6636 21.9375 13.8409 21.9375H10.1786C9.35588 21.9375 8.56763 21.6105 7.98637 21.0292C7.40513 20.448 7.07813 19.6597 7.07813 18.837V16.2705Z"
                              fill="black"/>
                    </svg>
                    <p>Akademik təqvim</p>
                </a>
                @can('list-agents')
                    <a href="{{route('agents.index')}}" class="navbar-menu-link {{ request()->routeIs('agents.index') ? 'active' : '' }}">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.1666 20.1667L1.83331 20.1667" stroke="black" stroke-opacity="0.7"
                                  stroke-width="1.5"
                                  stroke-linecap="round"/>
                            <path
                                d="M19.25 20.1667V5.49999C19.25 3.77151 19.25 2.90727 18.7131 2.3703C18.1761 1.83333 17.3118 1.83333 15.5834 1.83333H13.75C12.0215 1.83333 11.1573 1.83333 10.6203 2.3703C10.1881 2.80255 10.1038 3.44686 10.0873 4.58333"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path
                                d="M13.75 20.1667V8.24999C13.75 6.52151 13.75 5.65727 13.213 5.1203C12.6761 4.58333 11.8118 4.58333 10.0833 4.58333H6.41667C4.68818 4.58333 3.82394 4.58333 3.28697 5.1203C2.75 5.65727 2.75 6.52151 2.75 8.24999V20.1667"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M8.25 20.1667V17.4167" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                                  stroke-linecap="round"/>
                            <path d="M5.5 7.33333H11" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                                  stroke-linecap="round"/>
                            <path d="M5.5 10.0833H11" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                                  stroke-linecap="round"/>
                            <path d="M5.5 12.8333H11" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                                  stroke-linecap="round"/>
                        </svg>
                        <p>Agentlər</p>
                    </a>
                @endcan
                <a href="finance.html" class="navbar-menu-link ">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11" cy="11" r="9.16667" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        <path d="M11 5.5V16.5" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path
                            d="M13.75 8.70832C13.75 7.44267 12.5188 6.41666 11 6.41666C9.48122 6.41666 8.25 7.44267 8.25 8.70832C8.25 9.97398 9.48122 11 11 11C12.5188 11 13.75 12.026 13.75 13.2917C13.75 14.5573 12.5188 15.5833 11 15.5833C9.48122 15.5833 8.25 14.5573 8.25 13.2917"
                            stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <p>Maliyyə</p>
                </a>
                @can('list-services')
                    <a href="{{route('services.index')}}" class="navbar-menu-link {{ request()->routeIs('services.index') ? 'active' : '' }}">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.6667 3.66827C16.6604 3.67937 17.7402 3.76779 18.4445 4.47214C19.25 5.27759 19.25 6.57396 19.25 9.16668V14.6667C19.25 17.2594 19.25 18.5558 18.4445 19.3612C17.6391 20.1667 16.3427 20.1667 13.75 20.1667H8.25C5.65728 20.1667 4.36091 20.1667 3.55546 19.3612C2.75 18.5558 2.75 17.2594 2.75 14.6667V9.16668C2.75 6.57396 2.75 5.27759 3.55546 4.47214C4.25981 3.76779 5.33956 3.67937 7.33333 3.66827"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M9.625 12.8333L15.5833 12.8333" stroke="black" stroke-opacity="0.7"
                                  stroke-width="1.5"
                                  stroke-linecap="round"/>
                            <path d="M6.41669 12.8333H6.87502" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                                  stroke-linecap="round"/>
                            <path d="M6.41669 9.625H6.87502" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                                  stroke-linecap="round"/>
                            <path d="M6.41669 16.0417H6.87502" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                                  stroke-linecap="round"/>
                            <path d="M9.625 9.625H15.5833" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                                  stroke-linecap="round"/>
                            <path d="M9.625 16.0417H15.5833" stroke="black" stroke-opacity="0.7" stroke-width="1.5"
                                  stroke-linecap="round"/>
                            <path
                                d="M7.33331 3.20834C7.33331 2.44895 7.94892 1.83334 8.70831 1.83334H13.2916C14.051 1.83334 14.6666 2.44895 14.6666 3.20834V4.12501C14.6666 4.8844 14.051 5.50001 13.2916 5.50001H8.70831C7.94892 5.50001 7.33331 4.8844 7.33331 4.12501V3.20834Z"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        </svg>
                        <p>Xidmətlərimiz</p>
                    </a>
                @endcan

                <div class="menuDropDown">
                    <button class="menuDropBtn" type="button">
                        <svg class="menuDropIcon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="3" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path
                                d="M13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74457 2.35523 9.35522 2.74458 9.15223 3.23463C9.05957 3.45834 9.0233 3.7185 9.00911 4.09799C8.98826 4.65568 8.70226 5.17189 8.21894 5.45093C7.73564 5.72996 7.14559 5.71954 6.65219 5.45876C6.31645 5.2813 6.07301 5.18262 5.83294 5.15102C5.30704 5.08178 4.77518 5.22429 4.35436 5.5472C4.03874 5.78938 3.80577 6.1929 3.33983 6.99993C2.87389 7.80697 2.64092 8.21048 2.58899 8.60491C2.51976 9.1308 2.66227 9.66266 2.98518 10.0835C3.13256 10.2756 3.3397 10.437 3.66119 10.639C4.1338 10.936 4.43789 11.4419 4.43786 12C4.43783 12.5581 4.13375 13.0639 3.66118 13.3608C3.33965 13.5629 3.13248 13.7244 2.98508 13.9165C2.66217 14.3373 2.51966 14.8691 2.5889 15.395C2.64082 15.7894 2.87379 16.193 3.33973 17C3.80568 17.807 4.03865 18.2106 4.35426 18.4527C4.77508 18.7756 5.30694 18.9181 5.83284 18.8489C6.07289 18.8173 6.31632 18.7186 6.65204 18.5412C7.14547 18.2804 7.73556 18.27 8.2189 18.549C8.70224 18.8281 8.98826 19.3443 9.00911 19.9021C9.02331 20.2815 9.05957 20.5417 9.15223 20.7654C9.35522 21.2554 9.74457 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8477 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.902C15.0117 19.3443 15.2977 18.8281 15.781 18.549C16.2643 18.2699 16.8544 18.2804 17.3479 18.5412C17.6836 18.7186 17.927 18.8172 18.167 18.8488C18.6929 18.9181 19.2248 18.7756 19.6456 18.4527C19.9612 18.2105 20.1942 17.807 20.6601 16.9999C21.1261 16.1929 21.3591 15.7894 21.411 15.395C21.4802 14.8691 21.3377 14.3372 21.0148 13.9164C20.8674 13.7243 20.6602 13.5628 20.3387 13.3608C19.8662 13.0639 19.5621 12.558 19.5621 11.9999C19.5621 11.4418 19.8662 10.9361 20.3387 10.6392C20.6603 10.4371 20.8675 10.2757 21.0149 10.0835C21.3378 9.66273 21.4803 9.13087 21.4111 8.60497C21.3592 8.21055 21.1262 7.80703 20.6602 7C20.1943 6.19297 19.9613 5.78945 19.6457 5.54727C19.2249 5.22436 18.693 5.08185 18.1671 5.15109C17.9271 5.18269 17.6837 5.28136 17.3479 5.4588C16.8545 5.71959 16.2644 5.73002 15.7811 5.45096C15.2977 5.17191 15.0117 4.65566 14.9909 4.09794C14.9767 3.71848 14.9404 3.45833 14.8477 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224Z"
                                stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        </svg>
                        <div class="btn-left">
                            Tənzimləmələr
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 7.5L10 12.5L15 7.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </button>
                    <div class="menuDrop-links max-h-[300px] overflow-auto transition-all duration-300 ease-in-out">
                        <a href="{{route('university_lists.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Universitetlər</a>
                        <a href="{{route('school_types.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Məktəb növləri</a>
                        <a href="{{route('education_levels.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Təhsil pillələri</a>
                        <a href="{{route('professions.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">İxtisaslar</a>
                        <a href="{{route('education_languages.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Təhsil dilləri</a>
                        <a href="{{route('education_costs.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Təhsil haqqı</a>
                        <a href="{{route('towns.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Şəhərlər</a>
                        <a href="{{route('countries.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Ölkələr</a>
                        <a href="{{route('setting_documents.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Sənədlər</a>
                        <a href="{{route('education_costs.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Təhsil haqqları</a>
                        <a href="{{route('currencies.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Valyuta</a>
                        <a href="{{route('periods.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Dönəmlər</a>
                        <a href="{{route('program_statuses.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Program statusları</a>
                        <a href="{{route('citizenships.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Vətəndaşlıqlar</a>
                        <a href="{{route('exam_languages.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">İmtahan dilləri</a>
                        <a href="{{route('exams.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">İmtahanlar</a>
                        <a href="{{route('university_education_levels.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Universitet təhsil pillələri</a>
                        <a href="{{route('university_school_types.index')}}" class="block w-full px-3 py-2 rounded-lg border border-[rgba(0,0,0,0.03)] shadow-sm text-[15px] font-light leading-[22.5px] text-left text-[rgba(0,0,0,0.7)] hover:bg-gray-50 transition-colors duration-200">Universitet məktəb növləri</a>
                    </div>
                </div>
        </div>
        @endif
    </div>
    <div class="navbar-menu-bottom w-full">
        <p>Digər</p>
        <div class="navbar-menu-bottom-links flex items-center justify-between mt-4 w-full border-t border-t-[#ccc] pt-[14px]">
{{--            @if(!auth()->user()->hasRole('Student') && !auth()->user()->hasRole('Agent'))--}}
{{--                --}}
{{--            @endif--}}
            <a href="notification.html" class="flex items-center gap-3 mb-3 rounded-lg ">
                <div class="relative">
                    <svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-gray-700">
                        <path d="M17.4167 10.8955V10.25C17.4167 6.70621 14.5438 3.83337 11 3.83337C7.45619 3.83337 4.58335 6.70621 4.58335 10.25V10.8955C4.58335 11.67 4.35408 12.4273 3.92442 13.0718L2.87153 14.6511C1.90983 16.0937 2.64401 18.0545 4.31666 18.5106C8.69233 19.704 13.3077 19.704 17.6834 18.5106C19.356 18.0545 20.0902 16.0937 19.1285 14.6511L18.0756 13.0718C17.646 12.4273 17.4167 11.67 17.4167 10.8955Z" stroke="currentColor" stroke-width="1.5"></path>
                        <path d="M6.875 19.4166C7.47544 21.0188 9.09558 22.1666 11 22.1666C12.9044 22.1666 14.5246 21.0188 15.125 19.4166" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-gray-700">Bildirişlər</span>
                    <span class="bg-red-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">55</span>
                </div>
            </a>
            <a href="{{route('logout')}}" class="exitProfile flex flex-col items-center justify-center" type="button">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.25177 6.41671C8.26287 4.42293 8.35128 3.34318 9.05563 2.63883C9.86109 1.83337 11.1575 1.83337 13.7502 1.83337L14.6668 1.83337C17.2596 1.83337 18.5559 1.83337 19.3614 2.63883C20.1668 3.44429 20.1668 4.74065 20.1668 7.33337L20.1668 14.6667C20.1668 17.2594 20.1668 18.5558 19.3614 19.3613C18.5559 20.1667 17.2596 20.1667 14.6668 20.1667H13.7502C11.1575 20.1667 9.86109 20.1667 9.05563 19.3613C8.35128 18.6569 8.26287 17.5771 8.25177 15.5834"
                        stroke="#FF1346" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M13.75 11L1.83333 11M1.83333 11L5.04167 8.25M1.83333 11L5.04167 13.75" stroke="#FF1346"
                          stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p>Çıxış</p>
            </a>
        </div>
    </div>
    <button class="navToggle" type="button">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 4L10 8L6 12" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
</nav>
