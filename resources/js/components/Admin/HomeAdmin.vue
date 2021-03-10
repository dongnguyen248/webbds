<template>
    <div id="main">
        <admin-header></admin-header>
        <admin-sidebar></admin-sidebar>
        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import AdminHeader from "./Header.vue";
import AdminSidebar from "./Sidebar.vue";

export default {
    name: "admin-app",
    components: {
        'admin-header':AdminHeader,
        'admin-sidebar':AdminSidebar
        
    }
};
</script>
