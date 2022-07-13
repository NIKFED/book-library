<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Books</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid" >
        <div class="row">
          <div class="col-12">
            <b-list-group-item>
              <b-form-input v-model="query.name" placeholder="Book title"/>
              <br>
              <b-form-input v-model="query.author_name" placeholder="Author name"/>
              <div class="row mt-3">
                <div class="col-6 col-md">
                  <div class="col-6 col-sm">
                    <div class="d-flex flex-row">
                      <label class="pt-2 pr-2">Status</label>
                      <b-select
                          v-model="query.status"
                          :options="statuses"
                          value-field="id"
                          text-field="name"/>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <button class="btn border-secondary pr-2 pl-2" @click="resetFilters">
                    <b-icon-sliders/>
                    Reset filters
                  </button>
                </div>
              </div>
            </b-list-group-item>


            <div class="d-flex flex-wrap justify-space-between">
                <b-list-group-item
                    v-for="(category, key) in categories"
                    :key="key"
                    class="mt-2 ml-2"
                    :variant=getVariant(key)
                    v-on:click="selectedCategory = category"
                >
                  {{ category.name }}
                </b-list-group-item>
            </div>
          </div>
        </div>
        <br>
        <book-list v-if=selectedCategory :category="selectedCategory" :query="query"></book-list>
      </div>
    </section>
  </div>
</template>

<script>
import BookList from "./BookList";

export default {
  name: 'CategoryList',
  components: { BookList },
  data: () => ({
    selectedCategory: null,
    query: {
      name: '',
      author_name: '',
      status: null,
    },
  }),

  computed: {
    categories() {
      return this.$store.getters.getDict('categories');
    },
    statuses() {
      return this.$store.getters.getDict('statuses');
    },
  },

  async mounted() {
    await this.fetchData();
  },

  methods: {
    async fetchData() {

    },

    getVariant(id) {
      switch (id % 8) {
        case 0:
          return 'primary';
        case 1:
          return 'secondary';
        case 2:
          return 'success';
        case 3:
          return 'danger';
        case 4:
          return 'warning';
        case 5:
          return 'info';
        case 6:
          return 'light';
        case 7:
          return 'dark';
      }
    },

    resetFilters() {
      this.query = {
        name: '',
        author_name: '',
        status: false,
      };
    },
  }
}
</script>