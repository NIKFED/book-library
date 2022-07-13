<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="d-flex flex-wrap justify-space-between">
          <b-card
              v-for="(book, key) in books"
              :key="key"
              no-body
              :img-src="book.thumbnail_url || 'img/dashboard/default-150x150.png'"
              class="ml-2"
              style="width: 15%;">
            <template #header>
              <h4 class="mb-0">{{ book.title }}</h4>
              <b-badge
                  v-for="(category, keyCategories) in book.categories"
                  :key="keyCategories"
                  variant="primary"
                  class="ml-1"
              >
                {{ category.name }}
              </b-badge>
              <b-badge variant="success">
                {{ book.status.name }}
              </b-badge>
            </template>
          </b-card>
        </div>
      </div>
    </div>
    <infinite-loading ref="infiniteLoading" spinner="spiral" @infinite="infiniteHandler">
      <div slot="no-more" class="py-2 text-muted">
        {{ books.length }} Books
      </div>
    </infinite-loading>
  </div>
</template>

<script>
import Book from '../models/book';
import InfiniteLoading from 'vue-infinite-loading';

export default {
  name: 'BookList',
  components: { InfiniteLoading },
  props: {
    category: {
      type: Object,
      default: null,
    },
    query: {
      type: Object,
      default: null,
    }
  },

  data: () => ({
    books: [],
    pagination: {
      current_page: 1,
      page_size: 12,
      total_entries: 0,
    },
  }),

  watch: {
    category: {
      async handler() {
        this.pagination.current_page = 1;
        this.books = [];
        this.$refs.infiniteLoading.stateChanger.reset();
      },
      deep: true,
    },
    query: {
      async handler() {
        this.pagination.current_page = 1;
        this.books = [];
        this.$refs.infiniteLoading.stateChanger.reset();
      },
      deep: true,
    },
  },

  methods: {
    async infiniteHandler($state) {
      // const query = { ...this.query };
      const data = {
        'page': this.pagination.current_page,
        'query': this.query,
      };
      const response = await Book.fetchByCategoryId(this.category.id, data);
      this.pagination.total_entries = response.meta.total_entries;
      if (response.data.length) {
        this.pagination.current_page += 1;
        this.books.push(...response.data);
        $state.loaded();
      } else {
        $state.complete();
      }
    },

    update() {
      this.$refs.infiniteLoading.stateChanger.reset();
    },
  }
}
</script>