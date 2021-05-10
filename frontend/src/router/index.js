import Vue from 'vue'
import VueRouter from 'vue-router'

import store from '@/store'

const ifAuth = (to, from, next) => {
  if (store.getters.check) {
    next()
    return
  }
  next('/login')
}

const isAuth = (to, from, next) => {
  if (!store.getters.check) {
    next()
    return
  }
  next('/dashboard')
}

Vue.use(VueRouter)

console.log("router called");

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    {
      path: '/dashboard',
      name: 'home',
      component: () => import('@/views/Home.vue'),
			beforeEnter: ifAuth,
      meta: {
        pageTitle: 'Home',
        breadcrumb: [
          {
            text: 'Home',
            active: true,
          },
        ],
      },
    },
    {
      path: '/second-page',
      name: 'second-page',
      component: () => import('@/views/SecondPage.vue'),
			beforeEnter: ifAuth,
      meta: {
        pageTitle: 'Second Page',
        breadcrumb: [
          {
            text: 'Second Page',
            active: true,
          },
        ],

      },
    },
    {
      path: '/exercises',
      name: 'exercises',
			beforeEnter: ifAuth,
      component: () => import('@/views/exercises/list-exercises.vue'),
      auth: true,
    },

    {
      path: '/plans',
      name: 'plans',
			beforeEnter: ifAuth,
      component: () => import('@/views/plans/home.vue'),
      auth: true,
			redirect: {
				name: 'plans.list'
			},

			children: [
        {
					path: '',
					component: () => import('@/views/plans/list.vue'),
					name: 'plans.list',
          meta: {
            pageTitle: 'Exercise Plans',
            breadcrumb: [
              {
                text: 'Dashboard',
                to: 'dashboard'
              },
              {
                text: 'Exercise Plans',
                active: true,
              },
            ],

          },
				}, //defualt router-view
				{
					path: 'create',
					component: () => import('@/views/plans/edit.vue')
				},
				{
					path: ':id/edit',
					component: () => import('@/views/plans/edit.vue')
				},
			]
    },
    {
      path: '/plans/:id/manage',
      name: 'manage-plans',
			beforeEnter: ifAuth,
      component: () => import('@/views/plans/manage.vue'),
      isAuth: true,
      children: [
        {
					path: '',
					component: () => import('@/views/plans/days/list.vue'),
					name: 'plans.days.list',
          meta: {
            pageTitle: 'Manage Plan',
            breadcrumb: [
              {
                text: 'Plans',
                to: '/plans',
              },
              {
                text: 'Manage Exercise Plan',
                active: true,
              },
            ],
            auth: true,
          },
				}, //defualt router-view
				{
					path: 'create',
					component: () => import('@/views/plans/edit.vue')
				},
				{
					path: ':id/edit',
					component: () => import('@/views/plans/edit.vue')
				},
					{
						path: '/days/:id/edit',
						component: () => import('@/views/plans/days/edit.vue'),
					},
			]
    },

		/*
    {
      path: '/days/:id/edit',
      name: 'days.edit',
      component: () => import('@/views/plans/days/edit.vue'),
      beforeEnter: ifAuth,
      meta: {
        pageTitle: 'Edit Day',
        breadcrumb: [
          {
            text: 'Edit Day',
            active: true,
          },
        ],

      },
    },
		*/

    {
      path: '/login',
      name: 'login',
      beforeEnter: isAuth,
      component: () => import('@/views/Login.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/register',
      name: 'register',
      beforeEnter: isAuth,
      component: () => import('@/views/authentication/Register.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/error-404',
      name: 'error-404',
      component: () => import('@/views/error/Error404.vue'),
      meta: {
        layout: 'full',
      },
    },
		  {
	      path: '/',
	      redirect: 'dashboard',
	    },
    {
      path: '*',
      redirect: 'error-404',
    },
  ],
})

// ? For splash screen
// Remove afterEach hook if you are not using splash screen
router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})


export default router
