<h1 class="text-center">
  <?php echo isset($_GET['id']) ? "Modification" : "Inscription"; ?>
</h1>
<form method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Lastname</label>
    <input type="text" name="name" class="form-control" value="" required>
  </div>

  <div class="mb-3">
    <label for="mail" class="form-label">First_name</label>
    <input type="email" name="mail" class="form-control" value="" required>
  </div>

  <div class="mb-3">
    <p>Les espaces sont interdits</p>
    <label for="pass" class="form-label">Adress</label>
    <input type="text" class="form-control" id="address" name="address">
  </div>

  <div class="mb-3">
    <label for="zip_code" class="form-label">Zip Code</label>
    <input type="text" class="form-control" id="zip_code" name="zip_code" required>
  </div>

  <div class="mb-3">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city" name="city" required>
  </div>

  <div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="tel" class="form-control" id="phone" name="phone" required>
  </div>

  <div class="mb-3">
    <label for="type" class="form-label">Type</label>
    <select class="form-control" id="type" name="type" required>
      <option value="">--Select Type--</option>
      <option value="Prof">Prof</option>
      <option value="eleve">eleve</option>
    </select>
  </div>

  <button type="submit">crée
  </button>
</form>
