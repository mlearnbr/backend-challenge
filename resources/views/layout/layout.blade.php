<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>mLearn - Teste</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="<?=asset('assets/css/core.css')?>" media="screen" rel="stylesheet" type="text/css">
    <link href="<?=asset('assets/css/custom.css')?>" media="screen" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=asset('assets/plugins/jquery-3.4.1.min.js')?>"></script>
</head>
<body>
<div class="wrapper">
    <div class="navbar navbar-expand-lg sticky-top navbar-light custom-carets" id="navbar-header">
        <div class="container">
            <a class="navbar-brand" href="/" title="Logo MLearn">
                <h1><img src="/assets/img/logo.png"></h1>
            </a>
            <button class="navbar-toggler d-lg-none hamburger hamburger--collapse" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item"><a class="nav-link " href="/">Início</a></li>
                </ul>
            </div>
        </div>
    </div>

    @yield('content')
</div>

<script type="text/javascript" src="<?=asset('assets/plugins/popper.min.js')?>"></script>
<script type="text/javascript" src="<?=asset('assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
<script type="text/javascript" src="<?=asset('assets/plugins/jquery.easing.min.js')?>"></script>
<script type="text/javascript" src="<?=asset('assets/plugins/fonts/fontAwesome.js')?>"></script>
<script type="text/javascript" src="<?=asset('assets/plugins/jquery.mask.min.js')?>"></script>
<script type="text/javascript" src="<?=asset('assets/js/custom.js')?>"></script>
</body>
</html>
