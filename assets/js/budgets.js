const budgetForm = document.getElementById("budgetForm");
budgetForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const editId = budgetForm.dataset.editId;
  const method = editId ? "PUT" : "POST";
  const url = editId
    ? `../api/budgets.php?budget_id=${editId}`
    : `../api/budgets.php`;

  const formData = new FormData(budgetForm);
  const jsObject = Object.fromEntries(formData);

  try {
    const res = await fetch(url, {
      method: method,
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(jsObject),
    });

    if (res.ok) {
      budgetForm.reset();
      delete budgetForm.dataset.editId;
      initBudgetDefaults();

      if (typeof loadBudgets === "function") await loadBudgets();
      if (typeof loadCharts === "function") await loadCharts();
    }
  } catch (err) {
    console.error("Error submitting budget:", err);
  }
});
