<template>
  <div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    
    </ul>

  

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    
      
      <li class="nav-item">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <template v-if="!currentUser">
            <li>
              <router-link class="nav-link" to="/login">Login</router-link>
            </li>
            
          </template>
          <template v-else>
          
            <li class="nav-item dropdown">
              <a
                href="#"
                id="navbarDropdown"
                class="nav-link dropdown-toggle"
                role="button"
                aria-expanded="false"
                aria-haspopup="true"
                data-toggle="dropdown"
              >
                {{ currentUser.name }}
                <span class="caret"></span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a href="#!" @click.prevent="logout" class="dropdown-item"
                  >Logout</a
                >
              </div>
            </li>
          </template>
        </ul>
      </div>
      </li>
    </ul>
  </nav>
    <!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <template v-if="!currentUser">
            <li>
              <router-link class="nav-link" to="/login">Login</router-link>
            </li>
            
          </template>
          <template v-else>
          
            <li class="nav-item dropdown">
              <a
                href="#"
                id="navbarDropdown"
                class="nav-link dropdown-toggle"
                role="button"
                aria-expanded="false"
                aria-haspopup="true"
                data-toggle="dropdown"
              >
                {{ currentUser.name }}
                <span class="caret"></span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a href="#!" @click.prevent="logout" class="dropdown-item"
                  >Logout</a
                >
              </div>
            </li>
          </template>
        </ul>
      </div>
    </nav> -->
  </div>
</template>
<script>
export default {
  name: "app-header",
  methods: {
    logout() {
      this.$store.commit("logout");
      this.$router.push("/login");
    },
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser;
    },
  },
};
</script>
<style  scoped>
.navbar {
  background-color: #3445b4 !important;
}

</style>
