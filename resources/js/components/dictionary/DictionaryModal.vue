<template>
    <l-modal v-model="isShow" size="lg" :title="modalName" centered>
        <b-container fluid>
            <l-form-group label="Краткое описание" required>
                <b-input v-model="data.dv" size="sm"/>
            </l-form-group>
            <l-form-group label="Полное описание" required>
                <b-input v-model="data.fdv" size="sm"/>
            </l-form-group>
        </b-container>
        <div slot="modal-footer">
            <b-button
                size="sm"
                class="float-right"
                variant="secondary"
                @click="close"
            >
                Закрыть
            </b-button>
            <b-button
                size="sm"
                class="float-right"
                variant="primary"
                style="margin-right: 15px;"
                @click="save"
            >
                <i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить
            </b-button>
        </div>
    </l-modal>
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
            default: ''
        }
    },

    data: () => ({
        newModel: {
            dv: '',
            fdv: ''
        },
    }),

    computed: {
        data() {
            return this.model || this.newModel
        },

        modalName() {
            switch (this.modelName) {
                case 'dict_property_statuses':
                    return 'Статусы имущества'
                case 'dict_property_usages':
                    return 'Целевые функции'
                case 'dict_target_functions':
                    return 'Назначение'
                default:
                    return ''
            }
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
                    this.$store.dispatch('FETCH_DICT', this.modelName);
                })
            } else {
                DictItemResource.save(this.modelName, this.data, true).then((response) => {
                    this.$store.dispatch('FETCH_DICT', this.modelName);
                })
            }
        },
    },
};
</script>

<style scoped>

</style>
