<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary nav__wrapper">
    <router-link
      :to="{ name: routes.DASHBOARD_NAME }"
      class="navbar-brand nav__logo"
    >
      Brick
    </router-link>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <router-link
          class="nav-item nav-link nav__item"
          :to="{ name: 'projects' }"
        >
          Проекты
        </router-link>
        <router-link
          :to="{ name: 'staff' }"
          class="nav-item nav-link nav__item"
        >
          Персонал
        </router-link>
        <router-link
          :to="{ name: 'tickets' }"
          class="nav-item nav-link nav__item"
        >
          Тикеты
        </router-link>
      </div>
      <div class="nav__avatar" @click="() => {}">
        <img
          :src="auth.avatar"
          alt="Avatar">
      </div>
    </div>
  </nav>
</template>

<script>
import AuthState from '../../../common/mixins/Auth/State';
import Routes from "../../../common/mixins/App/Routes";

export default {
  name: "Navbar",
  mixins: [
    Routes, AuthState,
  ]
}
</script>
