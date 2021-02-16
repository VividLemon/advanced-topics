Vue.component('product', {
    props:{
        premium: {
            type: Boolean,
            required: true
        }
    },
    template: `<div>
    <div class="product-image">
    <img v-bind:src="image">
</div>
<!-- <div class="product-iamge"> this is the quicker way to do the same above
    <img :src="image">
</div> -->
<div class="product-info">
    <h1>{{ title }}</h1>
    <p v-if="inventory > 10">In Stock</p>
    <p v-else-if="inventory <= 10 && inventory > 0"> Almost out of stock</p>
    <p v-else>Out of Stock</p>
    <p v-show="inStock">In stock</p>
    <p>User is premium: {{ premium }}</p>

    <ul>
        <li v-for="detail in details">{{detail}}</li>
    </ul>
    <div v-for="(variant, index) in variants" 
    :key="variant.variantId"
    class="color-box"
    :style="{backgroundColor:variant.variantColor}"
    @mouseover="updateProduct(index)">
    
    </div>
    <button v-on:click="addToCart">Add to cart</button> 
    <!-- v-on can be replaced with @click -->
    <div class="cart">
        <p>Cart {{cart}}</p>
    </div>
</div>
</div>`,
    data() {
        return {
            product: 'Socks',
            image: '../2.Attributes/socks.png',
            brand: 'vue mastery',
            inventory: 6,
            selectedVariant: 0,
            details: ["80% cotton", "20% polyester", "gender-neutral"],
            variants: [{
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
        }
    },
    methods: {
        addToCart: function () {
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
    image() {
        return this.variants[this.selectedVariant].variantImage;
    },
    inStock() {
        return this.variants[this.selectedVariant].variantQuantity;
    }
});
var app = new Vue({
    el: "#app"

});