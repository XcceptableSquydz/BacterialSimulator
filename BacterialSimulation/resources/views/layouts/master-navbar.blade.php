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
    <ul class="nav navbar-nav">
      <!-- if the user isn't logged in show the login button, otherwise show the logout button-->
      <li>
        <li>
          @if (Auth::guest())
          <a class="navbar-brand" href="/">Home</a>
          <a class="navbar-brand" href="/simulations">Simulations</a>
          <a class="navbar-brand" href="/register">Create Account</a>
          <a class="navbar-brand" href="/login">Login</a>
          @else
          <?php $user = Auth::user()?>
          <a class="navbar-brand" href="/">Home</a>
          <a class="navbar-brand" href="/simulations">Simulations</a>
          <a class="navbar-brand" href="/saved_simulations">Saved Simulations</a>
          @if ($user->user_level == 2 || $user->user_level == 1)
          <a class="navbar-brand" href="/admin_controls">Administrator Controls</a>
          @endif
          <a class="navbar-brand" href="/account">Account</a>
          <a class="navbar-brand" href="/edit_account">Edit Account</a>
          <a class="navbar-brand" href="/logout">Logout</a>
          @endif
        </li>
      </li>
    </ul>
  </div>
</nav>







