document.addEventListener('DOMContentLoaded', function() {
    // Parse product data from a hidden field that we'll add to the Blade template
    const productDataElement = document.getElementById('product-data');
    if (!productDataElement) return;
    
    const productData = JSON.parse(productDataElement.textContent || '{}');
    
    // Cache DOM elements
    const priceElement = document.querySelector('.product-price');
    const originalPriceElement = document.querySelector('.product-original-price');
    
    // Get all attribute selection elements
    const sizeInput = document.querySelector('input[name="attributes[size_id]"]');
    const qualityInput = document.querySelector('input[name="attributes[quality_id]"]');
    const typeInput = document.querySelector('input[name="attributes[type_id]"]');
    const colorRadios = document.querySelectorAll('.color-radio');
    
    // Function to update price based on selected attributes
    function updatePrice() {
      // Log selected values for debugging
      console.log('Size:', sizeInput ? sizeInput.value : 'No size select');
      console.log('Quality:', qualityInput ? qualityInput.value : 'No quality select');
      console.log('Type:', typeInput ? typeInput.value : 'No type select');
      
      // Get selected attribute values
      const selectedSize = sizeInput ? parseInt(sizeInput.value) : null;
      const selectedQuality = qualityInput ? parseInt(qualityInput.value) : null;
      const selectedType = typeInput ? parseInt(typeInput.value) : null;
      const selectedColor = document.querySelector('.color-radio:checked');
      const selectedColorId = selectedColor ? parseInt(selectedColor.value) : null;
      
      // Log parsed values
      console.log('Parsed Size:', selectedSize);
      console.log('Parsed Quality:', selectedQuality);
      console.log('Parsed Type:', selectedType);
      console.log('Parsed Color:', selectedColorId);
      
      // Default to base product price
      let currentPrice = productData.basePrice;
      let currentDiscount = productData.baseDiscount;
      
      // Try to find matching price attribute
      if (productData.priceAttributes && productData.priceAttributes.length > 0) {
        // Find matching price attribute
        let matchingAttribute = null;
        
        // Check for different combination types
        if (selectedSize && selectedQuality) {
          // Try to find exact match with both size and quality
          matchingAttribute = productData.priceAttributes.find(attr => 
            attr.size === selectedSize && attr.quality === selectedQuality
          );
          console.log('Matching Attribute (Size+Quality):', matchingAttribute);
        }
        
        if (!matchingAttribute && selectedSize) {
          // Try to find match with just size
          matchingAttribute = productData.priceAttributes.find(attr => 
            attr.size === selectedSize && !attr.quality
          );
          console.log('Matching Attribute (Size):', matchingAttribute);
        }
        
        if (!matchingAttribute && selectedQuality) {
          // Try to find match with just quality
          matchingAttribute = productData.priceAttributes.find(attr => 
            attr.quality === selectedQuality && !attr.size
          );
          console.log('Matching Attribute (Quality):', matchingAttribute);
        }
        
        if (!matchingAttribute && selectedType) {
          // Try to find match with just type
          matchingAttribute = productData.priceAttributes.find(attr => 
            attr.type === selectedType
          );
          console.log('Matching Attribute (Type):', matchingAttribute);
        }
        
        if (!matchingAttribute && selectedColorId) {
          // Try to find match with just color
          matchingAttribute = productData.priceAttributes.find(attr => 
            attr.color === selectedColorId
          );
          console.log('Matching Attribute (Color):', matchingAttribute);
        }
        
        // If we found a matching attribute, use its price and discount
        if (matchingAttribute) {
          currentPrice = matchingAttribute.price;
          currentDiscount = matchingAttribute.discount;
          console.log('Final Price:', currentPrice);
          console.log('Final Discount:', currentDiscount);
        }
      }
      
      // Calculate discounted price
      const discountedPrice = currentDiscount > 0 
        ? currentPrice - (currentPrice * (currentDiscount / 100))
        : currentPrice;
      
      // Update display
      if (priceElement) {
        priceElement.textContent = `₣${formatPrice(discountedPrice)}`;
      }
      
      if (originalPriceElement) {
        if (currentDiscount > 0) {
          originalPriceElement.textContent = `₣${formatPrice(currentPrice)}`;
          originalPriceElement.style.display = 'inline';
        } else {
          originalPriceElement.style.display = 'none';
        }
      }
    }
    
    // Helper function to format price
    function formatPrice(price) {
      return price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }
    
    // Add event listeners to color radio buttons
    function addColorEventListeners(elements) {
      elements.forEach(element => {
        element.addEventListener('change', updatePrice);
      });
    }
    
    // Add event listeners to custom select inputs
    function addCustomSelectListeners(inputs) {
      inputs.forEach(input => {
        input.addEventListener('customSelectChange', (event) => {
          console.log('Custom Select Changed:', event.detail);
          updatePrice();
        });
      });
    }
    
    // Add event listeners
    const customSelectInputs = [
      sizeInput, 
      qualityInput, 
      typeInput
    ].filter(input => input !== null);
    
    if (customSelectInputs.length > 0) {
      addCustomSelectListeners(customSelectInputs);
    }
    
    if (colorRadios.length > 0) {
      addColorEventListeners(colorRadios);
      console.log('Color radio event listeners added');
    }
    
    // Initialize price on page load
    console.log('Initial product data:', productData);
    updatePrice();
});