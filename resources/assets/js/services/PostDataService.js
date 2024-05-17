import http from "../axios.js";

class PostDataService {
    getAll(params) {
        return http.get("/posts", {params: params });
    }

    get(id) {
        return http.get(`/posts/${id}`);
    }

    create(data) {
        return http.post("/posts", data);
    }

    update(id, data) {
        return http.put(`/posts/${id}`, data);
    }

    delete(id) {
        return http.delete(`/posts/${id}`);
    }
}

export default new PostDataService();
