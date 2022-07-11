import axios from 'axios';
import Resource from "./resource";

class DictItemResource extends Resource {
  static async update (name, { id, item }) {
    const { data } = await axios.put(`${this.url}/${name}/${id}`, item);
    return data;
  }

  static async save(name, params, forcePost = false) {
    const id = params.id || (params instanceof FormData && params.get('id'));
    const method = id && !forcePost ? 'put' : 'post';
    const { data } = await axios.request({
      method,
      url: id ? `${this.url}/${id}/${name}` : `${this.url}/${name}`,
      data: params,
    });
    return data;
  }

  static async delete (name, params) {
    const { data } = await axios.delete(`${this.url}/${name}/${params.id}`, params);
    return data;
  }
}

DictItemResource.url = '/api/dictionary'

export default DictItemResource
