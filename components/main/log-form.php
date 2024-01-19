
<main class="d-flex align-items-center justify-content-center text-white text-center vh-100">
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4" style="background: linear-gradient(to right, #36d1dc, #5b86e5);">
        <h4 class="text-center text-white">Login</h4>
        <form class="mt-3" action="login.php" method="post">
          <div class="form-group">
            <label for="email" class="text-white">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="password" class="text-white">Password</label>
            <input type="password" class="form-control" name="pass" id="password" placeholder="Password">
          </div>
          <button type="submit" name="submit" class="btn btn-light btn-block mt-3">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
</main>