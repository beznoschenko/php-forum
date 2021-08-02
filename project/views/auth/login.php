
<div  class="container">
<p class="text-center fs-2">LOGIN</p>
<form action="" method="POST"   class="col-md-2 mx-auto">
<div class="mb-3">
    <label for="login" class="form-label">Login</label>
    <input type="text" class="form-control" name="login" id="login">
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>

    <p><?= $error ?></p>
    <input type="submit" value="login"  class="btn btn-primary col-12">
    <br>
    <a href="/register" class="link-primary">create account</a>

</form>
</div>