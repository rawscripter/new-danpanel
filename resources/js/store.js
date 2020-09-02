let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');
let store = {

    state: {
        cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,
    },

    mutations: {
        removeFromCart(state, item) {
            let index = state.cart.indexOf(item);

            if (index > -1) {
                let product = state.cart[index];
                state.cartCount -= product.quantity;

                state.cart.splice(index, 1);
            }
        },

        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        },

        addToCart(state, item) {
            let found = state.cart.find(product => product.id == item.id);

            // if (found) {
            //     found.quantity++;
            //     found.totalPrice = found.quantity * found.offer_price;
            //     found.taxPrice = found.totalPrice * 0.2;
            // } else {
            state.cart.push(item);
            Vue.set(item, 'quantity', 1);
            Vue.set(item, 'totalPrice', item.offer_price);
            Vue.set(item, 'taxPrice', item.offer_price * 0.2);
            // }
            state.cartCount++;
        },
        increaseOrderQuantity(state, item) {
            let found = state.cart.find(product => product.id == item.id);

            if (found) {
                found.quantity++;
                found.totalPrice = found.quantity * found.offer_price;
                found.taxPrice = found.totalPrice * 0.2;
                state.cartCount++;
            }
        },
        decreaseOrderQuantity(state, item) {
            let found = state.cart.find(product => product.id == item.id);

            if (found) {
                found.quantity--;
                found.totalPrice = found.quantity * found.offer_price;
                found.taxPrice = found.totalPrice * 0.2;
                state.cartCount--;
            }
        },
    }


};

export default store;
