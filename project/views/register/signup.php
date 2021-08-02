<div class="container">
    <p class="text-center fs-2">REGISTER</p>
    <form action="" method="POST" class="col-4 mx-auto">
        <div class="row">
            <div class="col-md-6">
                <label for="f_name" class="form-label"> First name</label>
                <input type="text" name="f_name" id="f_name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="l_name" class="form-label">Last name</label>
                <input type="text" name="l_name" id="l_name" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="login" class="form-label">Login</label>
                <input type="text" name="login" id="login" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" pattern="[a-zA-Z0-9]+@[a-z]{2,}\.[a-z]{2,}" class="form-control" required>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="c_password" class="form-label">Confirm password</label>
                <input type="password" name="c_password" id="c_password" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">+380</span>
                <input type="text" maxlength="13" name="phone" id="phone" pattern="\d{2}\d{3}\d{2}\d{2}"  class="form-control" required>
            </div>
        </div>


        <p><?= $error ?></p>
        <input type="submit" value="Register" id="sign_button" name="signup" class="btn btn-primary col-12">
        <a href="/login" class="link-primary">have an account?</a>
    </form>
</div>