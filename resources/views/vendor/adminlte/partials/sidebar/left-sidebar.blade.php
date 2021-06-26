<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif
    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @if(Auth::user()->type==1)
                    <li class="nav-item">
                        <a class="nav-link  {{ request()->route()->getName() === 'dashboard' ?'active' : '' }}" href="{{route('dashboard')}}">
                            <i class="fas fa-home "></i>

                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{ request()->route()->getName() === 'customers' ?'active' : '' }}" href="{{route('customers')}}">
                            <i class="fas fa-fw fa-user "></i>
                            <p>
                                Customers
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{ request()->route()->getName() === 'invoice-index' ?'active' : '' }}" href="{{route('invoice-index')}}">
                            <i class="fas fa-fw fa-file-invoice-dollar "></i>
                            <p>
                                Orders
                            </p>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === 'users' ?'active' : '' }} " href="{{route('users')}}">
                            <i class="fas fa-fw fa-user "></i>
                            <p>
                                users
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

</aside>
