<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>
    <div class="form-container">
        <h1 class="text-center">Accedi</h1>
        <p class="text-center">Inserisci i tuoi dati per accedere</p>
        <form action="login.php" method="POST" class='row g-3 needs-validation' novalidate>
        <div class="col-md-7">
          <label for="validationCustomEmail" class="form-label">Email</label>
          <div class="input-group has-validation">
            <input type="email" name="email" class="form-control" id="validationCustomEmail" aria-describedby="inputGroupPrepend" required>
            <div class="invalid-feedback">
              Per favore inserisci una mail valida.
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <label for="inputPassword6" class="col-form-label">Password</label>
          <div class="col-auto">
            <input type="password" name="pass" id="validationCustonPwd" class="form-control" aria-describedby="passwordHelpInline" minlength="8" required>
            <div class="invalid-feedback">
                Per favore inserisci una password valida.
            </div>
          </div>
        </div>
        <div class="col-12">
          <button class="btn btn-primary" type="submit">Invia</button>
        </div>
      </form>
    </div>
</div>
<!--<main class="d-flex align-items-center justify-content-center text-white text-center vh-100">
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
</main>-->