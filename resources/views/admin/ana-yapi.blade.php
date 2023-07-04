@include('admin.include.header')
@include('admin.include.solMenu')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('main')
            
            
@include('admin.include.footer')
