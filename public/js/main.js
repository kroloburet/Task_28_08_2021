/**
 * Ajax loading products section
 *
 * @param select {this} Select element
 * @param {string} categoryId
 */
function orderProducts(select, categoryId) {
    select = $(select);
    const products_wrapper = $(`#products_wrapper`);
    products_wrapper.load(`/task_1/category/${categoryId}?order=${select.val()} #products`);
}

/**
 * Show modal for product
 *
 * @param btn {this} Button from product card
 */
function popupProduct(btn) {
    const data = JSON.parse($(btn).siblings(`textarea`).val());
    const modal = $(`#productModal`);
    modal.find(`#pm_title`).text(data.title);
    modal.find(`#pm_body`).html(
        `<img src="${data.img}" alt="${data.title}">
            <p>Додано: ${data.date}<br>Ціна: ${data.price} UAH</p>`
    );
}
