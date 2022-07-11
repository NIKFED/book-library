<template>
  <div class="wrapper">
    <navbar></navbar>
    <sidebar>
      <div class="wrapper">
        <h1> AYE</h1>
      </div>
    </sidebar>
    <footer></footer>
  </div>
</template>

<script>
import Navbar from './Navbar';
import Sidebar from './Sidebar';
import Footer from './Footer';

export default {
  name: "Panel",
  components: {
    Navbar,
    Sidebar,
    Footer
  }
}
</script>

<style scoped>

</style>