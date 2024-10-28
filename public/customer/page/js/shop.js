document.getElementById('category-search').addEventListener('input', function() {
    let filter = this.value.toLowerCase();
    let listItems = document.querySelectorAll('.list-categories li');

    listItems.forEach(function(item) {
        let text = item.textContent.toLowerCase();
        if (text.includes(filter)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});



/* Các class widget widget-categories có thêm one-choice chỉ được chọn 1 */
document.addEventListener('DOMContentLoaded', () => {
    // Chỉ cho phép chọn một checkbox trong widget với class "one-choice"
    const oneChoiceWidgets = document.querySelectorAll('.widget-categories.one-choice .list-categories input[type="checkbox"]');

    oneChoiceWidgets.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                // Bỏ chọn tất cả các checkbox khác trong cùng widget
                oneChoiceWidgets.forEach(otherCheckbox => {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                    }
                });
            }
        });
    });
});



