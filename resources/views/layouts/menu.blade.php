<aside class="left-sidebar">
    <div class="scroll-sidebar">
      <nav class="sidebar-nav">
        <ul id="sidebarnav">
          @if (session('admin') == true)
            <li>
              <a
                class="waves-effect waves-dark"
                href="{{ route('user/list') }}"
                aria-expanded="false"
                ><i class="mdi mdi-account"></i
                ><span class="hide-menu">Usuarios</span></a
              >
            </li>
          @endif
      </nav>
    </div>
  </aside>