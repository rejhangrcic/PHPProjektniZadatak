let allUsers = [];
let filteredUsers = [];
let page = 1;
const pageSize = 5;

const tbody = document.getElementById("usersTbody");
const searchInput = document.getElementById("searchInput");
const pagingInfo = document.getElementById("pagingInfo");
const prevPage = document.getElementById("prevPage");
const nextPage = document.getElementById("nextPage");

function escapeHtml(str) {
  return String(str ?? "")
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&#039;");
}

async function loadUsers() {
  const res = await fetch("read.php");
  allUsers = await res.json();
  applyFilter();
}

function applyFilter() {
  const q = (searchInput.value || "").toLowerCase().trim();
  filteredUsers = allUsers.filter(u =>
    (u.ime || "").toLowerCase().includes(q) ||
    (u.prezime || "").toLowerCase().includes(q) ||
    (u.email || "").toLowerCase().includes(q)
  );
  page = 1;
  render();
}

function render() {
  const total = filteredUsers.length;
  const totalPages = Math.max(1, Math.ceil(total / pageSize));
  page = Math.min(page, totalPages);

  const start = (page - 1) * pageSize;
  const items = filteredUsers.slice(start, start + pageSize);

  tbody.innerHTML = items.map(u => `
    <tr>
      <td>${escapeHtml(u.id)}</td>
      <td>${escapeHtml(u.ime)}</td>
      <td>${escapeHtml(u.prezime)}</td>
      <td>${escapeHtml(u.email)}</td>
      <td class="text-muted small">${escapeHtml(u.created_at)}</td>
      <td class="text-end">
        <button class="btn btn-sm btn-outline-primary me-1"
          onclick="openEdit(${u.id}, '${escapeHtml(u.ime)}', '${escapeHtml(u.prezime)}', '${escapeHtml(u.email)}')">
          Edit
        </button>
        <button class="btn btn-sm btn-outline-danger"
          onclick="confirmDelete(${u.id})">
          Delete
        </button>
      </td>
    </tr>
  `).join("");

  pagingInfo.textContent = `Page ${page} / ${totalPages} | Users: ${total}`;
  prevPage.disabled = page <= 1;
  nextPage.disabled = page >= totalPages;
}

prevPage.addEventListener("click", () => { page--; render(); });
nextPage.addEventListener("click", () => { page++; render(); });
searchInput.addEventListener("input", applyFilter);


function confirmDelete(id) {
  Swal.fire({
    title: "Obrisati korisnika?",
    text: "Ova akcija se ne može vratiti.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Da, obriši",
    cancelButtonText: "Cancel"
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = `delete.php?id=${id}`;
    }
  });
}


function openEdit(id, ime, prezime, email) {
  document.getElementById("editId").value = id;
  document.getElementById("editIme").value = ime;
  document.getElementById("editPrezime").value = prezime;
  document.getElementById("editEmail").value = email;

  const modal = new bootstrap.Modal(document.getElementById("editModal"));
  modal.show();
}


function enableBootstrapValidation(formId) {
  const form = document.getElementById(formId);
  form.addEventListener("submit", (e) => {
    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
    }
    form.classList.add("was-validated");
  });
}

enableBootstrapValidation("createForm");
enableBootstrapValidation("editForm");

loadUsers();