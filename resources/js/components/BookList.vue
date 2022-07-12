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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <b-list-group>
              <b-list-group-item
                  v-for="(book, key) in books"
                  :key="key"
                  :to="`book/${book.id}`"
              >
                <b-card
                    no-body
                    style="width: 20rem; height: 55rem;"
                    :img-src="book.thumbnail_url || 'img/default-150x150.png'"
                    img-alt="Image"
                    img-top
                    class="ml-4"
                >
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
                  </template>

                  <b-card-body>
                    <div class="col-auto text-bold">
                      ISBN: {{ book.isbn }}
                    </div>
                    <b-badge variant="success">
                      {{ book.status.name }}
                    </b-badge>
                    <b-list-group flush>
                      <div class="col-auto">
                        Authors:
                      </div>

                      <b-list-group-item v-for="(author, keyAuthors) in book.authors" :key="keyAuthors">
                        <div class="col-auto">
                          {{ author.name }}
                        </div>
                      </b-list-group-item>
                    </b-list-group>
                    <div class="col-auto">
                      Page count: {{ book.page_count }}
                    </div>
                  </b-card-body>


                  <b-card-footer small>
                    <span class="small text-muted">Published date: {{ book.published_date }}</span>
                  </b-card-footer>
                </b-card>
              </b-list-group-item>
            </b-list-group>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import BookResource from '../resources/book';

export default {
  name: 'BookList',
  data: () => ({
    books: [],
  }),

  async mounted() {
    await this.fetchData();
  },

  methods: {
    async fetchData() {
      this.books = await BookResource.fetch();
    },
  }
}
</script>