<div class="student-detail-tabs">
    <a href="{{route('students.show', $user->id)}}"
        class="student-detail-tab {{ Str::contains(request()->route()->getName(), 'students') ? 'active' : '' }}">
        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M2.08301 5.91665C2.08301 4.3453 2.08301 3.55962 2.57116 3.07147C3.05932 2.58331 3.84499 2.58331 5.41634 2.58331C6.98769 2.58331 7.77336 2.58331 8.26152 3.07147C8.74967 3.55962 8.74967 4.3453 8.74967 5.91665V15.0833C8.74967 16.6547 8.74967 17.4403 8.26152 17.9285C7.77336 18.4166 6.98769 18.4166 5.41634 18.4166C3.84499 18.4166 3.05932 18.4166 2.57116 17.9285C2.08301 17.4403 2.08301 16.6547 2.08301 15.0833V5.91665Z"
                stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
            <path
                d="M11.25 13.4166C11.25 11.8453 11.25 11.0596 11.7382 10.5715C12.2263 10.0833 13.012 10.0833 14.5833 10.0833C16.1547 10.0833 16.9404 10.0833 17.4285 10.5715C17.9167 11.0596 17.9167 11.8453 17.9167 13.4166V15.0833C17.9167 16.6547 17.9167 17.4403 17.4285 17.9285C16.9404 18.4166 16.1547 18.4166 14.5833 18.4166C13.012 18.4166 12.2263 18.4166 11.7382 17.9285C11.25 17.4403 11.25 16.6547 11.25 15.0833V13.4166Z"
                stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
            <path
                d="M11.25 5.08331C11.25 4.30674 11.25 3.91846 11.3769 3.61217C11.546 3.20379 11.8705 2.87934 12.2789 2.71018C12.5851 2.58331 12.9734 2.58331 13.75 2.58331H15.4167C16.1932 2.58331 16.5815 2.58331 16.8878 2.71018C17.2962 2.87934 17.6206 3.20379 17.7898 3.61217C17.9167 3.91846 17.9167 4.30674 17.9167 5.08331C17.9167 5.85988 17.9167 6.24817 17.7898 6.55445C17.6206 6.96283 17.2962 7.28729 16.8878 7.45645C16.5815 7.58331 16.1932 7.58331 15.4167 7.58331H13.75C12.9734 7.58331 12.5851 7.58331 12.2789 7.45645C11.8705 7.28729 11.546 6.96283 11.3769 6.55445C11.25 6.24817 11.25 5.85988 11.25 5.08331Z"
                stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
        </svg>
        Ümumi
    </a>
    <a href="{{route('educations.index', $user->id)}}" class="student-detail-tab {{ Str::contains(request()->route()->getName(), 'educations') ? 'active' : '' }}">
        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="10" cy="13.8333" r="2.5" stroke="black" stroke-opacity="0.8"
                    stroke-width="1.5"/>
            <path
                d="M10 16.5499L8.11427 18.3578C7.84421 18.6167 7.70918 18.7461 7.59483 18.7909C7.33426 18.893 7.04521 18.8056 6.90814 18.5834C6.84799 18.4858 6.82924 18.3099 6.79175 17.9581C6.77058 17.7594 6.76 17.6601 6.72788 17.5769C6.65596 17.3906 6.50483 17.2457 6.31055 17.1768C6.22377 17.146 6.12016 17.1358 5.91295 17.1155C5.54593 17.0796 5.36243 17.0616 5.26069 17.004C5.02886 16.8725 4.93774 16.5954 5.04421 16.3456C5.09094 16.236 5.22597 16.1065 5.49603 15.8476L6.72788 14.6666L7.59483 13.7997"
                stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
            <path
                d="M10 16.5499L11.8857 18.3578C12.1558 18.6167 12.2908 18.7461 12.4052 18.7909C12.6657 18.893 12.9548 18.8057 13.0919 18.5834C13.152 18.4859 13.1708 18.3099 13.2082 17.9581C13.2294 17.7594 13.24 17.6601 13.2721 17.5769C13.344 17.3906 13.4952 17.2457 13.6894 17.1768C13.7762 17.146 13.8798 17.1358 14.0871 17.1156C14.4541 17.0796 14.6376 17.0616 14.7393 17.004C14.9711 16.8726 15.0623 16.5954 14.9558 16.3456C14.9091 16.236 14.774 16.1065 14.504 15.8476L13.2721 14.6667L12.5 13.8945"
                stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
            <path
                d="M14.4334 15.4965C16.0771 15.479 16.9932 15.376 17.6014 14.7678C18.3337 14.0356 18.3337 12.857 18.3337 10.5V7.16669C18.3337 4.80966 18.3337 3.63115 17.6014 2.89892C16.8692 2.16669 15.6907 2.16669 13.3337 2.16669L6.66699 2.16669C4.30997 2.16669 3.13146 2.16669 2.39922 2.89892C1.66699 3.63115 1.66699 4.80966 1.66699 7.16669L1.66699 10.5C1.66699 12.857 1.66699 14.0356 2.39923 14.7678C3.03955 15.4081 4.02114 15.4885 5.83366 15.4986"
                stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
            <path d="M7.5 5.5L12.5 5.5" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
            <path d="M5.83301 8.41669H14.1663" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
        </svg>
        Təhsil
    </a>
    <a href="{{route('lang.index', $user->id)}}" class="student-detail-tab {{ Str::contains(request()->route()->getName(), 'lang') ? 'active' : '' }}">
        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="10" cy="13.8333" r="2.5" stroke="black" stroke-opacity="0.8"
                    stroke-width="1.5"/>
            <path
                d="M10 16.5499L8.11427 18.3578C7.84421 18.6167 7.70918 18.7461 7.59483 18.7909C7.33426 18.893 7.04521 18.8056 6.90814 18.5834C6.84799 18.4858 6.82924 18.3099 6.79175 17.9581C6.77058 17.7594 6.76 17.6601 6.72788 17.5769C6.65596 17.3906 6.50483 17.2457 6.31055 17.1768C6.22377 17.146 6.12016 17.1358 5.91295 17.1155C5.54593 17.0796 5.36243 17.0616 5.26069 17.004C5.02886 16.8725 4.93774 16.5954 5.04421 16.3456C5.09094 16.236 5.22597 16.1065 5.49603 15.8476L6.72788 14.6666L7.59483 13.7997"
                stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
            <path
                d="M10 16.5499L11.8857 18.3578C12.1558 18.6167 12.2908 18.7461 12.4052 18.7909C12.6657 18.893 12.9548 18.8057 13.0919 18.5834C13.152 18.4859 13.1708 18.3099 13.2082 17.9581C13.2294 17.7594 13.24 17.6601 13.2721 17.5769C13.344 17.3906 13.4952 17.2457 13.6894 17.1768C13.7762 17.146 13.8798 17.1358 14.0871 17.1156C14.4541 17.0796 14.6376 17.0616 14.7393 17.004C14.9711 16.8726 15.0623 16.5954 14.9558 16.3456C14.9091 16.236 14.774 16.1065 14.504 15.8476L13.2721 14.6667L12.5 13.8945"
                stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
            <path
                d="M14.4334 15.4965C16.0771 15.479 16.9932 15.376 17.6014 14.7678C18.3337 14.0356 18.3337 12.857 18.3337 10.5V7.16669C18.3337 4.80966 18.3337 3.63115 17.6014 2.89892C16.8692 2.16669 15.6907 2.16669 13.3337 2.16669L6.66699 2.16669C4.30997 2.16669 3.13146 2.16669 2.39922 2.89892C1.66699 3.63115 1.66699 4.80966 1.66699 7.16669L1.66699 10.5C1.66699 12.857 1.66699 14.0356 2.39923 14.7678C3.03955 15.4081 4.02114 15.4885 5.83366 15.4986"
                stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
            <path d="M7.5 5.5L12.5 5.5" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
            <path d="M5.83301 8.41669H14.1663" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
        </svg>
        Dil
    </a>
    <a href="{{route('programs.index', $user->id)}}" class="student-detail-tab !text-white !bg-blue-700  {{ Str::contains(request()->route()->getName(), 'programs') ? 'active' : '' }}">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M8.96716 3.20801C10.2698 2.59733 11.7295 2.59733 13.0321 3.20801L19.1657 6.08358C20.4999 6.70908 20.4999 8.8743 19.1657 9.49979L13.0322 12.3753C11.7296 12.986 10.2698 12.986 8.96725 12.3753L2.83364 9.49975C1.49946 8.87426 1.49947 6.70904 2.83364 6.08354L8.96716 3.20801Z"
                stroke="white" stroke-opacity="0.8" stroke-width="1.5"/>
            <path d="M1.83301 7.79169V12.8334" stroke="white" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
            <path
                d="M17.4163 10.5417V15.24C17.4163 16.164 16.9548 17.0291 16.1465 17.4768C14.8004 18.2222 12.646 19.25 10.9997 19.25C9.35334 19.25 7.1989 18.2222 5.8529 17.4768C5.04455 17.0291 4.58301 16.164 4.58301 15.24V10.5417"
                stroke="white" stroke-opacity="0.8" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        Müraciət et
    </a>
    <a href="{{route('documents.index', $user->id)}}" class="student-detail-tab {{ Str::contains(request()->route()->getName(), 'documents') ? 'active' : '' }}">
        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M2.5 8.83335C2.5 5.69066 2.5 4.11931 3.47631 3.143C4.45262 2.16669 6.02397 2.16669 9.16667 2.16669H10.8333C13.976 2.16669 15.5474 2.16669 16.5237 3.143C17.5 4.11931 17.5 5.69066 17.5 8.83335V12.1667C17.5 15.3094 17.5 16.8807 16.5237 17.857C15.5474 18.8334 13.976 18.8334 10.8333 18.8334H9.16667C6.02397 18.8334 4.45262 18.8334 3.47631 17.857C2.5 16.8807 2.5 15.3094 2.5 12.1667V8.83335Z"
                stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
            <path d="M6.66699 10.5H13.3337" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
            <path d="M6.66699 7.16669H13.3337" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
            <path d="M6.66699 13.8333H10.8337" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
        </svg>
        Sənədlər
    </a>
    <a href="{{route('student.service.index', $user->id)}}" class="student-detail-tab {{ Str::contains(request()->route()->getName(), 'service') ? 'active' : '' }}">
        <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M14.6667 4.16827C16.6604 4.17937 17.7402 4.26779 18.4445 4.97214C19.25 5.77759 19.25 7.07396 19.25 9.66668V15.1667C19.25 17.7594 19.25 19.0558 18.4445 19.8612C17.6391 20.6667 16.3427 20.6667 13.75 20.6667H8.25C5.65728 20.6667 4.36091 20.6667 3.55546 19.8612C2.75 19.0558 2.75 17.7594 2.75 15.1667V9.66668C2.75 7.07396 2.75 5.77759 3.55546 4.97214C4.25981 4.26779 5.33956 4.17937 7.33333 4.16827"
                stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
            <path d="M9.625 13.3333L15.5833 13.3333" stroke="black" stroke-opacity="0.8"
                  stroke-width="1.5" stroke-linecap="round"/>
            <path d="M6.41699 13.3333H6.87533" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
            <path d="M6.41699 10.125H6.87533" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
            <path d="M6.41699 16.5417H6.87533" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
            <path d="M9.625 10.125H15.5833" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
            <path d="M9.625 16.5417H15.5833" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                  stroke-linecap="round"/>
            <path
                d="M7.33301 3.70831C7.33301 2.94892 7.94862 2.33331 8.70801 2.33331H13.2913C14.0507 2.33331 14.6663 2.94892 14.6663 3.70831V4.62498C14.6663 5.38437 14.0507 5.99998 13.2913 5.99998H8.70801C7.94862 5.99998 7.33301 5.38437 7.33301 4.62498V3.70831Z"
                stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
        </svg>
        Xidmət
    </a>


</div>
