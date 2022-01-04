let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');
let oldFilterMaxRange = window.localStorage.getItem('filterMaxRange');

let store = {

    state: {
        cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,
        isLoaded: false,
        products: {
            shop: [],
            package: [],
            request: [],
        },
        blogs: {
            isStored: false,
            store: []
        },
        news: {
            isStored: false,
            store: []
        },
        filterMaxRange: {
            isLoaded: oldFilterMaxRange ? true : false,
            max: oldFilterMaxRange ? parseInt(oldFilterMaxRange) : 0,
        }
    },

    mutations: {
        saveFilterMaxRange(state, max) {
            state.filterMaxRange.max = max;
            state.filterMaxRange.isLoaded = true;
            window.localStorage.setItem('filterMaxRange', JSON.stringify(state.filterMaxRange.max));

        },
        saveBlogs(state, blogs) {
            state.blogs.isStored = true;
            state.blogs.store = blogs;
        },
        saveNews(state, news) {
            state.news.isStored = true;
            state.news.store = news;
        },
        saveShopProducts(state, products) {
            state.products.shop = products;
            state.isLoaded = true;
        },
        savePackageProducts(state, products) {
            state.products.package = products;
        },
        saveRequestProducts(state, products) {
            state.products.request = products;
        },
        removeFromCart(state, item) {
            let index = state.cart.indexOf(item);

            if (index > -1) {
                let product = state.cart[index];
                if (state.cartCount > 0)
                    state.cartCount -= product.quantity;

                state.cart.splice(index, 1);
            }
        },

        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        },

        clearCart(state) {
            state.cart = [];
            state.cartCount = 0;
            window.localStorage.removeItem('cart');
            window.localStorage.setItem('cartCount', 0);
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
            let found = state.cart.find(product => product.uuid == item.uuid);

            if (found) {
                found.quantity++;
                found.totalPrice = found.quantity * found.offer_price;
                found.taxPrice = found.totalPrice * 0.2;
                state.cartCount++;
            }
        },
        decreaseOrderQuantity(state, item) {
            let found = state.cart.find(product => product.uuid == item.uuid);

            if (found) {
                found.quantity--;
                found.totalPrice = found.quantity * found.offer_price;
                found.taxPrice = found.totalPrice * 0.2;
                state.cartCount--;
            }
        },
    },
    getters: {
        getFilterMaxRange: state => {
            return state.filterMaxRange.max;
        },
        getStoreBlogs: state => {
            return state.blogs.store;
        },
        getStoreNews: state => {
            return state.news.store;
        },
        isStoreLoaded: state => {
            return state.isLoaded;
        },
        getShopProducts: state => {
            return state.products.shop;
        },
        getPackageProducts: state => {
            return state.products.package;
        },
        getRequestProducts: state => {
            return state.products.request;
        }
    }

};

export default store;
