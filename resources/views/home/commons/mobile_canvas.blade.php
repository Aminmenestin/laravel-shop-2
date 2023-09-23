<div class="mobile-off-canvas-active">
    <a class="mobile-aside-close">
        <i class="sli sli-close"></i>
    </a>

    <div class="header-mobile-aside-wrap">
        <div class="mobile-search">
            <form class="search-form" action="#">
                <input type="text" placeholder=" ... جستجو " />
                <button class="button-search">
                    <i class="sli sli-magnifier"></i>
                </button>
            </form>
        </div>

        <div class="mobile-menu-wrap">
            <!-- mobile menu start -->
            <div class="mobile-navigation">
                <!-- mobile menu navigation start -->
                <nav>
                    <ul class="mobile-menu text-right">
                        <li class="menu-item-has-children">
                            <a href="index.html"> صفحه ای اصلی </a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="shop.html">فروشگاه</a>
                            <ul class="dropdown">


                                @php
                                    $parent_categories = App\Models\Category::where('parent_id', 0)
                                        ->where('is_active', 1)
                                        ->get();
                                @endphp

                                @foreach ($parent_categories as $category)
                                    <li class="menu-item-has-children">
                                        <a href="#">{{ $category->name }}</a>
                                        <ul class="dropdown">
                                            @foreach ($category->children as $child)
                                                <li>
                                                    <a
                                                        href="{{ route('home.categories.show', ['category' => $child->slug]) }}">
                                                        {{ $child->name }}
                                                    </a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </li>
                                @endforeach

                            </ul>
                        </li>

                        <li><a href="contact-us.html">تماس با ما</a></li>

                        <li><a href="about_us.html"> در باره ما</a></li>
                    </ul>
                </nav>
                <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->
        </div>

        <div class="mobile-curr-lang-wrap">
            <div class="single-mobile-curr-lang">
                <ul class="text-right">

                    @guest
                        <li class="my-3"><a href="{{ route('home.login') }}">ورود</a></li>
                    @endguest
                    @auth
                        <li class="my-3">
                            <a href="{{ route('admin.dashboard') }}" target="_blank">صفحه ادمین</a>
                        </li>
                    @endauth
                    @auth
                        <li class="my-3"><a href="{{ route('home.profile.index') }}">پروفایل</a></li>
                    @endauth
                    <li class="my-3"><a href="{{ route('home.compare.index') }}">مقایسه</a></li>
                    @auth
                        <li class="my-3"><a href="{{ route('home.logout') }}">خروج</a></li>
                    @endauth

                </ul>
            </div>
        </div>

        <div class="mobile-social-wrap text-center">
            <a class="facebook" href="#"><i class="sli sli-social-facebook"></i></a>
            <a class="twitter" href="#"><i class="sli sli-social-twitter"></i></a>
            <a class="pinterest" href="#"><i class="sli sli-social-pinterest"></i></a>
            <a class="instagram" href="#"><i class="sli sli-social-instagram"></i></a>
            <a class="google" href="#"><i class="sli sli-social-google"></i></a>
        </div>
    </div>
</div>
