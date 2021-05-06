import Home from './components/Home';
import About from './components/About';
import Register from './components/Register';
import Login from './components/Login';
import Dashboard from './components/Dashboard';
import axios from 'axios';
export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: Home,
            name: 'Home'
        },
        {
            path: '/about',
            component: About
        },
        {
            path: '/register',
            component: Register
        },
        {
            path: '/login',
            component: Login,
            name: 'Login'
        },
        {
            path: '/dashboard',
            component: Dashboard,
            name: 'Dashboard',
            beforeEnter: (to, form, next) => {
                axios.get('/api/authenticate').then(() =>{
                    next()
                }).catch(() =>{
                    return next({ name: 'Login' })
                })
            }
        },
    ]
}