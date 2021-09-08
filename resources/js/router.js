import Vue from 'vue';
import VueRouter from 'vue-router';
// and then call `Vue.use(VueRouter)`.

// 1. Define route components.
// These can be imported from other files
import Example from './components/ExampleComponent'
import CreateTest from './components/CreateTest'
import AllTests from './components/AllTests'
// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
Vue.use(VueRouter);

const routes = [
  { path: '/home/example', component: Example },
  { path: '/home/create-test', component: CreateTest },
  { path: '/home/tests', component: AllTests}
];

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
export default new VueRouter({
  mode: "history",
  routes // short for `routes: routes`
});

// 4. Create and mount the root instance.
// Make sure to inject the router with the router option to make the
// whole app router-aware.

// const app = new Vue({
//   router
// }).$mount('#app')

// Now the app has started!