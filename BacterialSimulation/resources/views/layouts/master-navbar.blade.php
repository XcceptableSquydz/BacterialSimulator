<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="/account">Account</a>
              <a class="dropdown-item" href="/edit_account">Edit Account</a>
              <a class="dropdown-item" href="/">Home</a>
            </div>
          </li>
            <!-- if the uesr isn't logged in show the login button, otherwise show the logout button-->
            <li>
                @if (Auth::guest())
                <a class="navbar-brand" href="/login">Login</a>
                <a class="navbar-brand" href="/register">Create Account</a>
                @else
                <a class="navbar-brand" href="/logout">Logout</a>
                @endif
            </li>
        </ul>
    </div>
</nav>