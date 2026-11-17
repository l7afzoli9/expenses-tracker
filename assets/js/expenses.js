async function fetchExpenses(expense_id = null) {
  const url = expense_id ? `../api/expenses.php?expense_id=${expense_id}` : "../api/expenses.php";

  const res = await fetch(url);
  if (!res.ok) throw new Error(`Error: ${res.status}`);

  return await res.json();
}

async function loadExpenses() {
  try {
    const data = await fetchExpenses();
    const tbody = document.querySelector("#expenses-table tbody");
    tbody.innerHTML = "";

    data.forEach((exp) => {
      tbody.innerHTML += `
        <tr>
            <td>${exp.expense_date || exp.date}</td>
            <td>${exp.category || exp.category_name}</td>
            <td>${exp.note || "—"}</td>
            <td class="text-end fw-bold">$${exp.amount}</td>
            <td>
                <button class="btn btn-sm btn-danger" onclick="deleteExpense(${exp.id})">Delete</button>
                <button class="btn btn-sm btn-primary" onclick="editExpense(${exp.id})">Edit</button>
            </td>
        </tr>`;
    });
  } catch (error) {
    console.error("Failed to load expenses:", error);
  }
}

async function deleteExpense(expense_id) {
  if (!confirm("Delete this expense?")) return;

  try {
    const res = await fetch(`../api/expenses.php?expense_id=${expense_id}`, {
      method: "DELETE",
    });
    if (!res.ok) throw new Error("Could not delete expense");

    await loadExpenses();
    if (typeof loadCharts === "function") await loadCharts();
  } catch (error) {
    console.error(error);
  }
}

async function editExpense(expense_id) {
  try {
    const expense = await fetchExpenses(expense_id);
    if (!expense) throw new Error("Expense not found");

    const formElement = document.getElementById("expenseForm");
    formElement.reset();

    expense.date = expense.expense_date || expense.date;

    Object.entries(expense).forEach(([key, value]) => {
      const field = formElement.elements[key];
      if (field) field.value = value;
    });

    formElement.dataset.editId = expense_id;

    document.getElementById("expenseModalLabel").textContent = `Edit Expense #${expense_id}`;
    document.getElementById("modalSubmitBtn").textContent = "Update Expense";

    if (typeof expenseModal !== "undefined") {
      expenseModal.show();
    }
  } catch (error) {
    console.error("Failed to fetch expense for edit:", error);
  }
}

const expenseForm = document.getElementById("expenseForm");
expenseForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const editId = expenseForm.dataset.editId;
  const method = editId ? "PUT" : "POST";
  const url = editId ? `../api/expenses.php?expense_id=${editId}` : "../api/expenses.php";

  const formData = new FormData(expenseForm);
  const jsObject = Object.fromEntries(formData);

  try {
    const res = await fetch(url, {
      method: method,
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(jsObject)
    });

    if (res.ok) {
      expenseForm.reset();
      delete expenseForm.dataset.editId;

      if (typeof expenseModal !== "undefined") expenseModal.hide();

      await loadExpenses();
      if (typeof loadCharts === "function") await loadCharts();
    }
  } catch (err) {
    console.error("Error submitting expense:", err);
  }
});