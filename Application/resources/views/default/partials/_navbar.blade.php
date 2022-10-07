@includeIf("{$context}.partials._logo_container")

<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            @includeIf("{$context}.partials._navbar_options")
        </ul>
    </div>
</nav>
