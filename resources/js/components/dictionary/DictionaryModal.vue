<template>
    <b-modal v-model="isShow" size="lg" :title="modalName" centered>
        <b-container fluid>
          <b-form-group label="Name">
            <b-form-input v-model="data.name" size="sm"></b-form-input>
          </b-form-group>
        </b-container>
        <div slot="modal-footer">
            <b-button
                size="sm"
                class="float-right"
                variant="secondary"
                @click="close"
            >
                Close
            </b-button>
            <b-button
                size="sm"
                class="float-right"
                variant="primary"
                style="margin-right: 15px;"
                @click="save"
            >
                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save
            </b-button>
        </div>
    </b-modal>
</template>

<script>
import DictItemResource from "../../resources/dict_item"

export default {
  name: 'DictionaryModal',
  props: {
    model: {
      type: Object,
      default: null,
    },
    isShow: {
      type: Boolean,
      default: false,
    },
    modelName: {
      type: String,
      default: '',
    }
  },

    data: () => ({
      newModel: {
        name: '',
      },
    }),

    computed: {
      data() {
        return this.model || this.newModel;
      },

      modalName() {
        return this.modelName.charAt(0).toUpperCase() + this.modelName.slice(1);
      }
    },

    async mounted() {
      await this.fetchData();
    },

    methods: {
      async fetchData() {},

      close() {
        this.$emit('on-close');
      },

      save() {
        this.close();
        if (this.data.id) {
          DictItemResource.update(this.modelName, { id: this.data.id, item: this.data }).then((response) => {
            this.$store.dispatch('fetchDict', this.modelName);
          });
        } else {
          DictItemResource.save(this.modelName, this.data, true).then((response) => {
            this.$store.dispatch('fetchDict', this.modelName);
          });
        }
      },
    },
};
</script>

<style scoped>

</style>
