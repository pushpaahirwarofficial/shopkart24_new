<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span><img src="{{ asset('/assets/dashboard/img/Logo.png') }}" alt="" height="50px" width="100%"></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ Route('admin.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Product">Product</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/showcategory') ? 'active' : '' }}">
            <a href="{{ Route('admin.allcategory') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="category">Category</div>
            </a>
        </li>
        <!--<li class="menu-item {{ request()->is('admin/Showblog') ? 'active' : '' }}">-->
        <!--    <a href="{{ Route('admin.showBlog') }}" class="menu-link">-->
        <!--<i class="menu-icon tf-icons bx bx-news"></i>-->
        <!--        <div data-i18n="category">Blog</div>-->
        <!--    </a>-->
        <!--</li>-->
        <li class="menu-item {{ request()->is('admin/Showorders') ? 'active' : '' }}">
            <a href="{{ Route('admin.Showorders')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                <div data-i18n="category">Orders</div>
            </a>
        </li>
    
        <li class="menu-item {{ request()->is('admin/showcoupons') ? 'active' : '' }}">
            <a href="{{ Route('admin.allcoupons')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-book-content"></i>
                <div data-i18n="category">Coupons</div>
            </a>
        </li>
       
    </ul>
</aside>
<!-- / Menu -->