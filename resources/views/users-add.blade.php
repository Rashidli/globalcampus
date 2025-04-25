<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/swiper/swiper.css">
    <link rel="stylesheet" href="./assets/jquery-nice-select-1.1.0/css/nice-select.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="./assets/style/style.css">
</head>
<body>
    <div class="dashboard">
        <nav>
            <div class="navbar-top">
                <a href="index.html" class="nav-logo">
                    <img src="./assets/images/logo.svg" alt="">
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
                            <path d="M18 6L6 18" stroke="#1C274C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 6L18 18" stroke="#1C274C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>         
                    </button>
                </div>
                <div class="navbar-menu-links">
                    <a href="index.html" class="navbar-menu-link ">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.70356 4.21762C6.11108 3.94533 6.53897 3.70916 6.98232 3.51061C8.23987 2.94743 8.86865 2.66584 9.70515 3.20778C10.5416 3.74972 10.5416 4.6387 10.5416 6.41667V7.79167C10.5416 9.52015 10.5416 10.3844 11.0786 10.9214C11.6156 11.4583 12.4798 11.4583 14.2083 11.4583H15.5833C17.3613 11.4583 18.2503 11.4583 18.7922 12.2948C19.3341 13.1313 19.0526 13.7601 18.4894 15.0177C18.2908 15.461 18.0547 15.8889 17.7824 16.2964C16.8255 17.7285 15.4654 18.8447 13.8742 19.5038C12.2829 20.1629 10.532 20.3353 8.84274 19.9993C7.15349 19.6633 5.60181 18.8339 4.38393 17.6161C3.16605 16.3982 2.33666 14.8465 2.00065 13.1572C1.66463 11.468 1.83709 9.71704 2.4962 8.1258C3.15531 6.53456 4.27148 5.1745 5.70356 4.21762Z" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M19.6588 6.47991C18.9147 4.59094 17.409 3.08529 15.5201 2.34114C14.107 1.78445 12.8333 3.06455 12.8333 4.58333V8.25C12.8333 8.75626 13.2437 9.16667 13.75 9.16667H17.4166C18.9354 9.16667 20.2155 7.89299 19.6588 6.47991Z" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        </svg>   
                        Statistika                         
                    </a>
                    <div class="menuDropDown">
                        <button class="menuDropBtn" type="button">
                            <div class="btn-left">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.75 11C2.75 14.457 2.75 18.0188 3.95818 19.0927C5.16637 20.1667 7.11091 20.1667 11 20.1667C14.8891 20.1667 16.8336 20.1667 18.0418 19.0927C19.25 18.0188 19.25 14.457 19.25 11" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                                    <path d="M13.4373 13.0184L18.944 11.3664C19.4899 11.2026 19.7628 11.1207 19.936 10.9245C19.9697 10.8863 20.0002 10.8453 20.0272 10.802C20.1654 10.5797 20.1654 10.2947 20.1654 9.72483C20.1654 7.47886 20.1654 6.35587 19.5485 5.59769C19.4299 5.45197 19.2967 5.31878 19.151 5.20021C18.3928 4.58331 17.2698 4.58331 15.0238 4.58331H6.97355C4.72757 4.58331 3.60459 4.58331 2.84641 5.20021C2.70069 5.31878 2.5675 5.45197 2.44893 5.59769C1.83203 6.35587 1.83203 7.47886 1.83203 9.72483C1.83203 10.2947 1.83203 10.5797 1.97024 10.802C1.99717 10.8453 2.02766 10.8863 2.06139 10.9245C2.23459 11.1207 2.50752 11.2026 3.0534 11.3664L8.56007 13.0184" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                                    <path d="M5.95703 4.58331C6.71185 4.56418 7.47801 4.08365 7.73485 3.37361C7.74275 3.35177 7.75085 3.32747 7.76705 3.27887L7.79057 3.20831C7.82924 3.0923 7.84859 3.03427 7.86927 2.98281C8.13345 2.32568 8.75251 1.87948 9.45947 1.83667C9.51483 1.83331 9.57598 1.83331 9.69828 1.83331H12.2995C12.4218 1.83331 12.483 1.83331 12.5383 1.83667C13.2453 1.87948 13.8644 2.32568 14.1285 2.98281C14.1492 3.03428 14.1686 3.09229 14.2072 3.20831L14.2308 3.27887C14.2469 3.32718 14.2551 3.35183 14.263 3.37361C14.5198 4.08365 15.2855 4.56418 16.0404 4.58331" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                                    <path d="M12.832 11.4583H9.16536C8.91223 11.4583 8.70703 11.6635 8.70703 11.9166V13.898C8.70703 14.0854 8.82113 14.254 8.99514 14.3236L9.63693 14.5803C10.5111 14.9299 11.4863 14.9299 12.3605 14.5803L13.0023 14.3236C13.1763 14.254 13.2904 14.0854 13.2904 13.898V11.9166C13.2904 11.6635 13.0852 11.4583 12.832 11.4583Z" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                Səlahiyyətlər   
                            </div>
                            <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1.5L6 6.5L11 1.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                
                        </button>
                        <!-- hansina click etsen active gelecek o linke -->
                        <div class="menuDrop-links">
                            <a href="users.html" class="menuDrop-link active">İstifadəçilər</a>
                            <a href="rolls.html" class="menuDrop-link">Rollar</a>
                            <a href="permissions.html" class="menuDrop-link">Permissions</a>
                        </div>
                    </div>
                    <a href="students.html" class="navbar-menu-link">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="8.24998" cy="5.49998" r="3.66667" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M13.75 8.25C15.2688 8.25 16.5 7.01878 16.5 5.5C16.5 3.98122 15.2688 2.75 13.75 2.75" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <ellipse cx="8.24998" cy="15.5834" rx="6.41667" ry="3.66667" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M16.5 12.8333C18.1081 13.186 19.25 14.079 19.25 15.125C19.25 16.0685 18.3207 16.8877 16.9583 17.2979" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        Tələbələr
                    </a>
                    <a href="employees.html" class="navbar-menu-link ">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.75 11C2.75 14.457 2.75 18.0188 3.95818 19.0927C5.16637 20.1667 7.11091 20.1667 11 20.1667C14.8891 20.1667 16.8336 20.1667 18.0418 19.0927C19.25 18.0188 19.25 14.457 19.25 11" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M13.4386 13.0184L18.9453 11.3664C19.4912 11.2026 19.7641 11.1208 19.9373 10.9245C19.971 10.8863 20.0015 10.8453 20.0284 10.802C20.1666 10.5797 20.1666 10.2948 20.1666 9.72485C20.1666 7.47888 20.1666 6.35589 19.5497 5.59771C19.4312 5.45199 19.298 5.3188 19.1523 5.20023C18.3941 4.58333 17.2711 4.58333 15.0251 4.58333H6.97483C4.72886 4.58333 3.60587 4.58333 2.84769 5.20023C2.70197 5.3188 2.56878 5.45199 2.45021 5.59771C1.83331 6.35589 1.83331 7.47888 1.83331 9.72485C1.83331 10.2948 1.83331 10.5797 1.97153 10.802C1.99845 10.8453 2.02894 10.8863 2.06267 10.9245C2.23587 11.1208 2.50881 11.2026 3.05468 11.3664L8.56135 13.0184" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M5.95831 4.58333C6.71314 4.56421 7.47929 4.08367 7.73614 3.37363C7.74404 3.35179 7.75213 3.32749 7.76833 3.27889L7.79185 3.20833C7.83052 3.09232 7.84987 3.03429 7.87055 2.98284C8.13473 2.3257 8.75379 1.8795 9.46075 1.83669C9.51611 1.83333 9.57726 1.83333 9.69956 1.83333H12.3008C12.4231 1.83333 12.4843 1.83333 12.5396 1.83669C13.2466 1.8795 13.8656 2.3257 14.1298 2.98284C14.1505 3.0343 14.1698 3.09231 14.2085 3.20833L14.232 3.27889C14.2481 3.32721 14.2564 3.35185 14.2642 3.37363C14.5211 4.08367 15.2868 4.56421 16.0416 4.58333" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M12.8333 11.4583H9.16665C8.91352 11.4583 8.70831 11.6635 8.70831 11.9167V13.898C8.70831 14.0854 8.82242 14.254 8.99643 14.3236L9.63821 14.5803C10.5124 14.93 11.4876 14.93 12.3617 14.5803L13.0035 14.3236C13.1775 14.254 13.2916 14.0854 13.2916 13.898V11.9167C13.2916 11.6635 13.0864 11.4583 12.8333 11.4583Z" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>     
                        İşçilər                       
                    </a>
                    <a href="universities.html" class="navbar-menu-link ">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.96747 3.20801C10.2701 2.59733 11.7298 2.59733 13.0324 3.20801L19.166 6.08358C20.5002 6.70908 20.5002 8.8743 19.166 9.49979L13.0325 12.3753C11.7299 12.986 10.2701 12.986 8.96755 12.3753L2.83395 9.49975C1.49977 8.87426 1.49977 6.70904 2.83395 6.08354L8.96747 3.20801Z" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M1.83331 7.79166V12.8333" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M17.4166 10.5417V15.24C17.4166 16.164 16.9551 17.0291 16.1468 17.4768C14.8008 18.2222 12.6463 19.25 11 19.25C9.35364 19.25 7.19921 18.2222 5.8532 17.4768C5.04486 17.0291 4.58331 16.164 4.58331 15.24V10.5417" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>  
                        Universitetlər                          
                    </a>
                    <a href="university_categories.html" class="navbar-menu-link ">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.29169 5.95834C2.29169 3.93329 3.93331 2.29167 5.95835 2.29167C7.9834 2.29167 9.62502 3.93329 9.62502 5.95834V8.40278C9.62502 8.68694 9.62502 8.82902 9.59379 8.94559C9.50902 9.26192 9.26194 9.50901 8.9456 9.59377C8.82903 9.625 8.68696 9.625 8.4028 9.625H5.95835C3.93331 9.625 2.29169 7.98338 2.29169 5.95834Z" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M12.375 13.5972C12.375 13.3131 12.375 13.171 12.4062 13.0544C12.491 12.7381 12.7381 12.491 13.0544 12.4062C13.171 12.375 13.3131 12.375 13.5972 12.375H16.0417C18.0667 12.375 19.7083 14.0166 19.7083 16.0417C19.7083 18.0667 18.0667 19.7083 16.0417 19.7083C14.0166 19.7083 12.375 18.0667 12.375 16.0417V13.5972Z" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M2.29169 16.0417C2.29169 14.0166 3.93331 12.375 5.95835 12.375H8.15835C8.67173 12.375 8.92843 12.375 9.12451 12.4749C9.29699 12.5628 9.43723 12.703 9.52511 12.8755C9.62502 13.0716 9.62502 13.3283 9.62502 13.8417V16.0417C9.62502 18.0667 7.9834 19.7083 5.95835 19.7083C3.93331 19.7083 2.29169 18.0667 2.29169 16.0417Z" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M12.375 5.95834C12.375 3.93329 14.0166 2.29167 16.0417 2.29167C18.0667 2.29167 19.7083 3.93329 19.7083 5.95834C19.7083 7.98338 18.0667 9.625 16.0417 9.625H13.4226C13.301 9.625 13.2402 9.625 13.189 9.61924C12.764 9.57136 12.4286 9.23596 12.3808 8.81097C12.375 8.75982 12.375 8.69901 12.375 8.57739V5.95834Z" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        </svg>
                        Universitet kateqoriyaları                            
                    </a>
                    <a href="agencies.html" class="navbar-menu-link ">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.1666 20.1667L1.83331 20.1667" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M19.25 20.1667V5.49999C19.25 3.77151 19.25 2.90727 18.7131 2.3703C18.1761 1.83333 17.3118 1.83333 15.5834 1.83333H13.75C12.0215 1.83333 11.1573 1.83333 10.6203 2.3703C10.1881 2.80255 10.1038 3.44686 10.0873 4.58333" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M13.75 20.1667V8.24999C13.75 6.52151 13.75 5.65727 13.213 5.1203C12.6761 4.58333 11.8118 4.58333 10.0833 4.58333H6.41667C4.68818 4.58333 3.82394 4.58333 3.28697 5.1203C2.75 5.65727 2.75 6.52151 2.75 8.24999V20.1667" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M8.25 20.1667V17.4167" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M5.5 7.33333H11" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M5.5 10.0833H11" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M5.5 12.8333H11" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        Agentlər     
                    </a>
                    <a href="finance.html" class="navbar-menu-link ">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11" cy="11" r="9.16667" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M11 5.5V16.5" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M13.75 8.70832C13.75 7.44267 12.5188 6.41666 11 6.41666C9.48122 6.41666 8.25 7.44267 8.25 8.70832C8.25 9.97398 9.48122 11 11 11C12.5188 11 13.75 12.026 13.75 13.2917C13.75 14.5573 12.5188 15.5833 11 15.5833C9.48122 15.5833 8.25 14.5573 8.25 13.2917" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        Maliyyə
                    </a>
                    <a href="services.html" class="navbar-menu-link ">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.6667 3.66827C16.6604 3.67937 17.7402 3.76779 18.4445 4.47214C19.25 5.27759 19.25 6.57396 19.25 9.16668V14.6667C19.25 17.2594 19.25 18.5558 18.4445 19.3612C17.6391 20.1667 16.3427 20.1667 13.75 20.1667H8.25C5.65728 20.1667 4.36091 20.1667 3.55546 19.3612C2.75 18.5558 2.75 17.2594 2.75 14.6667V9.16668C2.75 6.57396 2.75 5.27759 3.55546 4.47214C4.25981 3.76779 5.33956 3.67937 7.33333 3.66827" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                            <path d="M9.625 12.8333L15.5833 12.8333" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M6.41669 12.8333H6.87502" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M6.41669 9.625H6.87502" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M6.41669 16.0417H6.87502" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M9.625 9.625H15.5833" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M9.625 16.0417H15.5833" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M7.33331 3.20834C7.33331 2.44895 7.94892 1.83334 8.70831 1.83334H13.2916C14.051 1.83334 14.6666 2.44895 14.6666 3.20834V4.12501C14.6666 4.8844 14.051 5.50001 13.2916 5.50001H8.70831C7.94892 5.50001 7.33331 4.8844 7.33331 4.12501V3.20834Z" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                        </svg>
                        Xidmətlərimiz                            
                    </a>
                </div>
                <div class="navbar-menu-bottom">
                    <p>Digər</p>
                    <div class="navbar-menu-bottom-links">
                        <a href="notification.html" class="navbar-menu-bottom-link">
                            <svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.4167 10.8955V10.25C17.4167 6.70621 14.5438 3.83337 11 3.83337C7.45619 3.83337 4.58335 6.70621 4.58335 10.25V10.8955C4.58335 11.67 4.35408 12.4273 3.92442 13.0718L2.87153 14.6511C1.90983 16.0937 2.64401 18.0545 4.31666 18.5106C8.69233 19.704 13.3077 19.704 17.6834 18.5106C19.356 18.0545 20.0902 16.0937 19.1285 14.6511L18.0756 13.0718C17.646 12.4273 17.4167 11.67 17.4167 10.8955Z" stroke="black" stroke-opacity="0.7" stroke-width="1.5"/>
                                <path d="M6.875 19.4166C7.47544 21.0188 9.09558 22.1666 11 22.1666C12.9044 22.1666 14.5246 21.0188 15.125 19.4166" stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            Bildirişlər
                            <span>55</span>   
                        </a>
                        <button class="exitProfile" type="button">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.25177 6.41671C8.26287 4.42293 8.35128 3.34318 9.05563 2.63883C9.86109 1.83337 11.1575 1.83337 13.7502 1.83337L14.6668 1.83337C17.2596 1.83337 18.5559 1.83337 19.3614 2.63883C20.1668 3.44429 20.1668 4.74065 20.1668 7.33337L20.1668 14.6667C20.1668 17.2594 20.1668 18.5558 19.3614 19.3613C18.5559 20.1667 17.2596 20.1667 14.6668 20.1667H13.7502C11.1575 20.1667 9.86109 20.1667 9.05563 19.3613C8.35128 18.6569 8.26287 17.5771 8.25177 15.5834" stroke="#FF1346" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M13.75 11L1.83333 11M1.83333 11L5.04167 8.25M1.83333 11L5.04167 13.75" stroke="#FF1346" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Çıxış                                
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        <div class="dashboard-body">
            <div class="page-head">
                <h1>İstifadəçilər</h1>
                <div class="head-userProfile">
                    <h2>Ramil Seyidov</h2>
                    <!-- Burada userin ad ve soyadinin ilk herifi olacaq -->
                    <p>RS</p>
                </div>
            </div>
            <a href="users.html" class="goBack">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0303 6.46967C10.3232 6.76256 10.3232 7.23744 10.0303 7.53033L6.31066 11.25L14.5 11.25C15.4534 11.25 16.8667 11.5298 18.0632 12.3913C19.298 13.2804 20.25 14.7556 20.25 17C20.25 17.4142 19.9142 17.75 19.5 17.75C19.0858 17.75 18.75 17.4142 18.75 17C18.75 15.2444 18.0353 14.2196 17.1868 13.6087C16.3 12.9702 15.2133 12.75 14.5 12.75L6.31066 12.75L10.0303 16.4697C10.3232 16.7626 10.3232 17.2374 10.0303 17.5303C9.73744 17.8232 9.26256 17.8232 8.96967 17.5303L3.96967 12.5303C3.67678 12.2374 3.67678 11.7626 3.96967 11.4697L8.96967 6.46967C9.26256 6.17678 9.73744 6.17678 10.0303 6.46967Z" fill="black"/>
                </svg>
                Geri                    
            </a>
            <div class="addNewUser-container">
                <h2>Yeni istifadəçi əlavə et</h2>
                <form action="" class="addNewUserForm" method="post">
                    <div class="form-items">
                        <div class="form-item"> 
                            <label for="">Email</label>
                            <input type="email" placeholder="Email">
                        </div>
                        <div class="form-item">
                            <label for="">Ad və soyad</label>
                            <input type="text" placeholder="Ad və soyad">
                        </div>
                        <div class="form-item">
                            <label for="">Şifrə</label>
                            <div class="password">
                                <input type="password" placeholder="Şifrə">
                                <button class="show_password_btn" type="button">
                                    <svg class="show-eye" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.72843 12.7464C2.02015 11.8262 1.66602 11.3661 1.66602 9.99999C1.66602 8.63385 2.02015 8.17377 2.72843 7.2536C4.14265 5.41629 6.51444 3.33333 9.99935 3.33333C13.4843 3.33333 15.856 5.41629 17.2703 7.2536C17.9785 8.17377 18.3327 8.63385 18.3327 9.99999C18.3327 11.3661 17.9785 11.8262 17.2703 12.7464C15.856 14.5837 13.4843 16.6667 9.99935 16.6667C6.51444 16.6667 4.14265 14.5837 2.72843 12.7464Z" stroke="#000" stroke-width="1.5"></path>
                                        <path d="M12.5 10C12.5 11.3807 11.3807 12.5 10 12.5C8.61929 12.5 7.5 11.3807 7.5 10C7.5 8.61929 8.61929 7.5 10 7.5C11.3807 7.5 12.5 8.61929 12.5 10Z" stroke="#000" stroke-width="1.5"></path>
                                    </svg>  
                                    <svg class="hidden-eye" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22.2954 6.31065C22.6761 6.47382 22.8524 6.91473 22.6893 7.29545L21.9999 7.00001C22.6893 7.29545 22.6894 7.29527 22.6893 7.29545L22.6886 7.29713L22.6875 7.29961L22.6843 7.30697L22.6736 7.33105C22.6646 7.35118 22.6518 7.3794 22.6352 7.41508C22.6019 7.48643 22.5533 7.58776 22.4888 7.71416C22.3599 7.96681 22.1675 8.32069 21.9084 8.73647C21.4828 9.41951 20.8724 10.2777 20.0619 11.1302L21.0303 12.0985C21.3231 12.3914 21.3231 12.8663 21.0303 13.1592C20.7374 13.4521 20.2625 13.4521 19.9696 13.1592L18.969 12.1586C18.3093 12.7113 17.5528 13.23 16.695 13.6562L17.6286 15.091C17.8545 15.4382 17.7562 15.9027 17.409 16.1286C17.0618 16.3546 16.5972 16.2562 16.3713 15.909L15.2821 14.2352C14.5028 14.4897 13.659 14.6626 12.7499 14.7246V16.5C12.7499 16.9142 12.4141 17.25 11.9999 17.25C11.5857 17.25 11.2499 16.9142 11.2499 16.5V14.7246C10.3689 14.6645 9.54909 14.5002 8.78982 14.2584L7.71575 15.9091C7.48984 16.2563 7.02526 16.3546 6.67807 16.1287C6.33089 15.9028 6.23257 15.4382 6.45847 15.091L7.37089 13.6888C6.5065 13.2667 5.74381 12.7502 5.07842 12.1983L4.11744 13.1592C3.82455 13.4521 3.34968 13.4521 3.05678 13.1592C2.76389 12.8664 2.76389 12.3915 3.05678 12.0986L3.98055 11.1748C3.15599 10.3151 2.53525 9.44656 2.10277 8.75468C1.83984 8.33404 1.6446 7.97566 1.51388 7.7197C1.44848 7.59164 1.3991 7.48895 1.36537 7.41665C1.3485 7.38048 1.33553 7.35189 1.32641 7.33149L1.31562 7.3071L1.31238 7.29966L1.31129 7.29714L1.31088 7.29619C1.31081 7.29602 1.31056 7.29545 1.99992 7.00001L1.31088 7.29619C1.14772 6.91547 1.32376 6.47382 1.70448 6.31065C2.08489 6.14762 2.52539 6.32356 2.68888 6.70363C2.68882 6.7035 2.68894 6.70376 2.68888 6.70363L2.68983 6.70582L2.69591 6.71953C2.7018 6.73273 2.7114 6.75392 2.72472 6.78249C2.75139 6.83965 2.79296 6.92626 2.84976 7.03748C2.96345 7.2601 3.13762 7.58028 3.37472 7.95961C3.85033 8.72048 4.57157 9.7071 5.55561 10.6216C6.42151 11.4263 7.48259 12.1676 8.75165 12.6558C9.70614 13.023 10.7854 13.25 11.9999 13.25C13.2416 13.25 14.342 13.0128 15.3124 12.6308C16.5738 12.1343 17.6277 11.3883 18.4866 10.582C19.4562 9.67198 20.1668 8.69517 20.6354 7.94321C20.869 7.56832 21.0405 7.25228 21.1525 7.03268C21.2085 6.92296 21.2494 6.83758 21.2757 6.78125C21.2888 6.7531 21.2983 6.73224 21.3041 6.71925L21.31 6.70577L21.3106 6.70457C21.3105 6.70467 21.3106 6.70447 21.3106 6.70457M22.2954 6.31065C21.9147 6.14753 21.4738 6.32405 21.3106 6.70457L22.2954 6.31065ZM2.68888 6.70363C2.68882 6.7035 2.68894 6.70376 2.68888 6.70363V6.70363Z" fill="#000"></path>
                                    </svg>                            
                                </button>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="">İstifadəçi adı</label>
                            <select name="" id="">
                                <option value="">İstifadəçi adı1</option>
                                <option value="">İstifadəçi adı2</option>
                                <option value="">İstifadəçi adı3</option>
                                <option value="">İstifadəçi adı4</option>
                                <option value="">İstifadəçi adı5</option>
                                <option value="">İstifadəçi adı6</option>
                            </select>
                        </div>
                    </div>
                    <button class="addUserBtn" type="submit">Əlavə et</button>
                </form>
            </div>
        </div>
    </div>
    

    <script src="./assets/jquery-nice-select-1.1.0/js/jquery.js"></script>
    <script src="./assets/jquery-nice-select-1.1.0/js/jquery.nice-select.min.js"></script>
    <script>
        $(document).ready(function () {
            $('select').niceSelect()
        })
    </script>
    <script src="./assets/swiper/swiper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Datepicker ayarları
            $('.datepicker').datetimepicker({
                format: 'd/m/Y', // Tarih formatı
                timepicker: false, // Sadece tarih seçimi
                lang: 'az' // Dil ayarı
            });

            // Takvim ikonuna veya input alanına tıklandığında datepicker'ı aç
            $('.datepicker').on('click', function () {
                $(this).datetimepicker('show');
            });
        });
    </script>
    <script src="./assets/js/index.js"></script>
</body>
</html>