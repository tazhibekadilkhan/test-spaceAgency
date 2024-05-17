import http from "../axios.js";

class CommentDataService {
    getAll(params) {
        return http.get("/comments", {params: params });
    }

    get(id) {
        return http.get(`/comments/${id}`);
    }

    create(data) {
        return http.post("/comments", data);
    }

    update(id, data) {
        return http.put(`/comments/${id}`, data);
    }

    delete(id) {
        return http.delete(`/comments/${id}`);
    }
}

export default new CommentDataService();
