import Model from './model';
import BookResource from '../resources/book';

class Book extends Model {
    static async fetch(params) {
        return await this.resource.fetch(params);
    }

    static async fetchById(id) {
        const data = await this.resource.get({ id });
        return new this(data);
    }

    static async fetchByCategoryId(categoryId, params) {
        console.log(params)
        return await this.resource.fetchByCategoryId(categoryId, params);
    }
}

Book.resource = BookResource;

export default Book;
