<script id="invoiceItemTemplate" type="text/x-jsrender">
<tr class="border-bottom border-bottom-dashed tax-tr">
    <td class="text-center item-number align-center">1</td>
    <td class="table__item-desc w-25">
        <select class="form-select productId product  fw-bold" name="product_id[]" 'data-control' => 'select2' required>
            {{for products}}

        <option value="{{:key }}" {{:key == 2 ? 'selected' : '' }}>{{:value }}</option>
            {{/for}}
        </select>
    </td>
    <td class="table__qty d-none">
        <input class="form-control qty " required="" value='1' name="quantity[]" type="number" min="0" step=".01" oninput="validity.valid||(value=value.replace(/[e\+\-]/gi,''))">
    </td>
    <td>
        <input class="form-control price-input price " required="" name="price[]" type="number" oninput="validity.valid||(value=value.replace(/[e\+\-]/gi,''))" min='0' step='.01' onKeyPress="if(this.value.length==8) return false;">
    </td>
    <td class="">
        <input type="number" name="percentage" class="form-control percentage" id="percentage" readonly oninput="validity.valid||(value=value.replace(/[e\+\-]/gi,''))" min="0" value="0" step=".01" pattern="^\d*(\.\d{0,2})?$" required onkeypress="if(this.value.length==8) return false;">
    </td>
    <td class="tbAmount text-right item-total pt-8 text-nowrap">

    </td>
    <td class="text-end">
        <button type="button" title="Delete" class="btn btn-sm text-danger fs-3 btn-icon btn-active-color-danger delete-invoice-item">
                  <i class="fa-solid fa-trash"></i>
        </button>
    </td>
</tr>



</script>
