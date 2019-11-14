$(document).ready(function () {
  let count = 1
  $('#addIngredientBtn').click(function () {
    $('#ingredient-amount' + count++).parent('div').after(
      '<div class="ingredient"><input placeholder="Ingredient" id="ingredient-name' +
            count + '"/><input placeholder="Amount" id="ingredient-amount' + count + '"/> <select><option value="dl">dl</option><option value="kg">kg</option><option value="g">g</option><option value="cl">cl</option><option value="tbsp">tbsp</option><option value="tsp">tsp</option><option value="ml">ml</option><option value="l">l</option><option value="hg">hg</option><option value="pcs">pcs</option></select></div>')
  })
})
