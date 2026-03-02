<?php

?>
<!doctype html>
<html lang="bs">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>php-mysql-backend | Users</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-light">

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">User Management</h1>
    <input id="searchInput" class="form-control w-auto" style="min-width: 240px" placeholder="Pretraga (ime/email)...">
  </div>

  <div class="row g-3">
    
    <div class="col-12 col-lg-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h2 class="h5">Dodaj korisnika</h2>

          <form id="createForm" action="create.php" method="POST" novalidate>
            <div class="mb-2">
              <label class="form-label">Ime</label>
              <input name="ime" class="form-control" required minlength="2">
              <div class="invalid-feedback">Unesi ime (min 2 slova).</div>
            </div>

            <div class="mb-2">
              <label class="form-label">Prezime</label>
              <input name="prezime" class="form-control" required minlength="2">
              <div class="invalid-feedback">Unesi prezime (min 2 slova).</div>
            </div>

            <div class="mb-2">
              <label class="form-label">Email</label>
              <input name="email" type="email" class="form-control" required>
              <div class="invalid-feedback">Unesi ispravan email.</div>
            </div>

            <button class="btn btn-primary w-100 mt-2">Sačuvaj</button>
          </form>

          <div class="small text-muted mt-3">
            Bonus: JS validacija + SweetAlert + pretraga + paginacija
          </div>
        </div>
      </div>
    </div>

    
    <div class="col-12 col-lg-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-2">
              <thead>
              <tr>
                <th>#</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Email</th>
                <th>Datum</th>
                <th class="text-end">Akcije</th>
              </tr>
              </thead>
              <tbody id="usersTbody"></tbody>
            </table>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small" id="pagingInfo"></div>
            <div class="btn-group" role="group" aria-label="Pagination">
              <button class="btn btn-outline-secondary btn-sm" id="prevPage">Prev</button>
              <button class="btn btn-outline-secondary btn-sm" id="nextPage">Next</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editForm" action="update.php" method="POST" novalidate>
        <div class="modal-header">
          <h5 class="modal-title">Edit user</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editId">

          <div class="mb-2">
            <label class="form-label">Ime</label>
            <input name="ime" id="editIme" class="form-control" required minlength="2">
            <div class="invalid-feedback">Unesi ime.</div>
          </div>

          <div class="mb-2">
            <label class="form-label">Prezime</label>
            <input name="prezime" id="editPrezime" class="form-control" required minlength="2">
            <div class="invalid-feedback">Unesi prezime.</div>
          </div>

          <div class="mb-2">
            <label class="form-label">Email</label>
            <input name="email" id="editEmail" type="email" class="form-control" required>
            <div class="invalid-feedback">Unesi ispravan email.</div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-primary">Sačuvaj</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/script.js"></script>
</body>
</html>