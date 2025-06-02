document.addEventListener('DOMContentLoaded', function () {
    let selectedProducts = [];
  
    document.querySelectorAll('.product-card').forEach(function (card) {
      const checkbox = card.querySelector('.btn-check');
      const quantitySelector = card.querySelector('.quantity-selector');
      const colorSelector = card.querySelector('.color-selector');
      const radioLabel = card.querySelector('.radio-label');
      const productId = card.getAttribute('data-product-id');
  
      checkbox.addEventListener('change', function () {
        if (checkbox.checked) {
          quantitySelector.style.display = 'flex';
          colorSelector.style.display = 'flex';
          radioLabel.style.backgroundColor = '#00E01A';
          radioLabel.style.color = 'white';
          card.classList.add('selected-card'); 
  
          // Add product to selectedProducts array
          addProductToSelection(productId);
        } else {
          quantitySelector.style.display = 'none';
          colorSelector.style.display = 'none';
          radioLabel.style.backgroundColor = 'white';
          radioLabel.style.color = '#00E01A';
          card.classList.remove('selected-card'); 
  
          // Remove product from selectedProducts array
          removeProductFromSelection(productId);
        }
      });
    });
  
    function addProductToSelection(productId) {
      const quantity = document.getElementById('quantity-' + productId).value;
      const color = document.getElementById('exampleColorInput-' + productId).value;
  
      selectedProducts = selectedProducts.filter(p => p.product_id !== productId);
  
      selectedProducts.push({
        product_id: productId,
        quantity: quantity,
        color: color
      });
  
      updateHiddenInputs();
    }
  
    function removeProductFromSelection(productId) {
      selectedProducts = selectedProducts.filter(p => p.product_id !== productId);
  
      updateHiddenInputs();
    }
  
    function updateHiddenInputs() {
      const container = document.querySelector('.product-selections');
      container.innerHTML = '';
  
      selectedProducts.forEach(product => {
        const inputGroup = document.createElement('div');
        inputGroup.className = 'product-selection';
  
        inputGroup.innerHTML = `
          <input type="hidden" name="selectedProducts[][product_id]" value="${product.product_id}">
          <input type="hidden" name="selectedProducts[][quantity]" value="${product.quantity}">
          <input type="hidden" name="selectedProducts[][color]" value="${product.color}">
        `;
  
        container.appendChild(inputGroup);
    });
    }
  
    window.incrementQuantity = function (id) {
      var input = document.getElementById('quantity-' + id);
      input.value = parseInt(input.value) + 1;
  
      // Update hidden input for selected quantity
      document.querySelector(`input[name="selectedProducts[][product_id]"][value="${id}"]`).nextElementSibling.value = input.value;
    };
  
    window.decrementQuantity = function (id) {
      var input = document.getElementById('quantity-' + id);
      if (input.value >= 1) {
        input.value = parseInt(input.value) - 1;
  
        // Update hidden input for selected quantity
        document.querySelector(`input[name="selectedProducts[][product_id]"][value="${id}"]`).nextElementSibling.value = input.value;
      }
    };
  });
  