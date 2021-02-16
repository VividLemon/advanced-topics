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
                variantColor: "green",
                variantImage: '../2.Attributes/socks.png'
            },
            {
                variantId: 2235,
                variantColor: "blue"
            }
        ],
        cart: 0
    },
    methods: {
        addToCart: function() {
            this.cart++;
        },
        updateProduct(variantImage) {
            this.image = variantImage;
        }
    }
})