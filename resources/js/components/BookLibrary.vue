<template>
  <div>
    Hello
  </div>
</template>

<script>
export default {
  name: 'BookLibrary',
  components: { },
  data() {
    return {

    }
  },

  async mounted() {
    await this.fetchData();
  },

  methods: {
    async fetchData() {

    },
  }
}
</script>