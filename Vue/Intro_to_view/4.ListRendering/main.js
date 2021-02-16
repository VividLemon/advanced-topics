var app = new Vue({
    el: "#app", 
    data: {
        product: 'Socks', 
        image: '../2.Attributes/socks.png',
        inStock: true,
        inventory: 6,
        details: ["80% cotton", "20% polyester", "gender-neutral"],
        variants: [
            {
                variantId: 2234,
                variantColor: "green"
            },
            {
                variantId: 2235,
                vvariantColor: "blue"
            }
        ]
    }
})