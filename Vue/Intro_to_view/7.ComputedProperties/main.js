var app = new Vue({
    el: "#app", 
    data: {
        product: 'Socks', 
        image: '../2.Attributes/socks.png',
        brand: 'vue mastery',
        inventory: 6,
        selectedVariant: 0,
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
        updateProduct(index) {
            this.selectedVariant = index;
        }
    },
    computed: {
        title() {
            return `${this.brand} ${this.product}`;
        }
    },
    image(){
        return this.variants[this.selectedVariant].variantImage;
    },
    inStock(){
        return this.variants[this.selectedVariant].variantQuantity;
    }
})