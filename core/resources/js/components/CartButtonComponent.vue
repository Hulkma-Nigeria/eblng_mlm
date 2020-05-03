<style scoped>
.control {

}
</style>
<template>
    <div class="">
        <div class="price">&#8358;{{ ' ' + amount}}</div>

        <div v-if="quantity > 0" class="add-to-cart d-flex">
            <div  v-on:click="decrement" class="text-center control w-25 d-flex justify-content-center align-items-center">
                <i class="fa fa-minus"></i>
            </div>
            <div class="w-50">
                <input type="text"
                       class="text-center"
                       name="quantity"
                       v-on:change="updateQty"
                       placeholder="Quantity"
                       v-model="quantity" />
            </div>
            <div v-on:click="increment" class="text-center control w-25 d-flex justify-content-center align-items-center">
                <i class="fa fa-plus"></i>
            </div>
        </div>
        <div v-if="quantity <= 0" class="w-100">
            <input type="hidden"
                   class="text-center form-control"
                   name="quantity"
                   placeholder="Quantity"
                   value="0" />
            <button v-on:click="increment" class="add-to-cart w-100">
                Add to cart
            </button>
        </div>
        <div v-if="quantity !== oldQuantity" class="mt-1 text-center">
            <button class="save-changes">
               {{quantity > 0 ? 'Save changes': 'Remove Product'}}
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'cart-button-component',
        props: ['product'],
        data () {
            return {
                quantity: 0,
                oldQuantity: 0,
                currency: '',
                amount: 0,
                unitPrice: 0
            }
        },
        mounted() {
            this.quantity = +this.product.quantity;
            this.oldQuantity = +this.product.quantity;
            this.amount = this.product.cartPrice;
            this.unitPrice = this.product.price;
            this.setInitialAmount(+this.product.cartPrice);
        },
        methods:  {
            increment(){
                this.quantity = this.quantity + 1;
                this.amount = this.unitPrice * this.quantity;
            },
            decrement() {
                if(this.quantity > 1) {
                    this.amount = this.unitPrice * this.quantity;
                }
                this.quantity = this.quantity - 1;
            },
            setInitialAmount(price) {
                this.amount = price;
            },
            updateQty() {
                if(this.quantity > 0) {
                    this.amount = this.unitPrice * this.quantity;
                } else {
                    this.amount = this.unitPrice;
                    this.quantity = 0;
                }
            }
        }
    }
</script>
