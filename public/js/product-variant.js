document.addEventListener('DOMContentLoaded', function() {
    // Parse product data from a hidden field that we'll add to the Blade template
    const productDataElement = document.getElementById('product-data');
    if (!productDataElement) return;
    
    const productData = JSON.parse(productDataElement.textContent || '{}');
    
    // Cache DOM elements
    const priceElement = document.querySelector('.product-price');
    const originalPriceElement = document.querySelector('.product-original-price');
    
    // Get all attribute selection elements
    const sizeRadios = document.querySelectorAll('.size-radio');
    const qualityRadios = document.querySelectorAll('.quality-radio');
    const typeRadios = document.querySelectorAll('.type-radio');
    const colorRadios = document.querySelectorAll('.color-radio');
    
    // Function to update price based on selected attributes
    function updatePrice() {
      // Get selected attribute values
      const selectedSize = document.querySelector('.size-radio:checked');
      const selectedQuality = document.querySelector('.quality-radio:checked');
      const selectedType = document.querySelector('.type-radio:checked');
      const selectedColor = document.querySelector('.color-radio:checked');
      
      // Default to base product price
      let currentPrice = productData.basePrice;
      let currentDiscount = productData.baseDiscount;
      
      // Try to find matching price attribute
      if (productData.priceAttributes && productData.priceAttributes.length > 0) {
        const sizeId = selectedSize ? parseInt(selectedSize.value) : null;
        const qualityId = selectedQuality ? parseInt(selectedQuality.value) : null;
        const typeId = selectedType ? parseInt(selectedType.value) : null;
        const colorId = selectedColor ? parseInt(selectedColor.value) : null;
        
        // Find matching price attribute
        let matchingAttribute = null;
        
        // Check for different combination types
        if (sizeId && qualityId) {
          // Try to find exact match with both size and quality
          matchingAttribute = productData.priceAttributes.find(attr => 
            attr.size === sizeId && attr.quality === qualityId
          );
        }
        
        if (!matchingAttribute && sizeId) {
          // Try to find match with just size
          matchingAttribute = productData.priceAttributes.find(attr => 
            attr.size === sizeId && !attr.quality
          );
        }
        
        if (!matchingAttribute && qualityId) {
          // Try to find match with just quality
          matchingAttribute = productData.priceAttributes.find(attr => 
            attr.quality === qualityId && !attr.size
          );
        }
        
        if (!matchingAttribute && typeId) {
          // Try to find match with just type
          matchingAttribute = productData.priceAttributes.find(attr => 
            attr.type === typeId
          );
        }
        
        if (!matchingAttribute && colorId) {
          // Try to find match with just color
          matchingAttribute = productData.priceAttributes.find(attr => 
            attr.color === colorId
          );
        }
        
        // If we found a matching attribute, use its price and discount
        if (matchingAttribute) {
          currentPrice = matchingAttribute.price;
          currentDiscount = matchingAttribute.discount;
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
    
    // Add event listeners to all attribute selection elements
    function addEventListeners(elements) {
      elements.forEach(element => {
        element.addEventListener('change', updatePrice);
      });
    }
    
    // Add event listeners to all attribute types
    if (sizeRadios.length > 0) addEventListeners(sizeRadios);
    if (qualityRadios.length > 0) addEventListeners(qualityRadios);
    if (typeRadios.length > 0) addEventListeners(typeRadios);
    if (colorRadios.length > 0) addEventListeners(colorRadios);
    
    // Initialize price on page load
    updatePrice();
  });