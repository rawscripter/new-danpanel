import Vue from 'vue';
import VueRouter from 'vue-router';
import AppLogin from "../components/Admin/Auth/AppLogin";
import AppBody from "../components/Admin/BodyComponents/AppBody";
import AppLogOut from "../components/Admin/Auth/AppLogOut";
import CategoryIndex from "../components/Admin/BodyComponents/BodyParts/Category/CategoryIndex";
import SubCategoryIndex from "../components/Admin/BodyComponents/BodyParts/SubCategory/SubCategoryIndex";
import ProductsIndex from "../components/Admin/BodyComponents/BodyParts/Product/ProductsIndex";
import BlogsIndex from '../components/Admin/BodyComponents/BodyParts/Blog/BlogsIndex.vue';
import ProductCreate from "../components/Admin/BodyComponents/BodyParts/Product/ProductCreate";
import SiteIndex from "../components/Site/Pages/SiteIndex";
import ProductDetailsPage from "../components/Site/Pages/ProductDetailsPage";
import CategoryProducts from "../components/Site/Pages/CategoryProducts";
import ProductEdit from "../components/Admin/BodyComponents/BodyParts/Product/ProductEdit";
import SearchPage from "../components/Site/Pages/SearchPage";
import FavouriteProudctsPage from "../components/Site/Pages/FavouriteProudctsPage";
import CheckoutStatusPage from "../components/Site/Pages/CheckoutStatusPage";
import CustomerProfile from "../components/Site/Pages/Customer/CustomerProfile";
import CustomerOrders from "../components/Site/Pages/Customer/CustomerOrders";
import OrdersIndex from "../components/Admin/BodyComponents/BodyParts/Order/OrdersIndex";
import ArchiveProductsIndex from "../components/Admin/BodyComponents/BodyParts/Product/ArchiveProductsIndex";
import CustomerIndex from "../components/Admin/BodyComponents/BodyParts/Customer/CustomerIndex";
import OrderDetails from "../components/Admin/BodyComponents/BodyParts/Order/OrderDetails";
import CustomerDashboard from "../components/Site/Pages/Customer/CustomerDashboard";
import UserLogin from "../components/Site/Pages/Auth/UserLogin";
import UserRegister from "../components/Site/Pages/Auth/UserRegister";
import UserResetPassword from "../components/Site/Pages/Auth/UserResetPassword";
import UserChangePassword from "../components/Site/Pages/Auth/UserChangePassword";
import FilterPage from "../components/Site/Pages/FilterPage";
import RequestsIndex from "../components/Admin/BodyComponents/BodyParts/Request/RequestsIndex";
import PrroductGraph from "../components/Site/Pages/Customer/PrroductGraph";
import FinalCheckoutPage from "../components/Site/Pages/FinalCheckoutPage";
import CustomerReminderProductPage from "../components/Site/Pages/CustomerReminderProductPage";
import Cart from "../components/Site/Pages/Cart";
import AboutsUs from '../components/Site/Pages/AboutsUs.vue';
import Blogs from "../components/Site/Pages/Blogs";
import News from "../components/Site/Pages/News";
import SingleBlogDetailsPage from "../components/Site/Pages/SingleBlogDetailsPage";
import SingleNewsDetailsPage from "../components/Site/Pages/SingleNewsDetailsPage";
import CustomerOrderDetails from "../components/Site/Pages/Customer/CustomerOrderDetails";
import handelsbetingelser from "../components/Site/pages/handelsbetingelser";
import PrivatlivspolitikCookies from "../components/Site/pages/PrivatlivspolitikCookies";
import konkurrenceregler from "../components/Site/Pages/konkurrenceregler";
import tak from "../components/Site/Pages/tak";
import cookies from "../components/Site/cookies";
import BlogEdit from '../components/Admin/BodyComponents/BodyParts/Blog/BlogEdit.vue';
import BlogCreate from '../components/Admin/BodyComponents/BodyParts/Blog/BlogCreate.vue';
import PagesIndex from '../components/Admin/BodyComponents/BodyParts/Pages/PagesIndex.vue';
import PageCreate from '../components/Admin/BodyComponents/BodyParts/Pages/PageCreate.vue';
import PageEdit from '../components/Admin/BodyComponents/BodyParts/Pages/PageEdit.vue';
import Pages from '../components/Site/Pages/Pages.vue';
//importing components
Vue.use(VueRouter);
import axios from 'axios';



const routes = [
    // routes for admin dashboard
    {
        path: '/admin/login',
        component: AppLogin
    },
    {
        path: '/logout',
        component: AppLogOut
    },
    {
        path: '/admin',
        meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        component: AppBody
    },
    {
        path: '/admin/category', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },

        component: CategoryIndex
    },
    {
        path: '/admin/customers', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        component: CustomerIndex
    },
    {
        path: '/admin/sub-category', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        component: SubCategoryIndex
    },
    {
        path: '/admin/products', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'products',
        component: ProductsIndex
    },
    {
        path: '/admin/blogs', meta: {
            title: 'BLogs',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'blogs',
        component: BlogsIndex
    },
    {
        path: '/admin/blog/:blog/edit', meta: {
            title: 'Edit Blog',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'blog.edit',
        component: BlogEdit
    },
    {
        path: '/admin/blog/create', meta: {
            title: 'Edit Blog',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'blog.create',
        component: BlogCreate
    },

    {
        path: '/admin/pages', meta: {
            title: 'pages',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'pages',
        component: PagesIndex
    },
    {
        path: '/admin/page/:page/edit', meta: {
            title: 'Edit page',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'page.edit',
        component: PageEdit
    },
    {
        path: '/admin/page/create', meta: {
            title: 'Edit page',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'page.create',
        component: PageCreate
    },

    {
        path: '/admin/products/archive', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'admin.products',
        component: ArchiveProductsIndex
    },
    {
        path: '/admin/orders', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'orders',
        component: OrdersIndex
    }, {
        path: '/admin/requests', meta: {
            title: 'Offer Requests!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'requests',
        component: RequestsIndex
    },
    {
        path: '/admin/order/:order/details', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'admin-order-details',
        component: OrderDetails
    },
    {
        path: '/admin/product/create', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'product.create',
        component: ProductCreate
    },
    {
        path: '/admin/product/:product/edit',
        meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'product.edit',
        component: ProductEdit
    },

    {
        path: '/auth/:provider/callback',
        component: {
            template: '<div class="auth-component"></div>'
        }
    },


    // routes for site
    {
        path: '/',
        component: SiteIndex,
        meta: {
            title: 'DanPanel'
        }
    },  // routes for site
    {
        path: '/filter',
        component: FilterPage,
        name: 'filter',
        meta: {
            title: 'Filtrer produkter.'
        }
    },
    {
        path: '/om-os',
        component: AboutsUs,
        name: 'about-us',
        meta: {
            title: 'Om os.'
        }
    },
    {
        path: '/blogs',
        component: Blogs,
        name: 'blogs',
        meta: {
            title: 'Blogs'
        }
    },
    {
        path: '/page/:page',
        component: Pages,
        name: 'page',
        meta: {
            title: 'Page'
        }
    },
    {
        path: '/blog/:blog',
        component: SingleBlogDetailsPage,
        name: 'blog-details',
        meta: {
            title: 'Blog detaljer'
        }
    },
    {
        path: '/nyheder',
        component: News,
        name: 'news',
        meta: {
            title: 'Nyheder.'
        }
    }, {
        path: '/news/:news',
        component: SingleNewsDetailsPage,
        name: 'news-details',
        meta: {
            title: 'Nyheder detaljer'
        }
    },
    {
        path: '/login',
        component: UserLogin,
        name: 'login',
        meta: {
            title: 'Login!'
        }
    },
    {
        path: '/reset/password',
        component: UserResetPassword,
        name: 'reset-password',
        meta: {
            title: 'Nulstil adgangskode!'
        }
    },

    {
        path: '/password/reset/:token',
        component: UserChangePassword,
        name: 'reset-password-token',
        meta: {
            title: 'Skift adgangskode!'
        }
    },
    {
        path: '/register',
        component: UserRegister,
        name: 'register',
        meta: {
            title: 'Registrer nu!'
        }
    },
    {
        path: '/product/:slug',
        name: 'product-details',
        component: ProductDetailsPage,
        meta: {
            title: 'DanPanel!'
        }
    },
    {
        path: '/final/checkout',
        name: 'final-checkout',
        component: FinalCheckoutPage,
        meta: {
            title: 'Endelig checkout nu'
        }
    },
    {
        path: '/order/payment',
        name: 'order-payment-status',
        component: CheckoutStatusPage,
        meta: {
            title: 'Ordre detaljer',
            requireAuth: true,
            requireAdmin: false,
        }
    }, {
        path: '/customer/order/:order/details',
        name: 'customer-order-details',
        component: CustomerOrderDetails,
        meta: {
            title: 'Ordre detaljer',
            requireAuth: true,
            requireAdmin: false,
        }
    },
    {
        path: '/favourites',
        name: 'favourites',
        component: FavouriteProudctsPage,
        meta: {
            title: 'Favoritprodukter'
        }
    }, {
        path: '/cart',
        name: 'cart',
        component: Cart,
        meta: {
            title: 'Cart Page'
        }
    }, {
        path: '/reminder-events',
        name: 'reminder-events',
        component: CustomerReminderProductPage,
        meta: {
            title: 'Påmindelsesprodukter'
        }
    },
    {
        path: '/category/:category', name: 'category-product', component: CategoryProducts,
        meta: {
            title: 'Check Kategori Produkter'
        }
    },
    {
        path: '/products/:category/:subCategory',
        name: 'sub-category-product',
        component: CategoryProducts,
        meta: {
            title: 'Check underkategori Produkter'
        }
    },
    {
        path: '/search/query/:search',
        name: 'search-products',
        component: SearchPage,
        meta: {
            title: 'Søg efter produkter',
        }
    },
    {
        path: '/customer/profile',
        name: 'customer-profile',
        component: CustomerProfile,
        meta: {
            title: 'Opdater profil',
            requireAuth: true,
            requireAdmin: false,
        }
    },
    {
        path: '/customer/Oversigt',
        name: 'customer-dashboard',
        component: CustomerDashboard,
        meta: {
            title: 'Oversigt! ',
            requireAuth: true,
            requireAdmin: false,
        }
    },
    {
        path: '/customer/orders',
        name: 'customer-orders',
        component: CustomerOrders,
        meta: {
            title: 'Kundernes ordrer',
            requireAuth: true,
            requireAdmin: false,
        }
    }, {
        path: '/product/:product/graph',
        name: 'product.graph',
        component: PrroductGraph,
        meta: {
            title: 'Prisfald graf',
            requireAuth: true,
            requireAdmin: false,
        }
    },
    {
        path: '/customer/complete/orders',
        name: 'customer-completed-orders',
        component: CustomerOrders,
        meta: {
            title: 'Kundeordrer',
            requireAuth: true,
            requireAdmin: false,
        }
    },
    {
        path: '/customer/canceled/orders',
        name: 'customer-canceled-orders',
        component: CustomerOrders,
        meta: {
            title: 'Kundeordrer',
            requireAuth: true,
            requireAdmin: false,
        }
    },
    {
        path: '/handelsbetingelser',
        name: 'handelsbetingelser',
        component: handelsbetingelser,
        meta: {
            title: 'handelsbetingelser',
        }
    },

    {
        path: '/Privatlivspolitik-cookies',
        name: 'Privatlivspolitik-cookies',
        component: PrivatlivspolitikCookies,
        meta: {
            title: 'Privatlivspolitik-cookies'
        }
    },
    {
        path: '/konkurrenceregler',
        name: 'konkurrenceregler',
        component: konkurrenceregler,
        meta: {
            title: 'konkurrenceregler'
        }
    },
    {
        path: '/tak',
        name: 'tak',
        component: tak,
        meta: {
            title: 'tak'
        }
    },

    {
        path: '/cookies',
        name: 'cookies',
        component: cookies,
        meta: {
            title: 'cookies'
        }
    },
];
const router = new VueRouter({
    scrollBehavior(to, from, savedPosition) {
        document.body.scrollTop = document.documentElement.scrollTop = 0;
        return { x: 0, y: 0 };
    },
    mode: 'history',
    hashbang: true,
    routes,
});
router.beforeEach((to, from, next) => {

    if (to.matched.some(record => record.meta.requireAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!User.loggedIn()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else {

            if (to.matched.some(record => record.meta.requireAdmin)) {
                if (!User.isAdmin()) {
                    next({
                        path: '/admin/login',
                        query: { redirect: to.fullPath }
                    })
                } else {
                    next();
                }

            } else {
                next();
            }

        }
    } else {
        next(); // make sure to always call next()!
    }
})


export default router;
