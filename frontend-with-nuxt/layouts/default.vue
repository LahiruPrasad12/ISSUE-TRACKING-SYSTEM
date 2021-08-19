<template>
  <div>
    <b-navbar class="notification is-primary">
      <template #brand>
        <b-navbar-item tag="router-link" :to="{ path: '/' }">
        </b-navbar-item>
      </template>
      <template #start>
        <b-navbar-item>
          <nuxt-link to="/">Home</nuxt-link>
        </b-navbar-item>

        <b-navbar-item>
          <nuxt-link to="/categories/allcategories">All Categories</nuxt-link>
        </b-navbar-item>

        <b-navbar-item>
          <nuxt-link to="/issues/allisuue">All Issues</nuxt-link>
        </b-navbar-item>

        <b-navbar-dropdown label="Info">
          <b-navbar-item>
            <nuxt-link to="/contact">Contact us</nuxt-link>
          </b-navbar-item>
          <b-navbar-item>
            <nuxt-link to="/about">About us</nuxt-link>
          </b-navbar-item>
        </b-navbar-dropdown>
      </template>

      <template #end>
        <b-navbar-item tag="div">
          <div class="buttons">
            <a class="button is-primary">
              <strong>Sign up</strong>
            </a>
            <a class="button is-light">
              Log in
            </a>
          </div>
        </b-navbar-item>
      </template>
    </b-navbar>

    <Nuxt />
  </div>

</template>


