import axios from 'axios';
import Resource from './resource';

class AnimalResource extends Resource {
    static async fetchById(id) {
        const data = await this.resource.get({ id });
        return new this(data);
    }
}

AnimalResource.url = '/api/book';

export default AnimalResource;
