<template>
    <div>
        <b-list-group class="border-0 shadow" flush>
            <b-list-group-item variant="primary" class="d-none d-md-block">
                <div class="row">
                    <div class="col-md-5">Краткое описание</div>
                    <div class="col-md-6">Полное описание</div>
                    <div class="col-md-1"></div>
                </div>
            </b-list-group-item>
            <b-list-group-item v-for="(item, key) in data" :key="key">
                <div class="d-flex">
                    <div class="col-md-5">
                        {{ item.dv }}
                    </div>
                    <div class="col-md-6">
                        {{ item.fdv }}
                    </div>
                    <div class="col-md-1">
                        <b-button
                            class="p-0"
                            variant="link"
                            v-b-tooltip="`Редактировать`"
                            @click="editItem(item)">
                            <b-icon-pencil />
                        </b-button>
                        <b-button
                            class="p-0"
                            variant="link"
                            v-b-tooltip="`Удалить`"
                            @click="removeItem(item)">
                            <b-icon-x />
                        </b-button>
                    </div>
                </div>
            </b-list-group-item>
        </b-list-group>
        <br>
        <b-card>
            <b-row>
                <b-col cols="12" md="auto" class="ml-auto">
                    <b-button variant="outline-primary" @click="createItem">
                        <b-icon-plus /> Создать новый элемент
                    </b-button>
                </b-col>
            </b-row>
        </b-card>
        <dictionary-modal
            :is-show="isShowDictionaryModal"
            :model="currentDictionaryItem"
            :model-name="name"
            @on-update="fetchData"
            @on-close="isShowDictionaryModal = false"
        />
    </div>
</template>

<script>
import DictionaryModal from "./DictionaryModal";
import DictItemResource from "../../resources/dict_item";

export default {
    name: 'DictionaryList',
    components: { DictionaryModal },
    props: {
        name: {
            type: String,
            default: '',
        }
    },
    data: () => ({
        isShowDictionaryModal: false,
        currentDictionaryItem: null,
    }),
    computed: {
        data () {
            return this.$store.getters.getDict(this.name);
        }
    },
    async mounted () {
        await this.fetchData();
    },
    methods: {
        async fetchData() {},

        createItem() {
            this.currentDictionaryItem = null;
            this.isShowDictionaryModal = true;
        },

        editItem(item) {
            this.currentDictionaryItem = item;
            this.isShowDictionaryModal = true;
        },

        removeItem(item) {
            DictItemResource.delete(this.name, item).then((_) => {
                this.$store.dispatch('FETCH_DICT', this.name);
            });
        }
    }
}
</script>

<style scoped>

</style>
