<div class="sidebar-wrapper">
    <div class="logo-wrapper">
        <a href="{{ route('dashboard') }}"><img class="img-fluid for-light"
                src="{{ asset('assets/images/logo/logo-pml.png') }}" alt="logo" width="70px" height="20px" /><img
                class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo-pml.png') }}" alt="logo" width="70px"
                height="20px" /></a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar">
            <i class="status_toggle middle sidebar-toggle" data-feather="grid">
            </i>
        </div>
    </div>
    <div class="logo-icon-wrapper">
        <a href="{{ route('dashboard') }}"><img class="img-fluid" src="{{ asset('') }}assets/images/logo/logo-icon.png"
                alt="" /></a>
    </div>
    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow">
            <i data-feather="arrow-left"></i>
        </div>
        <div id="sidebar-menu">
            <ul class="sidebar-links custom-scrollbar">
                <li class="back-btn">
                    <a href="{{ route('dashboard') }}"><img class="img-fluid"
                            src="{{ asset('') }}assets/images/logo/logo-icon.png" alt="" /></a>
                    <div class="mobile-back text-right">
                        <span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i>
                    </div>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="{{ route('dashboard') }}"><i
                            data-feather="home"></i><span class="lan-3">Dashboard</span></a>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="{{route('category.index')}}"><i
                            data-feather="list"></i><span>Category</span></a>
                </li>
                <li class="sidebar-list">
                    <label class="badge badge-info">2</label><a class="sidebar-link sidebar-title" href="#"><i
                            data-feather="map"></i><span>Obyek Wisata</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('map')}}">Add Locations</a></li>
                        <li><a href="{{route('location.index')}}">Data Locations</a></li>
                        <li><a href="#">Alam</a></li>
                        <li><a href="#">Buatan</a></li>
                        <li><a href="#">Religi</a></li>
                        <li><a href="#">Hotel</a></li>
                    </ul>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="{{route('banner.index')}}"><i
                            data-feather="image"></i><span>Banner</span></a>
                </li>
                <li class="sidebar-list">
                    <label class="badge badge-info">2</label><a class="sidebar-link sidebar-title" href="#"><i
                            data-feather="paperclip"></i><span>News Feed</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('news.index') }}">Data News</a></li>
                        <li><a href="">Comments</a></li>
                    </ul>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="{{route('users.index')}}"><i
                            data-feather="user"></i><span>Users</span></a>
                </li>
            </ul>
        </div>
        <div class="right-arrow" id="right-arrow">
            <i data-feather="arrow-right"></i>
        </div>
    </nav>
</div>