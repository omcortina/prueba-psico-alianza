<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="keywords"
      content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Admin-Pro lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Admin-Pro lite design, Admin-Pro lite dashboard bootstrap 5 dashboard template"
    />
    <meta
      name="description"
      content="Admin-Pro Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>Inicio</title>
    <link
      rel="canonical"
      href="https://www.wrappixel.com/templates/adminpro-lite/"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="{{ asset('assets/images/favicon.png') }}"
    />
    <link
      href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}"
      rel="stylesheet"
    />
    <link
      href="{{ asset('assets/plugins/chartist-js/dist/chartist.min.css') }}"
      rel="stylesheet"
    />
    <link
      href="{{ asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}"
      rel="stylesheet"
    />
    <link href="{{ asset('assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/pages/dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/colors/default-dark.css') }}" id="theme" rel="stylesheet" />
  </head>

  <body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <div class="loader">
          <div class="loader__figure"></div>
          <p class="loader__label">Admin Pro</p>
        </div>
    </div>

    <section>         
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="login-card">
                        {{-- <img class="img-fluid bg-img-cover" src="{{ asset('images/login/login_bg.jpg') }}" alt=""> --}}
                        <div class="theme-form login-form">
                            {!! Form::open(array('url' => 'user/validate', 'method' => 'POST')) !!}
                            <div class="login-header text-center">
                              <h4>Bienvenido</h4>
                              <br>
                            </div>
                            @if (session('message_login'))
                              <div id="msg" class="alert alert-danger" >
                                <li>{{session('message_login')}}</li>
                              </div>
                              <script>
                                  setTimeout(function(){ $('#msg').fadeOut() }, 4000);
                              </script>
                            @endif
                            
                            <div class="login-social-title">                
                                <h5>Ingresa con tus credenciales</h5>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group"></i></span>
                                    <input class="form-control" name="identification" id="identification" type="text" placeholder="Identificación">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <div class="input-group">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="*********">
                                </div>
                            </div>
                            <div class="form-group">
                                <button style="width: 100%;" class="btn btn-primary btn-block" type="submit">Ingresar</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('js/waves.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartist-js/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/d3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/c3-master/c3.min.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
  </body>
</html>
