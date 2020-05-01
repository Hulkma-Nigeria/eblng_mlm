<template>
        <div class="product-grid p-2 text-left">

            <div class="form-group">
                <label for="address">Delivery address</label>
                <textarea  name="address" id="address">
                </textarea>
            </div>
            <div class="form-group">
                <label for="info">Other Info</label>
                <textarea name="info" id="info">
                </textarea>
            </div>
            <div class="pt-1 pb-4">
                <p>Account: {{bl}}</p>
                <p>Cart total: {{ct}}</p>
                <p>Balance: {{netBalance}}</p>
            </div>
            <button class="add-to-cart" v-if="netBalance">
                Checkout
            </button>
            <button class="add-to-cart" v-if="!netBalance">
                Fund your account
            </button>
        </div>
</template>

<script>
    export default {
        name: 'cart-summary-component',
        props: ['cartTotal', 'balance'],
        data: function() {
            return {
                netBalance: 0,
                ct: this.cartTotal,
                bl: this.balance
            }
        },
        mounted() {
            this.calculate();
        },
        methods:  {
            calculate () {
                const bal =  this.bl - this.ct;
                this.netBalance = bal > 0 ? bal: 0;
            }
        }
    }
</script>
<style scoped>
    textarea {
        height: 70px;
    }
</style>
