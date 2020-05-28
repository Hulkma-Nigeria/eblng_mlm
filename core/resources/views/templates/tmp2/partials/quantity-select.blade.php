<div class="quantity buttons_added">
    <input type="button" value="-" class="minus btn-number" data-type="minus">
<input type="text" step="1" min="1" max="{{$product->stock}}" name="quantity" value="{{$current_val??'1'}}" title="Qty"
class="input-text qty text" size="4" pattern="" inputmode="" onchange="updatePrice({{$product->id}},this,'#price')">
    <input type="button" value="+" class="plus btn-number" data-type="plus">
</div>
