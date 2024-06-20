<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="html/index.html" class="logo-link nk-sidebar-logo">
                            <!-- <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo"> -->
                            <img class="logo-dark logo-img" src="{{ asset('landing/images/home/BumiBaik.png') }}" alt="logo-dark">
                            <!-- <img class="logo-small logo-img logo-img-small" src="./images/logo-small.png" srcset="./images/logo-small2x.png 2x" alt="logo-small"> -->
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Dashboards</h6>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ url('/dashboard') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" viewBox="0 0 24 24"><path fill="green" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z"/></svg></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ url('/partner')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" viewBox="0 0 24 24"><path fill="green" d="M12 9L8.5 5.5L12 2l3.5 3.5L12 9ZM1 20v-4q0-.85.588-1.425T3 14h3.275q.5 0 .95.25t.725.675q.725.975 1.788 1.525T12 17q1.225 0 2.288-.55t1.762-1.525q.325-.425.763-.675t.912-.25H21q.85 0 1.425.575T23 16v4h-7v-2.275q-.875.625-1.888.95T12 19q-1.075 0-2.1-.338T8 17.7V20H1Zm3-7q-1.25 0-2.125-.875T1 10q0-1.275.875-2.138T4 7q1.275 0 2.138.863T7 10q0 1.25-.863 2.125T4 13Zm16 0q-1.25 0-2.125-.875T17 10q0-1.275.875-2.138T20 7q1.275 0 2.138.863T23 10q0 1.25-.863 2.125T20 13Z"/></svg></span>
                                        <span class="nk-menu-text">Partnership</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><svg xmlns="http://www.w3.org/2000/svg" width="550" height="425" viewBox="0 0 512 512"><path fill="green" d="M320 176V16H32v480h128v-96h32v96h288V176ZM112 432H80v-32h32Zm0-80H80v-32h32Zm0-80H80v-32h32Zm0-80H80v-32h32Zm0-80H80V80h32Zm128-32h32v32h-32Zm-48 272h-32v-32h32Zm0-80h-32v-32h32Zm0-80h-32v-32h32Zm0-80h-32V80h32Zm80 320h-32v-32h32Zm0-80h-32v-32h32Zm0-80h-32v-32h32Zm0-80h-32v-32h32v32Zm176 272H320v-32h32v-32h-32v-48h32v-32h-32v-48h32v-32h-32v-32h128Z"/><path fill="green" d="M384 400h32v32h-32zm0-80h32v32h-32zm0-80h32v32h-32z"/></svg></span>
                                        <span class="nk-menu-text">Company</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('company/accounts') }}" class="nk-menu-link"><span class="nk-menu-text">Account</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('company/projects') }}" class="nk-menu-link"><span class="nk-menu-text">Project List</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ url('/newsletter') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" viewBox="0 0 24 24"><path fill="green" d="M5 21q-.825 0-1.413-.588T3 19V5q0-.825.588-1.413T5 3h11l5 5v11q0 .825-.588 1.413T19 21H5Zm2-4h10v-2H7v2Zm0-4h10v-2H7v2Zm8-4h4l-4-4v4ZM7 9h5V7H7v2Z"/></svg></span>
                                        <span class="nk-menu-text">Newsletter</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" viewBox="0 0 24 24"><path fill="green" d="M16 12c2.76 0 5-2.24 5-5s-2.24-5-5-5s-5 2.24-5 5s2.24 5 5 5m5.45 5.6c-.39-.4-.88-.6-1.45-.6h-7l-2.08-.73l.33-.94L13 16h2.8c.35 0 .63-.14.86-.37s.34-.51.34-.82c0-.54-.26-.91-.78-1.12L8.95 11H7v9l7 2l8.03-3c.01-.53-.19-1-.58-1.4M5 11H.984v11H5V11Z"/></svg></span>
                                        <span class="nk-menu-text">Donation</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('donation/manage') }}" class="nk-menu-link"><span class="nk-menu-text">Manage</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('donation/transactions') }}" class="nk-menu-link"><span class="nk-menu-text">Transactions</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ url('/ukm?filter=Enabled') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" viewBox="0 0 24 24"><path fill="green" d="M15 17h2v-3h1v-2l-1-5H2l-1 5v2h1v6h9v-6h4v3zm-6 1H4v-4h5v4zM2 4h15v2H2z"/><path fill="green" d="M20 18v-3h-2v3h-3v2h3v3h2v-3h3v-2z"/></svg></span>
                                        <span class="nk-menu-text">UKM Tani</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ url('/location') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" viewBox="0 0 16 16"><path fill="green" d="M9.156 14.544C10.899 13.01 14 9.876 14 7A6 6 0 0 0 2 7c0 2.876 3.1 6.01 4.844 7.544a1.736 1.736 0 0 0 2.312 0ZM6 7a2 2 0 1 1 4 0a2 2 0 0 1-4 0Z"/></svg></span>
                                        <span class="nk-menu-text">Locations</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ url('plantingpartner') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><svg xmlns="http://www.w3.org/2000/svg" width="700" height="425" viewBox="0 0 640 512"><path fill="green" d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32S80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96s-96 43-96 96s43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4c24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48c0-61.9-50.1-112-112-112z"/></svg></span>
                                        <span class="nk-menu-text">Planting Partner</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ url('treetype') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-growth-fill"></em></span>
                                        <span class="nk-menu-text">Tree Type</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ url('tag') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-tag-alt-fill"></em></em></span>
                                        <span class="nk-menu-text">Print Tag</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
