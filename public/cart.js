let listQuantity = document.querySelectorAll(".prod-quantity > input");

const BASEPATH = "http://localhost/mvc-basic";

listQuantity.forEach((e) => {
    e.addEventListener("change", (e) => {
        // console.log(e.target.value, e.target.getAttribute('prod-id'))

        let row = e.target.closest("tr");
        let itemPrice = row
            .querySelector(".prod-price p")
            .getAttribute("price");
        let itemTotalprice = row.querySelector(".prod-total p");
        let totalPriceValue = Number(itemPrice) * Number(e.target.value);
        itemTotalprice.setAttribute("total-price", totalPriceValue);
        itemTotalprice.innerHTML = totalPriceValue.toLocaleString() + "đ";

        // get summary price
        let summary = document.querySelector(".summary-price");
        let summaryPrice = 0;
        let listItemsTotalPrice = document.querySelectorAll(".prod-total p");

        listItemsTotalPrice.forEach((e) => {
            summaryPrice += Number(e.getAttribute("total-price"));
        });

        // set new summary price
        summary.innerHTML = summaryPrice.toLocaleString() + "đ";
        summary.setAttribute("summary-price", summaryPrice);

        // get discount cost
        let discount = document.querySelector("#discount");
        let discountValue = discount.getAttribute("discount");
        let discountCost = Math.round(
            (summaryPrice * Number(discountValue)) / 100
        );

        // set new discount cost
        discount.innerHTML = "-" + discountCost.toLocaleString() + "đ";
        discount.setAttribute("cost", discountCost);


        // get ship cost
        let ship = document.querySelector("#ship");
        let shipCost = Number(ship.getAttribute("cost"));


        // set total checkout
        let totalCheckout = document.querySelector("#total-checkout");
        totalCheckout.innerHTML =
            (summaryPrice - discountCost + shipCost).toLocaleString() + "đ";

        let data = {
            cart_id: e.target.getAttribute("cart-id"),
            prod_id: e.target.getAttribute("prod-id"),
            quantity: e.target.value,
        };

        const xhr = new XMLHttpRequest();
        xhr.open("POST", `${BASEPATH}/index.php?url=cart/update`);
        xhr.send(JSON.stringify(data));
    });
});
