<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form action="/logout" method="post" class="nav-link">
                @csrf
                <button type="submit" class="btn btn-block btn-danger btn-sm"><i class="fas fa-power-off nav-icon"></i> Logout</button>
            </form>
        </li>
    </ul>
</nav>