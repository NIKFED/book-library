import Model from './model';
import BookResource from '../resources/book';

class Book extends Model {
    static async fetch(params) {
        const data = await this.resource.fetch(params);
        return data.map((item) => new this(item));
    }

    static async fetchById(id) {
        const data = await this.resource.get({ id });
        return new this(data);
    }
}

Book.resource = BookResource;

export default Book;
