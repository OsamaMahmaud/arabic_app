<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ ucfirst(auth()->user()->first_name) }} {{ ucfirst(auth()->user()->last_name) }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">

             {{-- dashboard --}}
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>

             {{-- categories --}}
            {{-- @if (auth()->user()->hasPermission('read_categories')) --}}

            {{-- <li><a href="{{ route('dashboard.homepage.index') }}"><i class="fa fa-th"></i><span>@lang('site.homepage')</span></a></li> --}}

            {{-- @endif --}}

          {{-- homepage with submenu --}}
          <li class="treeview">
            <a href="#">
                <i class="fa fa-home"></i> <span>@lang('site.homepage')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                {{-- Slider Section --}}
                <li>
                    <a href="{{ route('dashboard.homepage.index') }}">
                        <i class="fa fa-sliders"></i> @lang('site.sliders')
                    </a>
                </li>
                {{-- Videos Section --}}
                <li>
                    <a href="{{ route('dashboard.videohome.index') }}">
                        <i class="fa fa-video-camera"></i> @lang('site.videos')
                    </a>
                </li>
            </ul>
          </li>

           {{-- levels with submenu --}}
           <li class="treeview">
            <a href="#">
                <i class="fa fa-tasks"></i> <span>@lang('site.levels')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                {{-- levels Section --}}
                <li>
                    <a href="{{ route('dashboard.levels.index') }}">
                        <i class="fa fa-sliders"></i> @lang('site.levels')
                    </a>
                </li>
                
            </ul>
          </li>


          {{-- Videos with submenu --}}
          <li class="treeview">
            <a href="#">
                <i class="fa fa-video-camera"></i> <span>@lang('site.videos')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                {{-- videos Section --}}
                <li>
                    <a href="{{ route('dashboard.videos.index') }}">
                        <i class="fa fa-video-camera"></i> @lang('site.videos')
                    </a>
                </li>
                
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
                <i class="fa fa-info-circle"></i> <span>@lang('site.instructions')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                {{-- videos Section --}}
                <li>
                    <a href="{{ route('dashboard.instructions.index') }}">
                        <i class="fa fa-info-circle"></i> @lang('site.instructions')
                    </a>
                </li>
                
            </ul>
          </li>

    </ul>

</section>

</aside>