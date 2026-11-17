async function loadCategories() {
  try {
    const response = await fetch('../api/categories.php'); // Check your actual API route!
    const categories = await response.json();

    // Select all dropdowns with the class "categories"
    const dropdowns = document.querySelectorAll('.categories');

    dropdowns.forEach(select => {
      select.innerHTML = '<option value="">Select a category...</option>';
      categories.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat.id; // or cat.category_id
        option.textContent = cat.name;
        select.appendChild(option);
      });
    });
  } catch (error) {
    console.error('Failed to load categories:', error);
  }
}