<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="/">my-iot</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link {{ ($title === "dashboard") ? 'active' : '' }}" aria-current="page" href="/dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ ($title === "devices") ? 'active' : '' }}" href="/devices">Devices</a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ ($title === "rules") ? 'active' : '' }}" href="/rules">Rules</a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ ($title === "users") ? 'active' : '' }}" href="/users">Users</a>
            </li>
        </ul>
        </div>
    </div>
</nav>