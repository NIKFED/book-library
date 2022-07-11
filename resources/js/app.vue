<template>
  <div id="book-library">
    <panel></panel>
    <router-view></router-view>
  </div>
</template>

<script>
import Panel from './components/dashboard/Panel';

export default {
  name: 'App',
  components: { Panel },
}
</script>