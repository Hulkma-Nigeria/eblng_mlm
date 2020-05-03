<template>
        <div class="product-grid p-2 text-left">

            <div class="form-group">
                <label for="address">Delivery address</label>
                <textarea  name="address" id="address">
                </textarea>
            </div>
            <div class="form-group">
                <label for="info">Other Info</label>
                <textarea name="other_info" id="info">
                </textarea>
            </div>
            <div class="pt-1 pb-4">
                <p>Account: {{bl}}</p>
                <p>Cart total: {{ct}}</p>
                <p>Estimated Balance: {{netBalance}}</p>
                <p>Total point value: {{pv}}</p>
            </div>
            <button class="add-to-cart" v-if="netBalance" :disabled="ct <= 0">
                Checkout
            </button>
            <a href="user/deposit" class="add-to-cart text-center" v-if="!netBalance">
                Fund your account
            </a>
        </div>
</template>

<script>
    export default {
        name: 'cart-summary-component',
        props: ['cartTotal', 'balance', 'pointValue'],
        data: function() {
            return {
                netBalance: 0,
                ct: this.cartTotal,
                bl: this.balance,
                pv: this.pointValue
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
