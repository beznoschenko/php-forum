
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/">Home</a>
        </li>
        <?php if (!isset($_SESSION['auth'])){ ?>
        <li class="nav-item">
          <a class="nav-link" href="/register">Registration</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/login">Authorization</a>
        </li>
        <?php } else{?>
        <li class="nav-item">
          <a class="nav-link" href="/logout">Exit</a>
        </li>
        <?php } ?>
       
      </ul>
    </div>
  </div>
</nav>