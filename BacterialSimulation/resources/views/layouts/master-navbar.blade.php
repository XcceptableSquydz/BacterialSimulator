<nav role="navigation" class="navbar navbar-expand-md navbar-light bg-light fixed-top">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span> 
    </button>
  </div>
  <!-- Collection of nav links and other content for toggling -->
  <div id="navbar" class="navbar">
    <ul class="nav navbar-nav navbar-left">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          @if (Auth::guest())
          <a class="dropdown-item" href="/">Home</a>
          <a class="dropdown-item" href="/register">Create Account</a>
          <a class="dropdown-item" href="/login">Login</a>
          @else
          <a class="dropdown-item" href="/">Home</a>
          <a class="dropdown-item" href="/account">Account</a>
          <a class="dropdown-item" href="/edit_account">Edit Account</a>
          <a class="dropdown-item" href="/logout">Logout</a>
          @endif
        </div>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <!-- if the uesr isn't logged in show the login button, otherwise show the logout button-->
      <li>
        @if (Auth::guest())
        <a class="navbar-brand" href="/register">Create Account</a>
        <a class="navbar-brand" href="/login">Login</a>
        @else
        <a class="navbar-brand" href="/account">Account</a>
        <a class="navbar-brand" href="/logout">Logout</a>
        @endif
      </li>
    </ul>
  </div>
</nav>







