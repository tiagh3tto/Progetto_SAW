<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>
    <div class="form-container">
        <h1 class="text-center">Registrati</h1>
        <p class="text-center">Inserisci i tuoi dati per registrarti</p>
        <form action="registration.php" method="POST" class='row g-3 needs-validation' novalidate>
        <div class="col-md-5">
          <label for="validationCustom01" class="form-label">Nome</label>
          <input type="text" name="firstname" class="form-control" id="validationCustom01" value="Mario" required pattern="[A-Za-z]+" >
            <div class="valid-feedback">
              Ottimo!
            </div>
            <div class="invalid-feedback">
              Per favore inserisci un nome valido.
            </div>
        </div>
        <div class="col-md-5">
          <label for="validationCustom02" class="form-label">Cognome</label>
          <input type="text" name="lastname" class="form-control" id="validationCustom02" value="Rossi" required pattern="[A-Za-z]+">
            <div class="valid-feedback">
              Ottimo!
            </div>
            <div class="invalid-feedback">
                Per favore inserisci un cognome valido.
            </div>
        </div>
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
          <div class="col-auto">
            <span id="passwordHelpInline" class="form-text">
              Dev'essere lunga almeno 8 caratteri.
            </span>
          </div>
        </div>
        <div class="col-md-6">
            <label for="inputPasswordConfirm" class="col-form-label">Conferma Password</label>
          <div class="col-auto">
            <input type="password" name="confirm" id="inputPasswordConfirm" class="form-control" aria-describedby="passwordHelpInlineConfirm" minlength="8" required>
            <div class="invalid-feedback">
                Per favore inserisci una password valida.
          </div>
          </div>
          <div class="col-auto">
            <span id="passwordHelpInlineConfirm" class="form-text">
              Dev'essere lunga almeno 8 caratteri e corrispondere alla password.
            </span>
          </div>  
        </div>
        <div class="col-12">
          <button class="btn btn-primary" name="submit" type="submit">Invia</button>
        </div>
      </form>
    </div>
</div>

<!--
<form class="row g-3 needs-validation" novalidate>
  <div class="col-md-6">
    <label for="validationCustom03" class="form-label">City</label>
    <input type="text" class="form-control" id="validationCustom03" required>
    <div class="invalid-feedback">
      Please provide a valid city.
    </div>
  </div>
  <div class="col-md-3">
    <label for="validationCustom04" class="form-label">State</label>
    <select class="form-select" id="validationCustom04" required>
      <option selected disabled value="">Choose...</option>
      <option>...</option>
    </select>
    <div class="invalid-feedback">
      Please select a valid state.
    </div>
  </div>
  <div class="col-md-3">
    <label for="validationCustom05" class="form-label">Zip</label>
    <input type="text" class="form-control" id="validationCustom05" required>
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
</form>-->