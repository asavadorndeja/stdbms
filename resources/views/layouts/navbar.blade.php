<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <!-- <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'laravel') }}
            </a> -->
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">

              <li><a href='#'>AD</a></li>
              <!-- <li><a href='{{ route('tel1.index')}}'>TE</a></li> -->

              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TE<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('tel1.index')}}">Tender</a></li>
                    <li><a href="/tel1TenderbyStatus">Tender by status</a></li>
                    <li><a href="/tel1TenderbyPotential">Tender by potential</a></li>
                    <li><a href="/tel1TenderAward">Tender award</a></li>
                    <li><a href="/tel1TenderManPower">Tender man power</a></li>

                    <!-- <li><a href='#'>Lesson learn (CR)</a></li> -->
                    <!-- <li><a href='#'>Design review (CR)</a></li> -->
                  </ul>
              </li>


              <!-- <li><a href='{{ route('pel1.index')}}'>PE</a></li> -->
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PE<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('pel1.index')}}">Project and CTR</a></li>
                    <li><a href="{{ route('pel4.index')}}">Timesheet</a></li>
                    <!-- <li><a href='#'>Lesson learn (CR)</a></li> -->
                    <!-- <li><a href='#'>Design review (CR)</a></li> -->
                  </ul>
              </li>



              <li><a href='#'>OU</a></li>
              <li><a href='#'>DC</a></li>
              <li><a href='#'>HS</a></li>
              <li><a href='{{ route('hrl1.index')}}'>HR</a></li>
              <li><a href='#'>MM</a></li>
              <li><a href='#'>QA</a></li>


              <li><a href='{{ route('user.index')}}'>User</a></li>
              <!-- <li><a href='{{ route('pel4.index')}}'>Timesheet</a></li> -->


            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <!-- <li><a href="{{ route('register') }}">Register</a></li> -->
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
