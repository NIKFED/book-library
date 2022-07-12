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

    <section class="content" v-if="book">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <b-card
                no-body
            >
              <b-img
                  :src="book.thumbnail_url || 'img/default-150x150.png'"
                  width="300px"
                  height="300px"
              ></b-img>
              <template #header>
                <h4 class="mb-0">{{ book.title }}</h4>
              </template>

              <b-card-body>
                <b-form-group label="Status">
                  <multiselect v-model="book.status"
                               :options="statuses"
                               placeholder="Select one"
                               label="name"
                               track-by="name"/>
                </b-form-group>

                <b-form-group label="Categories">
                <multiselect
                    v-model="book.categories"
                    :options="categories"
                    :multiple="true"
                    :close-on-select="false"
                    :clear-on-select="false"
                    :preserve-search="true"
                    placeholder="Select many"
                    label="name"
                    track-by="name">

                </multiselect>
                </b-form-group>

                <b-form-group label="Authors">
                  <multiselect
                      v-model="book.authors"
                      :options="authors"
                      :multiple="true"
                      :close-on-select="false"
                      :clear-on-select="false"
                      :preserve-search="true"
                      placeholder="Select many"
                      label="name"
                      track-by="name">

                  </multiselect>
                </b-form-group>

                <b-form-group label="ISBN">
                  <b-form-input v-model="book.isbn" size="sm"></b-form-input>
                </b-form-group>

                <b-form-group label="Page count">
                  <b-form-input v-model="book.page_count" type="number" size="sm"></b-form-input>
                </b-form-group>

                <b-form-group label="Published date">
                  <b-form-input v-model="book.published_date" type="date" size="sm"></b-form-input>
                </b-form-group>

                <b-form-group label="Short description">
                  <b-form-textarea v-model="book.short_description"></b-form-textarea>
                </b-form-group>

                <b-form-group label="Long description">
                  <b-form-textarea
                      rows="4"
                      v-model="book.long_description"
                  ></b-form-textarea>
                </b-form-group>
                <b-row>
                  <b-button variant="outline-primary" @click="save">
                    <b-icon-save /> Save
                  </b-button>
                </b-row>
              </b-card-body>

            </b-card>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Book from '../models/book';
import BookResource from '../resources/book';
import Multiselect from 'vue-multiselect';

export default {
  name: 'Book',
  components: { Multiselect },
  data: () => ({
    book: null,
  }),

  computed: {
    statuses() {
      return this.$store.getters.getDict('statuses');
    },
    categories() {
      return this.$store.getters.getDict('categories');
    },
    authors() {
      return this.$store.getters.getDict('authors');
    },
  },

  async mounted() {
    await this.fetchData();
  },

  methods: {
    async fetchData() {
      await Book.fetchById(this.$route.params.bookId).then((response) => {
        this.book = response.data;
      });
    },

    save() {
      if (this.book) {
        BookResource.save(this.book);
      }
    },
  }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>