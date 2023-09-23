import axios from 'axios';

export default {
    methods: {
        request() {
            let instance = axios.create(),
                endpoint = '/vidmin/api/';

            instance.defaults.headers.common['X-CSRF-TOKEN'] =
                document.head.querySelector('meta[name="csrf-token"]').content;

            instance.defaults.baseURL = endpoint;

            const requestHandler = (request) => {
                // Add any request modifiers...
                return request;
            };

            const errorHandler = (error) => {
                // Add any error modifiers...
                return Promise.reject(error.response.data);
            };

            const successHandler = (response) => {
                // Add any response modifiers...
                return response.data;
            };

            instance.interceptors.request.use((request) => requestHandler(request));

            instance.interceptors.response.use(
                (response) => successHandler(response),
                (error) => errorHandler(error)
            );

            return instance;
        },
    },
};
