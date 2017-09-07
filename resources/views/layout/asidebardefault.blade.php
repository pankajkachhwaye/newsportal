<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="images/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  {{ Auth::user()->name }}</div>
                <div class="email">  {{ Auth::user()->email }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="material-icons">input</i>Sign Out</a></li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                {{--<li class="header">MAIN NAVIGATION</li>--}}
                <li class="{{(isset($page) && $page && $page=='home')?'active':''}}">
                    <a href={{url('/home')}}>
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                {{--<li>--}}
                    {{--<a href="{{url('/merchant')}}">--}}
                        {{--<i class="material-icons">text_ficlass="menu-toggle"elds</i>--}}
                        {{--<span>client Registration</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li  class="{{(isset($page) && $page && $page=='language')?'active':''}}">
                    <a href="{{url('add-language')}}">
                        <i class="material-icons">widgets</i>
                        <span>Languages</span>
                    </a>
                </li>

                <li  class="{{(isset($page) && $page && $page=='category')?'active':''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">widgets</i>
                        <span>Categories</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{(isset($sub_page) && $sub_page && $sub_page=='category-add')?'active':''}}">
                            <a href="{{url('/Categories/add')}}">
                                <span>Add</span>
                            </a>
                        </li>
                        <li class="{{(isset($sub_page) && $sub_page && $sub_page=='category-show')?'active':''}}">
                            <a href="{{url('/Categories/show')}}">
                                <span>Show</span>
                            </a>

                        </li>
                    </ul>
                </li>

                <li  class="{{(isset($page) && $page && $page=='news')?'active':''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">widgets</i>
                        <span>News</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{(isset($sub_page) && $sub_page && $sub_page=='news-add')?'active':''}}">
                            <a href="{{url('/add-news')}}">
                                <span>Add</span>
                            </a>
                        </li>
                        <li class="{{(isset($sub_page) && $sub_page && $sub_page=='news-show')?'active':''}}">
                            <a href="{{url('/show-news')}}">
                                <span>Show</span>
                            </a>

                        </li>
                    </ul>
                </li>
                <li  class="{{(isset($page) && $page && $page=='notification')?'active':''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">widgets</i>
                        <span>Notifications</span>
                    </a>

                    <ul class="ml-menu">
                        <li class="{{(isset($sub_page) && $sub_page && $sub_page=='notify-all-users')?'active':''}}">
                            <a href="{{url('send-notification-all-user')}}">
                                <span>All users</span>
                            </a>
                        </li>
                        <li class="{{(isset($sub_page) && $sub_page && $sub_page=='notify-registered-users')?'active':''}}">
                            {{--<a href="{{url('/send-notification-register-user')}}">--}}
                            <a href="{{url('send-notification-registered-user')}}">
                                <span>Register users</span>
                            </a>

                </li>
                {{--<li  class="{{(isset($page) && $page && $page=='language')?'active':''}}">
                    <a href="{{url('add-language')}}">
                        <i class="material-icons">widgets</i>
                        <span>Languages</span>
                    </a>
                </li>--}}
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2017 <a href="javascript:void(0);">News Portal </a>.
            </div>
            <div class="version">
                {{--<b>Version: </b> 1.0.0--}}
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <!-- #END# Right Sidebar -->
</section>