import axios from 'axios';
import Resource from './resource';

class AnimalResource extends Resource {
    static async fetchById(id) {
        const data = await this.resource.get({ id });
        return new this(data);
    }

    static async fetchByCategoryId(categoryId, params) {
        if (params !== undefined) {
            params = {params: params}
        }
        const { data } = await axios.get(`/api/category/${categoryId}/books`, params);
        return data;
    }
}

AnimalResource.url = '/api/book';

export default AnimalResource;
