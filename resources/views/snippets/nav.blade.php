<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">@lang('labels.toggle_nav')</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('home') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            @lang('labels.participants') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('participants.index') }}">@lang('labels.list')</a>
                                <a href="{{ route('participants.create') }}">@lang('labels.add')</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            @lang('labels.students') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('students.index') }}">@lang('labels.list')</a>
                                <a href="{{ route('students.create') }}">@lang('labels.add')</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            @lang('labels.schools') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('schools.index') }}">@lang('labels.list')</a>
                                <a href="{{ route('schools.create') }}">@lang('labels.add')</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="{{ route('rooms.index') }}" role="button">
                            @lang('labels.rooms')
                        </a>
                    </li>
                @endif
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            @lang('labels.olympiads') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('olympiads.index') }}">@lang('labels.list')</a>
                                <a href="{{ route('olympiads.create') }}">@lang('labels.add')</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check() && Auth::user()->activeOlympiad)
                    <li class="dropdown">
                        <a href="{{ route('olympiads.show', Auth::user()->activeOlympiad->id) }}" class="dropdown-toggle" role="button">
                            {{ Auth::user()->activeOlympiad->name }}
                        </a>
                    </li>
                @endif
            <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">@lang('labels.login')</a></li>
                    <li><a href="{{ route('register') }}">@lang('labels.register')</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>