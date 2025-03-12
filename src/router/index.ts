import { createRouter, createWebHistory } from 'vue-router'

import MainPageView from '../views/MainPageView.vue'
import SignUpLoginPageView from "../views/SignUpLoginPageView.vue";
import LandingPageView from "../views/LandingPageView.vue";
import EventCalendarView from "../views/EventCalendarView.vue";
import ChecklistView from "../views/ChecklistView.vue";
import DanceView from '../views/DanceView.vue';
import Imprint from "../views/ImprintView.vue";



const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/MainPage',
      name: 'MainPage',
      component: MainPageView,
    },
    {
      path: '/SignUpLogin',
      name: 'SignUpLogin',
      component: SignUpLoginPageView,
    },
    {
      path: '/',
      name: 'LandingPage',
      component: LandingPageView
    },
    {
      path: '/EventCalendar',
      name: 'Eventcalendar',
      component: EventCalendarView
    },
    {
      path: '/Checklist',
      name: 'Checklist',
      component: ChecklistView
    },
    {
      path: '/DanceView',
      name: 'DanceView',
      component: DanceView
    },
    {
      path: '/Imprint',
      name: 'Imprint',
      component: Imprint
    }
  ],
})

export default router
