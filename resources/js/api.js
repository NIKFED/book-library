import axios from 'axios';

export default {
    async initialize(dictNames, callback) {
        const dicts = await this.dicts(dictNames);
        if (callback) callback(dicts);
    },

    async dicts(dictsArray) {
        const { data } = await axios.post('/api/dictionaries', {
            data: JSON.stringify(dictsArray),
        });
        return data;
    },
}