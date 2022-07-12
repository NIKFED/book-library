class Model {
    constructor(data) {
        this.data = data;
        this.state = null;
        return new Proxy(this, this);
    }

    fill (data) {
        this.data = { ...data };
    }

    get id() {
        return this.data && this.data[this.constructor.primaryKey] ? this.data[this.constructor.primaryKey] : null;
    }

    get (target, prop) {
        let response = undefined
        if (this[prop]) {
            response = this[prop]
        } else if (this.data) {
            response = this.data[prop]
        }
        return response;
    }
}

Model.primaryKey = 'id';

export default Model;
