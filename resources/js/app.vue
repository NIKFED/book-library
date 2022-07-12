<template>
  <div id="book-library">
    <navbar></navbar>
    <sidebar></sidebar>
    <div class="content-wrapper">
      <router-view></router-view>
    </div>
    <footer></footer>
  </div>
</template>

<script>
import Navbar from './components/dashboard/Navbar';
import Sidebar from './components/dashboard/Sidebar';
import Footer from './components/dashboard/Footer';

export default {
  name: 'App',
  components: { Navbar, Sidebar, Footer },
}
</script>