// --- Mock Data (Replace with actual data source in Laravel) ---

// Product Data
const allProducts = [
    {
      id: 'prod_001',
      name: 'Sparkle All-Purpose Cleaner',
      description: 'Cuts grease and grime on multiple surfaces. Fresh lemon scent.',
      price: 4.99,
      imageUrl: 'https://picsum.photos/seed/prod_001/300/300',
      category: 'All Purpose Cleaners',
      subCategory: 'Spray Cleaners',
      tags: ['Trending']
    },
    {
      id: 'prod_002',
      name: 'Gleam Bathroom Cleaner',
      description: 'Removes soap scum and hard water stains. Leaves surfaces shining.',
      price: 5.49,
      imageUrl: 'https://picsum.photos/seed/prod_002/300/300',
      category: 'Bathroom Cleaners',
      subCategory: 'Shower & Tub',
    },
     {
      id: 'prod_003',
      name: 'Scrub Free Kitchen Degreaser',
      description: 'Powerful formula for tough kitchen messes on stovetops and counters.',
      price: 6.99,
      imageUrl: 'https://picsum.photos/seed/prod_003/300/300',
      category: 'Kitchen Cleaners',
      subCategory: 'Degreasers',
      tags: ['Kitchen Essential']
    },
    {
      id: 'prod_004',
      name: 'Ocean Breeze Laundry Detergent',
      description: 'High-efficiency detergent for bright whites and vibrant colors.',
      price: 12.99,
      imageUrl: 'https://picsum.photos/seed/prod_004/300/300',
      category: 'Laundry Detergents',
      subCategory: 'Liquid Detergents',
      tags: ['Trending']
    },
    {
      id: 'prod_005',
      name: 'PureGuard Disinfectant Spray',
      description: 'Kills 99.9% of germs and bacteria. Use on hard, non-porous surfaces.',
      price: 7.99,
      imageUrl: 'https://picsum.photos/seed/prod_005/300/300',
      category: 'Disinfectants',
      subCategory: 'Spray Disinfectants',
    },
    {
      id: 'prod_006',
      name: 'Shine Bright Floor Cleaner',
      description: 'Cleans and protects hardwood and laminate floors.',
      price: 9.99,
      imageUrl: 'https://picsum.photos/seed/prod_006/300/300',
      category: 'Floor Care',
      subCategory: 'Wood Cleaners',
       tags: ['Trending']
    },
      {
      id: 'prod_007',
      name: 'EcoClean All-Purpose Wipes',
      description: 'Plant-based cleaning wipes for quick cleanups.',
      price: 6.49,
      imageUrl: 'https://picsum.photos/seed/prod_007/300/300',
      category: 'All Purpose Cleaners',
      subCategory: 'Cleaning Wipes',
      tags: ['Eco-Friendly', 'Trending'] // Example tag
    },
    {
      id: 'prod_008',
      name: 'Toilet Sparkle Bowl Cleaner',
      description: 'Thick gel formula clings to remove stains and odors.',
      price: 4.49,
      imageUrl: 'https://picsum.photos/seed/prod_008/300/300',
      category: 'Bathroom Cleaners',
      subCategory: 'Toilet Cleaners',
    },
    {
      id: 'prod_009',
      name: 'Stainless Steel Shine',
      description: 'Cleans, polishes, and protects stainless steel appliances.',
      price: 8.99,
      imageUrl: 'https://picsum.photos/seed/prod_009/300/300',
      category: 'Kitchen Cleaners',
      subCategory: 'Appliance Cleaners',
       tags: ['Kitchen Essential']
    },
    {
      id: 'prod_010',
      name: 'Sensitive Skin Laundry Pods',
      description: 'Fragrance-free and dye-free pods for sensitive skin.',
      price: 14.99,
      imageUrl: 'https://picsum.photos/seed/prod_010/300/300',
      category: 'Laundry Detergents',
      subCategory: 'Laundry Pods',
    },
     {
      id: 'prod_011',
      name: 'GermAway Disinfecting Wipes',
      description: 'Convenient wipes for disinfecting surfaces on the go.',
      price: 5.99,
      imageUrl: 'https://picsum.photos/seed/prod_011/300/300',
      category: 'Disinfectants',
      subCategory: 'Disinfecting Wipes',
    },
     {
      id: 'prod_012',
      name: 'Hardwood Hero Floor Polish',
      description: 'Restores shine and protects wood floors.',
      price: 11.49,
      imageUrl: 'https://picsum.photos/seed/prod_012/300/300',
      category: 'Floor Care',
      subCategory: 'Floor Polish',
    },
    {
      id: 'prod_013',
      name: 'BioBlast Drain Cleaner',
      description: 'Enzyme-based drain cleaner, safe for pipes.',
      price: 8.49,
      imageUrl: 'https://picsum.photos/seed/prod_013/300/300',
      category: 'Kitchen Cleaners',
      subCategory: 'Drain Cleaners',
      tags: ['Eco-Friendly', 'New', 'Kitchen Essential'] // Example tags
    },
     {
      id: 'prod_014',
      name: 'Glass Gleam Window Cleaner',
      description: 'Streak-free shine for windows, mirrors, and glass surfaces.',
      price: 5.29,
      imageUrl: 'https://picsum.photos/seed/prod_014/300/300',
      category: 'All Purpose Cleaners', // Or a dedicated Glass category
      subCategory: 'Spray Cleaners',
      tags: ['Trending']
    },
     {
      id: 'prod_015',
      name: 'Fabric Fresh Odor Eliminator',
      description: 'Neutralizes odors on carpets, upholstery, and fabrics.',
      price: 7.49,
      imageUrl: 'https://picsum.photos/seed/prod_015/300/300',
      category: 'Specialty Cleaners', // Example new category
      subCategory: 'Odor Eliminators',
       tags: ['New']
    },
  ];
  
  // Category Data Structure
  // In Laravel, this structure would likely be built from your Category and SubCategory tables.
  const categoriesData = [
      {
          name: "All Purpose Cleaners",
          subCategories: ["Spray Cleaners", "Cleaning Wipes"]
      },
      {
          name: "Bathroom Cleaners",
          subCategories: ["Shower & Tub", "Toilet Cleaners"]
      },
      {
          name: "Kitchen Cleaners",
          subCategories: ["Degreasers", "Appliance Cleaners", "Drain Cleaners"]
      },
      {
          name: "Laundry Detergents",
          subCategories: ["Liquid Detergents", "Laundry Pods"]
      },
      {
          name: "Disinfectants",
          subCategories: ["Spray Disinfectants", "Disinfecting Wipes"]
      },
      {
          name: "Floor Care",
          subCategories: ["Wood Cleaners", "Floor Polish"]
      },
      {
          name: "Specialty Cleaners", // Added category
          subCategories: ["Odor Eliminators"]
      },
      {
          name: "Eco-Friendly", // Example of a 'special' category (can filter by tag)
          subCategories: []
      },
       {
          name: "New", // Example of a 'special' category (can filter by tag)
          subCategories: []
      }
  ];
  
  
  // --- State Management (using LocalStorage) ---
  const CART_STORAGE_KEY = 'cleanSweepCart';
  const WISHLIST_STORAGE_KEY = 'cleanSweepWishlist';
  
  function getCart() {
      return JSON.parse(localStorage.getItem(CART_STORAGE_KEY) || '[]');
  }
  
  function saveCart(cart) {
      localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
      updateCartCount();
  }
  
  function getWishlist() {
      return JSON.parse(localStorage.getItem(WISHLIST_STORAGE_KEY) || '[]');
  }
  
  function saveWishlist(wishlist) {
      localStorage.setItem(WISHLIST_STORAGE_KEY, JSON.stringify(wishlist));
      updateWishlistCount();
  }
  
  // --- UI Update Functions ---
  function updateCartCount() {
      const cart = getCart();
      const count = cart.reduce((sum, item) => sum + item.quantity, 0);
      const cartCountElements = document.querySelectorAll('.cart-count'); // Select all elements with class
      cartCountElements.forEach(el => {
          if (el) el.textContent = count;
      });
  }
  
  function updateWishlistCount() {
      const wishlist = getWishlist();
      const count = wishlist.length;
      const wishlistCountElements = document.querySelectorAll('#wishlist-count'); // Use ID selector, might be multiple
      wishlistCountElements.forEach(el => {
          if (el) el.textContent = count;
      });
  }
  
  
  function showToast(message, duration = 3000) {
      const toastElement = document.getElementById('toast-notification');
      const messageElement = document.getElementById('toast-message');
      if (!toastElement || !messageElement) return;
  
      messageElement.textContent = message;
      toastElement.classList.add('show');
  
      // Clear existing timers if any
      if (toastElement.timerId) {
          clearTimeout(toastElement.timerId);
      }
  
      toastElement.timerId = setTimeout(() => {
          toastElement.classList.remove('show');
          toastElement.timerId = null; // Clear the timer ID
      }, duration);
  }
  
  // --- Category Sidebar Rendering (for Hero Section) ---
  function renderCategorySidebar() {
      const sidebarList = document.getElementById('category-sidebar-list');
      if (!sidebarList) return;
  
      sidebarList.innerHTML = ''; // Clear loading message
  
      categoriesData.forEach(category => {
          // Skip special tag-based categories if needed, or style them differently
          // if (category.name === "New" || category.name === "Eco-Friendly") return;
  
          const listItem = document.createElement('li');
          const link = document.createElement('a');
          link.href = `index.html?category=${encodeURIComponent(category.name)}#products`;
          link.textContent = category.name;
  
          listItem.appendChild(link);
  
          if (category.subCategories && category.subCategories.length > 0) {
              listItem.classList.add('has-sub'); // Add class for styling/JS targeting
  
              const dropdown = document.createElement('ul');
              dropdown.className = 'subcategory-dropdown';
  
              category.subCategories.forEach(subCategory => {
                  const subListItem = document.createElement('li');
                  const subLink = document.createElement('a');
                  subLink.href = `index.html?category=${encodeURIComponent(category.name)}&subCategory=${encodeURIComponent(subCategory)}#products`;
                  subLink.textContent = subCategory;
                  subListItem.appendChild(subLink);
                  dropdown.appendChild(subListItem);
              });
              listItem.appendChild(dropdown);
          }
  
          sidebarList.appendChild(listItem);
      });
  }
  
  
  
  // --- Product Listing & Filtering ---
  
  /**
   * Renders product cards into a specified container.
   * @param {Array} productsToRender Array of product objects to display.
   * @param {string} containerId The ID of the HTML element to render products into.
   * @param {boolean} [isFeatured=false] If true, might apply different styling or limits (optional).
   */
  function renderProducts(productsToRender, containerId, isFeatured = false) {
      const productGrid = document.getElementById(containerId);
      const noProductsMessage = document.getElementById('no-products-message'); // Assumes one global message for main grid
  
      if (!productGrid) {
          console.error(`Product container with ID "${containerId}" not found.`);
          return; // Exit if the container doesn't exist
      }
  
      productGrid.innerHTML = ''; // Clear existing products or placeholder
      const wishlist = getWishlist();
      const cart = getCart(); // Get cart to check if item is already added
  
      // Limit the number of products for featured sections if needed
      const displayLimit = isFeatured ? 6 : productsToRender.length; // Example: show max 6 featured
      const limitedProducts = productsToRender.slice(0, displayLimit);
  
      if (limitedProducts.length === 0 && !isFeatured) {
          // Show 'no products' message only for the main product grid, not featured sections
          if (noProductsMessage) noProductsMessage.style.display = 'block';
      } else if (limitedProducts.length === 0 && isFeatured) {
          // Optional: Show a placeholder in featured sections if empty
           productGrid.innerHTML = `<div class="product-card-placeholder"><p>No products to feature.</p></div>`;
      } else {
          if (noProductsMessage && !isFeatured) noProductsMessage.style.display = 'none';
  
          limitedProducts.forEach(product => {
              const isWishlisted = wishlist.some(item => item.id === product.id);
              const isInCart = cart.some(item => item.id === product.id);
              const card = document.createElement('div');
              card.className = 'product-card';
              card.dataset.productId = product.id;
  
              // Note: Product description is hidden via CSS by default in card view
              card.innerHTML = `
                  <div class="product-image-container">
                      <img src="${product.imageUrl}" alt="${product.name}" class="product-image">
                      <button class="wishlist-button ${isWishlisted ? 'active' : ''}" title="${isWishlisted ? 'Remove from Wishlist' : 'Add to Wishlist'}" aria-label="Toggle Wishlist">
                          <i class="fas fa-heart"></i>
                      </button>
                  </div>
                  <div class="product-info">
                      <span class="product-category">${product.category || 'General'}</span>
                      <h3 class="product-name" title="${product.name}">${product.name}</h3>
                      <p class="product-price">$${product.price.toFixed(2)}</p>
                  </div>
                   <div class="product-actions">
                      <button class="btn btn-primary add-to-cart-button" ${isInCart ? 'disabled' : ''}>
                          <i class="fas fa-cart-plus"></i> ${isInCart ? 'In Cart' : 'Add to Cart'}
                      </button>
                  </div>
              `;
              productGrid.appendChild(card);
          });
      }
  }
  
  // --- Specific Render Functions for Homepage Sections ---
  
  function renderFeaturedProducts(tag, containerId, limit = 5) {
      const featured = allProducts.filter(p => p.tags?.includes(tag)).slice(0, limit);
      renderProducts(featured, containerId, true); // true indicates featured rendering
  }
  
  
  function filterAndRenderAllProducts() {
      const searchInput = document.getElementById('search-input');
      const categorySelect = document.getElementById('category-select');
  
      const searchTerm = searchInput?.value.toLowerCase() || '';
      const selectedCategoryFromDropdown = categorySelect?.value || 'All';
  
      // Get category/subcategory from URL parameters
      const urlParams = new URLSearchParams(window.location.search);
      const urlCategory = urlParams.get('category');
      const urlSubCategory = urlParams.get('subCategory');
  
      // Determine the effective category and subcategory
      let effectiveCategory = 'All';
      let effectiveSubCategory = null;
  
      if (urlCategory) {
          effectiveCategory = urlCategory;
          if (categorySelect) categorySelect.value = urlCategory; // Sync dropdown
           if (urlSubCategory) {
               effectiveSubCategory = urlSubCategory;
           }
      } else if (categorySelect && selectedCategoryFromDropdown !== 'All') {
          effectiveCategory = selectedCategoryFromDropdown;
      }
  
      // Handle special tag-based categories selected via URL or dropdown
      const isEcoFriendlyFilter = effectiveCategory === 'Eco-Friendly';
      const isNewFilter = effectiveCategory === 'New';
      const isTrendingFilter = effectiveCategory === 'Trending'; // Added possibility
      const isKitchenEssentialFilter = effectiveCategory === 'Kitchen Essential'; // Added possibility
  
  
      console.log("Filtering All Products by:", { effectiveCategory, effectiveSubCategory, searchTerm }); // Debugging
  
      const filtered = allProducts.filter(product => {
          const nameMatch = product.name.toLowerCase().includes(searchTerm);
          const descriptionMatch = product.description.toLowerCase().includes(searchTerm);
          const categoryNameMatch = product.category.toLowerCase().includes(searchTerm); // Also search category name
          const searchMatch = nameMatch || descriptionMatch || categoryNameMatch;
  
          // Category/Tag Matching Logic
          let categoryMatch = false;
          if (effectiveCategory === 'All') {
              categoryMatch = true;
          } else if (isEcoFriendlyFilter) {
              categoryMatch = product.tags?.includes('Eco-Friendly');
          } else if (isNewFilter) {
              categoryMatch = product.tags?.includes('New');
          } else if (isTrendingFilter) {
               categoryMatch = product.tags?.includes('Trending');
          } else if (isKitchenEssentialFilter) {
               categoryMatch = product.tags?.includes('Kitchen Essential');
          } else {
               // Standard category/subcategory match
               const mainCategoryMatch = product.category === effectiveCategory;
               const subCategoryMatch = !effectiveSubCategory || product.subCategory === effectiveSubCategory;
               categoryMatch = mainCategoryMatch && subCategoryMatch;
          }
  
          return searchMatch && categoryMatch;
      });
  
      renderProducts(filtered, 'product-grid', false); // Render into the main grid, not featured
  
       // Optional: Clear URL params after filtering if desired
       // if (urlParams.has('category') || urlParams.has('subCategory')) {
       //     history.pushState({}, '', window.location.pathname + '#products');
       // }
  }
  
  
  function populateCategoryFilterDropdown() {
      const categorySelect = document.getElementById('category-select');
      if (!categorySelect) return;
  
      // Clear existing options except "All Categories"
      categorySelect.innerHTML = '<option value="All">All Categories</option>';
  
      categoriesData.forEach(category => {
          const option = document.createElement('option');
          option.value = category.name;
          option.textContent = category.name;
          categorySelect.appendChild(option);
      });
  }
  
  // --- Cart Functionality ---
  function addToCart(productId, buttonElement) {
      const product = allProducts.find(p => p.id === productId);
      if (!product) return;
  
      const cart = getCart();
      const existingItemIndex = cart.findIndex(item => item.id === productId);
  
      if (existingItemIndex > -1) {
          cart[existingItemIndex].quantity += 1;
      } else {
          cart.push({ id: productId, quantity: 1 });
      }
  
      saveCart(cart);
      showToast(`${product.name} added to cart.`);
  
      // Update button state
      if (buttonElement) {
          buttonElement.innerHTML = '<i class="fas fa-check"></i> In Cart';
          buttonElement.disabled = true;
      }
  
      // Re-render cart if on cart page
      if (document.getElementById('cart-items')) {
          renderCart();
      }
       updateCartCount(); // Explicitly update count everywhere
  }
  
  
  function removeFromCart(productId) {
      let cart = getCart();
      const product = allProducts.find(p => p.id === productId); // For toast message
      cart = cart.filter(item => item.id !== productId);
      saveCart(cart);
       if (product) showToast(`${product.name} removed from cart.`);
  
       // Update button state on product grids if product is removed
      const productCards = document.querySelectorAll(`.product-card[data-product-id="${productId}"]`);
      productCards.forEach(card => {
          const button = card.querySelector('.add-to-cart-button');
          if (button) {
              button.innerHTML = '<i class="fas fa-cart-plus"></i> Add to Cart';
              button.disabled = false;
          }
      });
  
  
      // Update UI immediately if on cart page
      if (document.getElementById('cart-items')) {
          renderCart();
      }
       updateCartCount(); // Explicitly update count everywhere
  }
  
  
  function updateCartQuantity(productId, quantity) {
      const cart = getCart();
      const itemIndex = cart.findIndex(item => item.id === productId);
  
      if (itemIndex > -1) {
          quantity = Math.max(0, quantity); // Ensure quantity is not negative
          if (quantity === 0) {
              // If quantity is zero, remove the item
              removeFromCart(productId); // Use removeFromCart to handle toast and button state
          } else {
              cart[itemIndex].quantity = quantity;
              saveCart(cart);
               // Update UI immediately if on cart page
               if (document.getElementById('cart-items')) {
                  renderCart();
              }
               updateCartCount(); // Explicitly update count everywhere
          }
      }
  }
  
  function clearCart() {
      const cart = getCart();
       // Update button states for all items that were in the cart
      cart.forEach(item => {
           const productCards = document.querySelectorAll(`.product-card[data-product-id="${item.id}"]`);
           productCards.forEach(card => {
               const button = card.querySelector('.add-to-cart-button');
               if (button) {
                   button.innerHTML = '<i class="fas fa-cart-plus"></i> Add to Cart';
                   button.disabled = false;
               }
           });
       });
  
      saveCart([]);
      showToast(`Cart cleared.`);
      // Update UI immediately if on cart page
      if (document.getElementById('cart-items')) {
          renderCart();
      }
       updateCartCount(); // Explicitly update count everywhere
  }
  
  
  function renderCart() {
      const cartItemsContainer = document.getElementById('cart-items');
      const cartSummaryContainer = document.getElementById('cart-summary');
      const emptyCartMessage = document.getElementById('empty-cart-message');
      const cartSubtotalElement = document.getElementById('cart-subtotal');
      const cartTotalElement = document.getElementById('cart-total');
  
      if (!cartItemsContainer || !cartSummaryContainer || !emptyCartMessage || !cartSubtotalElement || !cartTotalElement) return;
  
      const cart = getCart();
      cartItemsContainer.innerHTML = ''; // Clear current items
  
      if (cart.length === 0) {
          emptyCartMessage.style.display = 'block';
          cartSummaryContainer.style.display = 'none';
      } else {
          emptyCartMessage.style.display = 'none';
          cartSummaryContainer.style.display = 'block';
          let subtotal = 0;
  
          cart.forEach(item => {
              const product = allProducts.find(p => p.id === item.id);
              if (!product) {
                   console.warn(`Product with ID ${item.id} not found in allProducts.`);
                   // Optionally remove item from cart if product definition is missing
                   // removeFromCart(item.id);
                   return; // Skip rendering this item
               }
  
  
              subtotal += product.price * item.quantity;
  
              const itemElement = document.createElement('div');
              itemElement.className = 'cart-item';
              itemElement.dataset.productId = product.id;
              itemElement.innerHTML = `
                  <div class="cart-item-image">
                      <img src="${product.imageUrl}" alt="${product.name}">
                  </div>
                  <div class="cart-item-info">
                      <h4>${product.name}</h4>
                      <span class="price">$${product.price.toFixed(2)}</span>
                  </div>
                  <div class="cart-item-quantity">
                      <button class="quantity-decrease" title="Decrease quantity" aria-label="Decrease quantity of ${product.name}">-</button>
                      <input type="number" value="${item.quantity}" min="1" class="quantity-input" aria-label="Quantity for ${product.name}">
                      <button class="quantity-increase" title="Increase quantity" aria-label="Increase quantity of ${product.name}">+</button>
                  </div>
                   <div class="cart-item-subtotal">
                       <span>$${(product.price * item.quantity).toFixed(2)}</span>
                  </div>
                  <div class="cart-item-remove">
                      <button class="remove-from-cart-button" title="Remove item" aria-label="Remove ${product.name} from cart">
                          <i class="fas fa-trash-alt"></i>
                      </button>
                  </div>
              `;
              cartItemsContainer.appendChild(itemElement);
          });
  
          // Update summary
          cartSubtotalElement.textContent = `$${subtotal.toFixed(2)}`;
          // Add tax/shipping calculation here if needed
          cartTotalElement.textContent = `$${subtotal.toFixed(2)}`; // Assuming total is same as subtotal for now
      }
       updateCartCount(); // Ensure header count is also up-to-date
  }
  
  
  // --- Wishlist Functionality ---
  function toggleWishlist(productId, buttonElement) {
      const wishlist = getWishlist();
      const product = allProducts.find(p => p.id === productId);
      if (!product) return;
  
      const itemIndex = wishlist.findIndex(item => item.id === productId);
      let wasAdded = false;
  
      if (itemIndex > -1) {
          // Remove from wishlist
          wishlist.splice(itemIndex, 1);
          showToast(`${product.name} removed from wishlist.`);
      } else {
          // Add to wishlist
          wishlist.push({ id: product.id, name: product.name, price: product.price, imageUrl: product.imageUrl, category: product.category });
           showToast(`${product.name} added to wishlist.`);
           wasAdded = true;
      }
  
      saveWishlist(wishlist);
  
      // Update button state on all product grids/cards
      const productCards = document.querySelectorAll(`.product-card[data-product-id="${productId}"]`);
       productCards.forEach(card => {
          const wlButton = card.querySelector('.wishlist-button');
          if (wlButton) {
              wlButton.classList.toggle('active', wasAdded);
              wlButton.title = wasAdded ? 'Remove from Wishlist' : 'Add to Wishlist';
          }
      });
  
  
       // Re-render if on wishlist page
      if (document.getElementById('wishlist-grid')) {
          renderWishlist();
      }
       updateWishlistCount(); // Explicitly update count everywhere
  }
  
  
  function renderWishlist() {
      const wishlistGrid = document.getElementById('wishlist-grid');
      const emptyMessage = document.getElementById('empty-wishlist-message');
      if (!wishlistGrid || !emptyMessage) return;
  
      const wishlist = getWishlist();
       const cart = getCart(); // Get cart status
      wishlistGrid.innerHTML = ''; // Clear grid
  
      if (wishlist.length === 0) {
          emptyMessage.style.display = 'block';
      } else {
           emptyMessage.style.display = 'none';
           wishlist.forEach(item => {
               const fullProduct = allProducts.find(p => p.id === item.id); // Get full details if needed
               const isWishlisted = true; // It's on the wishlist page
               const isInCart = cart.some(cartItem => cartItem.id === item.id);
  
               const card = document.createElement('div');
              card.className = 'product-card'; // Re-use product card styling
              card.dataset.productId = item.id;
  
               card.innerHTML = `
                   <div class="product-image-container">
                      <img src="${item.imageUrl}" alt="${item.name}" class="product-image">
                       <button class="wishlist-button active" title="Remove from Wishlist" aria-label="Remove ${item.name} from Wishlist">
                          <i class="fas fa-heart"></i>
                      </button>
                  </div>
                  <div class="product-info">
                       <span class="product-category">${item.category || 'General'}</span>
                      <h3 class="product-name" title="${item.name}">${item.name}</h3>
                       <p class="product-price">$${item.price.toFixed(2)}</p>
                   </div>
                   <div class="product-actions">
                       <button class="btn btn-primary add-to-cart-button" ${isInCart ? 'disabled' : ''} data-product-id="${item.id}">
                          <i class="fas ${isInCart ? 'fa-check' : 'fa-cart-plus'}"></i> ${isInCart ? 'In Cart' : 'Add to Cart'}
                       </button>
                       <button class="btn btn-danger btn-sm remove-wishlist-button" data-product-id="${item.id}" style="margin-top: 0.5rem;">
                          <i class="fas fa-times"></i> Remove
                       </button>
                   </div>
               `;
               wishlistGrid.appendChild(card);
           });
      }
       updateWishlistCount(); // Update header count
  }
  
  // Simplified remove function, toggleWishlist handles state update
  function removeFromWishlist(productId) {
       // Find the button element if needed (though toggleWishlist should handle it)
       toggleWishlist(productId, null); // Call toggleWishlist to handle removal and UI updates
  }
  
  
  // --- Checkout Functionality ---
  function renderCheckoutSummary() {
      const summaryItemsContainer = document.getElementById('summary-items');
      const summaryTotalElement = document.getElementById('summary-total-amount');
      if (!summaryItemsContainer || !summaryTotalElement) return;
  
      const cart = getCart();
      summaryItemsContainer.innerHTML = ''; // Clear previous items
      let total = 0;
  
      if (cart.length === 0) {
          summaryItemsContainer.innerHTML = '<p class="text-muted">Your cart is empty.</p>';
           summaryTotalElement.textContent = '$0.00';
           // Disable form/button if cart is empty
          const checkoutButton = document.querySelector('#checkout-form button[type="submit"]');
          if(checkoutButton) checkoutButton.disabled = true;
          return;
      }
  
       // Enable form/button if cart has items
       const checkoutButton = document.querySelector('#checkout-form button[type="submit"]');
       if(checkoutButton) checkoutButton.disabled = false;
  
  
      cart.forEach(item => {
          const product = allProducts.find(p => p.id === item.id);
          if (!product) return;
  
          total += product.price * item.quantity;
  
          const itemElement = document.createElement('div');
          itemElement.className = 'summary-item';
          itemElement.innerHTML = `
              <span class="item-name">${product.name}</span>
              <span class="item-qty">x${item.quantity}</span>
              <span class="item-price">$${(product.price * item.quantity).toFixed(2)}</span>
          `;
          summaryItemsContainer.appendChild(itemElement);
      });
  
      summaryTotalElement.textContent = `$${total.toFixed(2)}`;
  }
  
  function handleCheckoutSubmit(event) {
      event.preventDefault();
      // **IMPORTANT**: Simulation only. Replace with server-side processing.
      console.log("Checkout form submitted (simulation)");
  
      // Simulate successful order
      clearCart(); // Clear the cart
      showToast("Order placed successfully! (Simulation)");
  
      // Redirect (optional) - In real app, redirect after server confirmation
      alert("Order Placed Successfully! (Simulation)\n\nIntegrate payment and order creation here. Cart is cleared.");
      window.location.href = 'index.html'; // Redirect home
  }
  
  // --- Contact Form ---
  function handleContactSubmit(event) {
       event.preventDefault();
      // **IMPORTANT**: Simulation only. Replace with server-side processing.
      const form = event.target;
      const nameInput = document.getElementById('contact-name');
      const emailInput = document.getElementById('contact-email');
      const messageInput = document.getElementById('contact-message');
  
      if (nameInput && emailInput && messageInput) {
          console.log("Contact form submitted (simulation):", {
              name: nameInput.value,
              email: emailInput.value,
              subject: document.getElementById('contact-subject')?.value || '',
              message: messageInput.value
          });
  
          showToast("Message sent successfully! (Simulation)");
          form.reset(); // Reset the form
          alert("Message Sent! (Simulation)\n\nSend data to backend here.");
      }
  }
  
  // --- Order Page (Static Example) ---
  function renderOrders() {
       const orderList = document.getElementById('order-list');
       const noOrdersMessage = document.getElementById('no-orders-message');
       if (!orderList || !noOrdersMessage) return;
  
       // For static template, check if hardcoded items exist
       const hasOrders = orderList.querySelector('.order-item');
       noOrdersMessage.style.display = hasOrders ? 'none' : 'block';
  }
  
  
  // --- Footer Year & Static Page Dates ---
  function updateDynamicDates() {
      const currentYear = new Date().getFullYear();
      const yearSpan = document.getElementById('current-year');
      if (yearSpan) yearSpan.textContent = currentYear;
  
       const lastUpdatedSpans = document.querySelectorAll('#last-updated-date');
        if(lastUpdatedSpans.length > 0) {
             const today = new Date().toLocaleDateString('en-CA'); // YYYY-MM-DD
             lastUpdatedSpans.forEach(span => span.textContent = today);
       }
  }
  
  
  // --- Event Delegation Setup ---
  function setupGlobalEventListeners() {
      document.body.addEventListener('click', (event) => {
          const target = event.target;
  
          // Add to Cart Buttons (check across all product grids)
          if (target.closest('.add-to-cart-button')) {
               event.preventDefault(); // Prevent default if it's a link styled as button
              const button = target.closest('.add-to-cart-button');
               const card = target.closest('.product-card');
              const productId = card?.dataset.productId || button?.dataset.productId; // Get ID from card or button itself
              if (productId && !button.disabled) {
                  addToCart(productId, button);
              }
          }
          // Wishlist Buttons (check across all product grids and wishlist page)
          else if (target.closest('.wishlist-button')) {
               event.preventDefault();
              const button = target.closest('.wishlist-button');
               const card = target.closest('.product-card');
              const productId = card?.dataset.productId;
              if (productId) {
                  toggleWishlist(productId, button);
              }
          }
          // Explicit Remove from Wishlist Button (on wishlist page)
          else if (target.closest('.remove-wishlist-button')) {
              event.preventDefault();
               const button = target.closest('.remove-wishlist-button');
              const productId = button?.dataset.productId;
              if (productId) {
                  removeFromWishlist(productId); // Uses toggleWishlist internally now
              }
          }
          // Cart Quantity/Remove Buttons (on cart page)
          else if (document.getElementById('cart-items') && target.closest('#cart-items')) {
              const button = target.closest('button');
              if (!button) return;
  
              const itemElement = target.closest('.cart-item');
              const productId = itemElement?.dataset.productId;
              if (!productId) return;
  
              if (button.classList.contains('quantity-increase')) {
                  const input = itemElement.querySelector('.quantity-input');
                  updateCartQuantity(productId, parseInt(input.value) + 1);
              } else if (button.classList.contains('quantity-decrease')) {
                  const input = itemElement.querySelector('.quantity-input');
                  updateCartQuantity(productId, parseInt(input.value) - 1);
              } else if (button.classList.contains('remove-from-cart-button')) {
                  removeFromCart(productId);
              }
          }
           // Category/Subcategory Links (sidebar or main list if used)
           else if (target.closest('#category-sidebar-list a, #category-list-container a')) {
               const link = target.closest('a');
               if (link && link.href.includes('#products')) {
                   event.preventDefault();
                   const href = link.getAttribute('href');
                   // Update URL without page reload
                   history.pushState({}, '', href);
                   // Parse category/subcategory from the clicked link's href
                   const urlParams = new URLSearchParams(new URL(href).search);
                   const category = urlParams.get('category');
                   const subCategory = urlParams.get('subCategory');
  
                   // Update the dropdown filter if it exists
                   const categorySelect = document.getElementById('category-select');
                   if(categorySelect && category) {
                      categorySelect.value = category;
                   } else if (categorySelect) {
                       categorySelect.value = 'All'; // Reset if no category in link
                   }
  
                   // Re-filter the main product grid based on URL parameters
                   filterAndRenderAllProducts();
  
                   // Scroll to products section
                   const productsSection = document.getElementById('products');
                   if (productsSection) {
                      setTimeout(() => productsSection.scrollIntoView({ behavior: 'smooth' }), 100);
                  }
              }
          }
      });
  
       // Handle direct input change for cart quantity
      document.body.addEventListener('change', (event) => {
           if (event.target.classList.contains('quantity-input') && event.target.closest('#cart-items')) {
              const itemElement = event.target.closest('.cart-item');
               const productId = itemElement?.dataset.productId;
               if (productId) {
                   let newQuantity = parseInt(event.target.value);
                   if (isNaN(newQuantity) || newQuantity <= 0) {
                        // If invalid or zero, remove the item
                        removeFromCart(productId);
                   } else {
                       updateCartQuantity(productId, newQuantity);
                   }
               }
           }
      });
  
      // Add hover listeners for category sidebar dropdowns (if using CSS hover isn't sufficient)
      // This part is generally handled by CSS :hover pseudo-class, but JS can be used for more complex interactions if needed.
      /*
      const categoryItems = document.querySelectorAll('#category-sidebar-list li.has-sub');
      categoryItems.forEach(item => {
          item.addEventListener('mouseenter', () => {
              const dropdown = item.querySelector('.subcategory-dropdown');
              if (dropdown) dropdown.style.display = 'block';
          });
          item.addEventListener('mouseleave', () => {
              const dropdown = item.querySelector('.subcategory-dropdown');
              if (dropdown) dropdown.style.display = 'none';
          });
      });
      */
  }
  
  
  // --- Initialization ---
  document.addEventListener('DOMContentLoaded', () => {
      updateCartCount();
      updateWishlistCount();
      updateDynamicDates();
      setupGlobalEventListeners(); // Setup delegated listeners
  
      // --- Page-Specific Initializations ---
  
      // Home Page (index.html)
      if (document.getElementById('product-grid')) { // Check for main product grid presence
          // Render Category Sidebar
          renderCategorySidebar();
  
          // Render Featured Sections
          renderFeaturedProducts('Trending', 'product-grid-featured-1', 6); // Example: 6 trending
          renderFeaturedProducts('Kitchen Essential', 'product-grid-featured-2', 5); // Example: 5 kitchen
  
          // Populate and render the main product grid
          populateCategoryFilterDropdown();
          filterAndRenderAllProducts(); // Initial filter for the main grid based on URL or default
  
          // Add specific listeners for filter controls
          const searchInput = document.getElementById('search-input');
          const categorySelect = document.getElementById('category-select');
          searchInput?.addEventListener('input', filterAndRenderAllProducts);
          categorySelect?.addEventListener('change', () => {
              // Clear URL category params when dropdown is used
               const currentUrl = new URL(window.location.href);
               currentUrl.searchParams.delete('category');
               currentUrl.searchParams.delete('subCategory');
               // Only add #products if it's not already there
               if (!currentUrl.hash) currentUrl.hash = '#products';
               history.pushState({}, '', currentUrl);
              filterAndRenderAllProducts();
          });
      }
  
      // Cart Page (cart.html)
      if (document.getElementById('cart-items')) {
          renderCart();
          const clearCartButton = document.getElementById('clear-cart-button');
          clearCartButton?.addEventListener('click', clearCart);
      }
  
      // Wishlist Page (wishlist.html)
      if (document.getElementById('wishlist-grid')) {
          renderWishlist();
      }
  
      // Checkout Page (checkout.html)
      if (document.getElementById('checkout-form')) {
          renderCheckoutSummary();
          const checkoutForm = document.getElementById('checkout-form');
          checkoutForm?.addEventListener('submit', handleCheckoutSubmit);
      }
  
      // Contact Page (contact.html)
       if (document.getElementById('contact-form')) {
          const contactForm = document.getElementById('contact-form');
          contactForm?.addEventListener('submit', handleContactSubmit);
      }
  
      // Orders Page (orders.html)
       if (document.getElementById('order-list')) {
           renderOrders();
       }
  
  });
  