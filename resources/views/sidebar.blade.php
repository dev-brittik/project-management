@php $current_route = Route::currentRouteName(); @endphp
<!-- Sidebar Navigation -->
<div class="ol-sidebar">
    <div class="sidebar-logo-area">
        <a href="#" class="sidebar-logos">
            <img class="sidebar-logo-lg" height="50px" src="assets/images/logo-full.svg" alt="">
            <img class="sidebar-logo-sm" height="40px" src="#public/assets/upload/favicon/favicon-1716465915.png"
                alt="">
        </a>
        <button class="sidebar-cross menu-toggler d-block d-lg-none">
            <span class="fi-rr-cross"></span>
        </button>
    </div>
    <h3 class="sidebar-title fs-12px px-30px pb-20px mt-4 text-uppercase">Main Menu</h3>
    <div class="sidebar-nav-area">
        <nav class="sidebar-nav">
            <ul class="px-14px pb-24px">

                <li class="sidebar-first-li @if ($current_route == get_current_user_role() . '.dashboard ') active showMenu @endif">
                    <a href="{{ route(get_current_user_role() . '.dashboard') }}">
                        <span class="icon fi-rr-house-blank"></span>
                        <div class="text">
                            <span>Dashboard</span>
                        </div>
                    </a>
                </li>


                <li class="sidebar-first-li @if ($current_route == 'projects') active showMenu @endif ">
                    <a href="{{ route(get_current_user_role() . '.projects') }}">
                        <span class="icon fi-rr-chart-tree-map"></span>
                        <div class="text">
                            <span>Projects</span>
                        </div>
                    </a>
                </li>

                <li class="sidebar-first-li @if ($current_route == 'users') active showMenu @endif ">
                    <a href="{{ route(get_current_user_role() . '.users') }}">
                        <span class="icon fi-rr-chart-tree-map"></span>
                        <div class="text">
                            <span>Users</span>
                        </div>
                    </a>
                </li>

                <li class="sidebar-first-li @if ($current_route == 'roles') active showMenu @endif ">
                    <a href="{{ route(get_current_user_role() . '.roles') }}">
                        <span class="icon fi-rr-chart-tree-map"></span>
                        <div class="text">
                            <span>Roles</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-first-li @if ($current_route == 'permissions') active showMenu @endif ">
                    <a href="{{ route(get_current_user_role() . '.permissions') }}">
                        <span class="icon fi-rr-chart-tree-map"></span>
                        <div class="text">
                            <span>Permissions</span>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>



        {{-- <nav class="sidebar-nav">
             <h3 class="sidebar-title fs-12px px-30px pb-3 text-uppercase">Settings</h3>
             <ul class="px-14px pb-24px pb-5 mb-5">
                 <li class="sidebar-first-li first-li-have-sub ">
                     <a href="javascript:void(0);">
                         <span class="icon fi fi-rr-settings"></span>
                         <div class="text">
                             <span>System Settings</span>
                         </div>
                     </a>
                     <ul class="first-sub-menu">
                         <li class="first-sub-menu-title fs-14px mb-18px">System Settings</li>
                         <li class="sidebar-second-li ">
                             <a href="#system_settings">System
                                 Settings</a>
                         </li>
                         <li class="sidebar-second-li ">
                             <a href="#website_settings">Website
                                 Settings</a>
                         </li>
                         <li class="sidebar-second-li ">
                             <a href="#payment_settings">Payment
                                 Settings</a>
                         </li>

                         <li class="sidebar-second-li ">
                             <a href="#manage_language">Manage
                                 Language</a>
                         </li>

                         <li class="sidebar-second-li ">
                             <a href="#live-class/settings">Live Class
                                 Settings</a>
                         </li>
                         <li class="sidebar-second-li "><a href="#notification_settings">SMTP
                                 Settings</a></li>

                         <li class="sidebar-second-li ">
                             <a href="#certificate_settings">Certificate
                                 Settings</a>
                         </li>

                         <li class="sidebar-second-li "><a href="#open-ai/settings">Open AI
                                 Settings</a></li>

                         <li class="sidebar-second-li "><a href="#pages">Home Page Builder</a></li>

                         <li class="sidebar-second-li "><a href="#seo_settings">SEO Settings</a>
                         </li>

                         <li class="sidebar-second-li "><a href="#about">About</a></li>
                     </ul>
                 </li>

                 <li class="sidebar-first-li ">
                     <a href="#manage_profile">
                         <span class="icon fi-rr-circle-user"></span>
                         <div class="text">
                             <span>Manage Profile</span>
                         </div>
                     </a>
                 </li>

                 <div class="color-palettes d-flex gap-2 align-items-center" style="width: 100%; flex-wrap: wrap;">
                     @php
                         $columns = Schema::getColumnListing('color_sets') ?? [];
                         $columns = array_slice($columns, 2);
                     @endphp

                     @foreach ($columns as $column)
                         <div class="bg-primary text-white px-3 py-2 rounded-pill text-capitalize cursor-pointer"
                             id="{{ $column }}" onclick="toggleColor(this)">{{ $column }}</div>
                     @endforeach
                 </div>

                 <script>
                     function toggleColor(elem) {
                         const palette = elem.getAttribute('id');
                         const htmlElement = document.querySelector('html');
                         htmlElement.className = '';
                         htmlElement.classList.add(palette);

                         $
                     }
                 </script>
             </ul>
         </nav> --}}
    </div>
</div>
