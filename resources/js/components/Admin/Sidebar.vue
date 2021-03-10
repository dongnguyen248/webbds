<template>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/adminpage" class="brand-link">

        <span class="brand-text font-weight-light">Admin Page</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <router-link to="/category" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>
                            Category
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/type" class="nav-link">
                       <i class="fas fa-users"></i>
                        <p>
                            Type
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/article" class="nav-link">
                      <i class="fas fa-car-side"></i>
                        <p>
                           Article
                        </p>
                    </router-link>
                </li>
               
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
</template>
<style  scoped>
@media (max-width: 1024px) {
  .main-sidebar {
    width: 173px !important;
  }
}
</style>