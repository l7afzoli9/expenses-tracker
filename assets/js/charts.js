async function loadCharts() {
  try {
    const res = await fetch("../api/stats.php");

    if (!res.ok) throw new Error(`Error: ${res.status}`);

    const data = await res.json();

    const categories = data.map((d) => d.category),
      budgets = data.map((d) => d.budgets),
      expenses = data.map((d) => d.expenses);

    mixedChart(categories, budgets, expenses);
    pieChart(categories, expenses);
    budgetAlert(data);
  } catch (err) {
    console.error("loadCharts failed:", err);
  }
}

function mixedChart(categories, budgets, expenses) {
  Chart.getChart("budgetChart")?.destroy();

  const budgetChart = document.getElementById("budgetChart").getContext("2d");
  new Chart(budgetChart, {
    type: "bar",
    data: {
      labels: categories,
      datasets: [
        {
          type: "bar",
          label: "Expenses",
          data: expenses,
          backgroundColor: "rgba(255, 99, 132, 0.75)",
          borderColor: "rgb(255, 99, 132)",
          borderWidth: 2,
          borderRadius: 8,
          borderSkipped: "bottom",
          hoverBackgroundColor: "rgba(255, 99, 132, 0.9)",
        },
        {
          type: "line",
          label: "Budgets",
          data: budgets,
          fill: false,
          borderColor: "rgb(54, 162, 235)",
          borderWidth: 3,
          tension: 0.3,
          pointBackgroundColor: "#fff",
          pointBorderColor: "rgb(54, 162, 235)",
          pointBorderWidth: 2,
          pointRadius: 5,
          pointHoverRadius: 7,
        },
      ],
    },
  });
}

function pieChart(categories, expenses) {
  Chart.getChart("pieChart")?.destroy();

  const colorPalette = [
    "#FF6384",
    "#36A2EB",
    "#FFCE56",
    "#4BC0C0",
    "#9966FF",
    "#FF9F40",
    "#C9CBCF",
    "#2ECC71",
  ];

  const dynamicColors = categories.map(
    (_, index) => colorPalette[index % colorPalette.length],
  );

  const pieChart = document.getElementById("pieChart").getContext("2d");
  new Chart(pieChart, {
    type: "doughnut",
    data: {
      labels: categories,
      datasets: [
        {
          label: "Expenses",
          data: expenses,
          backgroundColor: dynamicColors,
          borderColor: "#ffffff",
          borderWidth: 3,
          hoverOffset: 8,
          borderRadius: 2,
        },
      ],
    },
    options: {
      cutout: "70%",
      plugins: {
        legend: {
          position: "bottom",
          labels: {
            usePointStyle: true,
            padding: 15,
            font: {
              size: 12,
            },
          },
        },
      },
    },
  });
}

function budgetAlert(data) {
  const alertBox = document.getElementById("alerts");
  alertBox.innerHTML = "";
  data.forEach((d) => {
    if (d.budgets > 0 && d.expenses > d.budgets) {
      alertBox.innerHTML += `
        <div class="alert alert-danger">
            Over budget on <strong>${d.category}</strong>:
            spent $${d.expenses} / $${d.budgets}
        </div>`;
    }
  });
}

loadCharts();
