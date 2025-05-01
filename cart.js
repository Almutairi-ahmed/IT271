// Cart items array
let cartItems = [
    { id: 1, name: "كتاب البدايات", price: 30, image: "images/The_Merry_Adventures_of_Robin_Hood__.webp" },
    { id: 2, name: "رحلة إلى الأعماق", price: 45, image: "images/s-books-library.net-09222155Gn5E9.webp" }
];

// Function to render cart items
function renderCart() {
    const cartContainer = document.querySelector("#cart-items");
    const totalPriceElement = document.querySelector("#total-price");
    cartContainer.innerHTML = ""; // Clear existing items

    let totalPrice = 0;

    cartItems.forEach((item) => {
        totalPrice += item.price;

        const cartItem = document.createElement("div");
        cartItem.className = "flex justify-between items-center border-b border-gray-300 pb-4 mb-4";

        cartItem.innerHTML = `
            <div class="flex items-center">
                <img src="${item.image}" alt="${item.name}" class="w-20 h-20 object-contain rounded-lg mr-4">
                <div>
                    <h3 class="text-xl font-semibold text-[#1C4036]">${item.name}</h3>
                    <p class="text-gray-600">السعر: ${item.price} ريال</p>
                </div>
            </div>
            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition" onclick="removeFromCart(${item.id})">
                إزالة
            </button>
        `;

        cartContainer.appendChild(cartItem);
    });

    totalPriceElement.textContent = `الإجمالي: ${totalPrice} ريال`;
}

// Function to remove an item from the cart
function removeFromCart(itemId) {
    cartItems = cartItems.filter((item) => item.id !== itemId);
    renderCart();
}

// Function to add items to the cart
function addToCart(id, name, price, image) {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const item = { id, name, price, image };

    // Check if the item already exists in the cart
    const existingItem = cart.find((cartItem) => cartItem.id === id);
    if (!existingItem) {
        cart.push(item);
        localStorage.setItem("cart", JSON.stringify(cart));
        alert(name + " تمت إضافته إلى السلة!");
    } else {
        alert(name + " موجود بالفعل في السلة!");
    }
}

// Initial render
document.addEventListener("DOMContentLoaded", renderCart);