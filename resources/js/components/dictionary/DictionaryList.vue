<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dictionaries</h1>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features &amp; hover style</h3>
              </div>

              <div class="card-body">
                <div class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <b-table
                          id="my-table"
                          :fields="fields"
                          :items="data"
                          :per-page="perPage"
                          :current-page="currentPage"
                      >
                        <template v-slot:cell(created_at)="row">
                          {{ formatDate(row.item.created_at) }}
                        </template>
                        <template v-slot:cell(updated_at)="row">
                          {{ formatDate(row.item.updated_at) }}
                        </template>
                        <template v-slot:cell(actions)="row">
                          <div class="row">
                            <b-button
                                class="p-0"
                                variant="link"
                                v-b-tooltip="`Edit`"
                                @click="editItem(row.item)">
                              <b-icon-pencil />
                            </b-button>
                            <b-button
                                class="p-0"
                                variant="link"
                                v-b-tooltip="`Remove`"
                                @click="removeItem(row.item)">
                              <b-icon-x />
                            </b-button>
                          </div>
                        </template>
                      </b-table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-5">
                      <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                        Showing {{ currentPage }} to {{ perPage }} of {{ data.length }} entries
                      </div>
                    </div>
                    <b-pagination
                        v-model="currentPage"
                        :total-rows="data.length"
                        :per-page="perPage"
                        aria-controls="my-table"
                    ></b-pagination>
                  </div>
                  <b-row>
                    <b-col cols="12" md="auto" class="ml-auto">
                      <b-button variant="outline-primary" @click="createItem">
                        <b-icon-plus /> Create new item
                      </b-button>
                    </b-col>
                  </b-row>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <dictionary-modal
          :is-show="isShowDictionaryModal"
          :model="currentDictionaryItem"
          :model-name="dictName"
          @on-update="fetchData"
          @on-close="isShowDictionaryModal = false"
      />
    </section>
  </div>
</template>

<script>
import moment from "moment";
import DictItemResource from "../../resources/dict_item";
import DictionaryModal from "./DictionaryModal";

export default {
  name: 'DictionaryList',
  components: {
    DictionaryModal
  },

  data: () => ({
    perPage: 10,
    currentPage: 1,
    isShowDictionaryModal: false,
    currentDictionaryItem: null,
    dictName: '',
    fields: [
      {
        label: '#',
        key: 'id',
        sortable: true,
      },
      {
        label: 'Name',
        key: 'name',
        sortable: true,
      },
      {
        label: 'Created at',
        key: 'created_at',
        sortable: true,
      },
      {
        label: 'Updated at',
        key: 'updated_at',
        sortable: true,
      },
      {
        label: 'Actions',
        key: 'actions',
        sortable: false,
      },
    ]
  }),

  computed: {
    data () {
      return this.$store.getters.getDict(this.dictName);
    }
  },

  async mounted () {
    await this.fetchData();
  },

  methods: {
    async fetchData() {
      this.dictName = this.$route.params.dictionaryName;
      console.log(this.dictName);
    },

    formatDate(isoString) {
      const date = moment.parseZone(isoString);
      return date.format('DD.MM.YYYY HH:mm');
    },

    createItem() {
      this.currentDictionaryItem = null;
      this.isShowDictionaryModal = true;
    },

    editItem(item) {
      this.currentDictionaryItem = item;
      this.isShowDictionaryModal = true;
    },

    removeItem(item) {
      DictItemResource.delete(this.dictName, item).then((_) => {
        this.$store.dispatch('fetchDict', this.dictName);
      });
    }
  },

}
</script>

<style scoped>

</style>
