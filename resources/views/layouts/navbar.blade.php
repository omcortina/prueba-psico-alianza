<nav class="navbar top-navbar navbar-expand-md navbar-light">
  <div class="navbar-header">
    <a class="navbar-brand" href="#">
      <b>
        <img
          src="{{ asset('assets/images/logo-icon.png') }}"
          alt="homepage"
          class="dark-logo"
        />
      </b>
      <span>
        <img
          src="{{ asset('assets/images/logo-text.png') }}"
          alt="homepage"
          class="dark-logo"
        />
      </span>
    </a>
  </div>
  <div class="navbar-collapse">
    <ul class="navbar-nav me-auto">
      <li class="nav-item">
        <a
          class="
            nav-link nav-toggler
            hidden-md-up
            waves-effect waves-dark
          "
          href="javascript:void(0)"
          ><i class="ti-menu"></i
        ></a>
      </li>
    </ul>
    <ul class="navbar-nav my-lg-0">
      <li class="nav-item">
        <a class="nav-link waves-effect waves-dark" href="#"
          ><img
            src="{{ asset('assets/images/users/1.jpg') }}"
            alt="user"
            class="profile-pic"
        /></a>
      </li>
    </ul>
  </div>
</nav>